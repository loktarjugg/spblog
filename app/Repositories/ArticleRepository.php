<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/6
 * Time: 10:33
 */

namespace App\Repositories;


use App\Models\Article;
use GrahamCampbell\Markdown\Facades\Markdown;


class ArticleRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Article $article)
    {
        $this->model = $article;
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
    }
}