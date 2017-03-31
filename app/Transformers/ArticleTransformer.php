<?php

namespace App\Transformers;

use App\Models\Article;
use Conner\Tagging\Model\Tag;
use League\Fractal\TransformerAbstract;
class ArticleTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'tags',
        'replies'
    ];


    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Article $article)
    {
        $prev_slug = $this->getSlug($article->id) ?: null;
        $next_slug = $this->getSlug($article->id ,0)?:null;
        return [
            'id' => $article->id,
            'title' => $article->title,
            'slug'  => $article->slug,
            'cover' => $article->cover,
            'qrcode' => $article->qrcode,
            'original_link' => $article->original_link,
            'description'  => $article->description,
            'body'  => $article->body,
            'original_body'  => $article->original_body,
            'vote_count' => $article->vote_count,
            'view_count' => $article->view_count,
            'created_at' => $article->created_at->diffForHumans(),
            'prev_slug'  => $prev_slug,
            'next_slug'  => $next_slug
        ];
    }


    public function includeTags(Article $article)
    {
        $tags = $article->tags;

        return $this->collection($tags, new TagTransformer,false);
    }

    public function includeReplies(Article $article)
    {
        $replies = $article->replies;

        return $this->collection($replies ,new ReplyTransformer,false);
    }

    protected function getSlug( $articleId  ,$type = 1)
    {
        $article = new Article();

        if (\Request::has('groups')){
            $tags = Tag::inGroup(\Request::get('groups'))->pluck('name')->toArray();
            $article = $article->withAnyTag($tags);
        }

        return $article->where('id' , $type === 1 ?'<':'>' , $articleId)
            ->orderBy('id' , $type === 1?'desc':'asc')
            ->pluck('slug')->first();

    }
}
