<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Replyable
 * @package App\Models
 */
class Replyable extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'replies_id',
        'replyable_id',
        'replyable_type'
    ];
}
