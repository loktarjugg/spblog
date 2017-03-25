<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/6
 * Time: 10:33
 */

namespace App\Repositories;


use App\Models\Article;
use Conner\Tagging\Model\Tag;
use GrahamCampbell\Markdown\Facades\Markdown;


class ArticleRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function lists()
    {
        $model = $this->model;

        if (\Request::has('title')){
            $model = $model->orWhere('title' , 'like' ,'%' . \Request::get('title') .'%');
        }

        if (\Request::has('tags')){
            $model = $model->withAllTags(\Request::get('tags'));
        }

        if(\Request::has('groups')){
            $tags = Tag::inGroup(\Request::get('groups'))->pluck('name')->toArray();
            $model = $model->withAnyTag($tags);
        }

        $per_count = \Request::has('per_count') ? (int) \Request::get('per_count') : 10;

        return $this->paginate($model , $per_count);
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug' , $slug)->firstOrFail();
    }

    public function getReplies($slug)
    {
        $articles = $this->findBySlug($slug);

        $per_page = \Request::has('per_page') ? (int) \Request::get('per_page') : 10;

        return $articles->replies()->paginate($per_page);
    }

    public function store($data)
    {
        $data['original_body'] = $data['body'];

        $data['body'] = Markdown::convertToHtml($data['original_body']);

        $this->model->fill($data)->save();

        $this->model->tag($data['tags']);

        return true;
    }

    public function update($data , $slug)
    {
        $data['original_body'] = $data['body'];

        $data['body'] = Markdown::convertToHtml($data['original_body']);

        $this->model = $this->findBySlug($slug);

        $this->model->retag(collect($data['tags'])->pluck('name')->toArray());

        return $this->save($this->model , $data);

    }

    public function destroy($slug)
    {
        $article = $this->findBySlug($slug);

        $article->untag();

        return $article->delete();
    }
}