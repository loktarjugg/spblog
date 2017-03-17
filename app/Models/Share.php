<?php

namespace App\Models;

use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use Taggable;
    protected $fillable = [
        'title',
        'logo',
        'content',
        'link'
    ];
}
