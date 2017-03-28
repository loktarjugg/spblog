<?php

namespace App\Models;

use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Share
 * @package App\Models
 */
class Share extends Model
{
    use Taggable;
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'logo',
        'content',
        'link'
    ];
}
