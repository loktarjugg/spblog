<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Replyable extends Model
{
    protected $fillable = [
        'replies_id',
        'replyable_id',
        'replyable_type'
    ];
}
