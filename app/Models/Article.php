<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Conner\Tagging\Taggable;

/**
 * Class Article
 * @package App\Models
 */
class Article extends Model
{
    use Taggable;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'cover',
        'qrcode',
        'original_link',
        'original_body',
        'body',
        'vote_count',
        'view_count',
        'last_replies_id',
        'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function replies()
    {
        return $this->morphToMany(Reply::class,'replyable','replyables','replyable_id','replies_id');
    }

    /**
     * @param $model
     * @param string $title
     * @return mixed
     */
    public function scopeSearchTitle($model , $title='')
    {
        return $model->orWhere('title' , 'like' ,'%' . $title .'%');
    }

}
