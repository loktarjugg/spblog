<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/10
 * Time: 17:21
 */

namespace App\Repositories;


use App\Models\Reply;

class ReplyRepositories
{
    protected $model;

    public function __construct(Reply $reply)
    {
        $this->model = $reply;
    }

    public function getReplyByArticleId($id)
    {

    }
}