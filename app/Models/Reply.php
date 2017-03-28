<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reply
 * @package App\Models
 */
class Reply extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'source',
        'user_id',
        'vote_count',
        'body',
        'body_original'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class , 'id' ,'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function articles()
    {
        return $this->morphedByMany(Article::class , 'replyable','replyables','replyable_id','replies_id');
    }
}
