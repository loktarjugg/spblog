<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $fillable = [
        'source',
        'user_id',
        'vote_count',
        'body',
        'body_original'
    ];

    public function user()
    {
        return $this->hasOne(User::class , 'id' ,'user_id');
    }

    public function articles()
    {
        return $this->morphedByMany(Article::class , 'replyable','replyables','replyable_id','replies_id');
    }
}
