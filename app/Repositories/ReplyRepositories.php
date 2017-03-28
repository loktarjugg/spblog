<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/10
 * Time: 17:21
 */

namespace App\Repositories;


use App\Models\Reply;

/**
 * Class ReplyRepositories
 * @package App\Repositories
 */
class ReplyRepositories
{
    /**
     * @var Reply
     */
    protected $model;

    /**
     * ReplyRepositories constructor.
     * @param Reply $reply
     */
    public function __construct(Reply $reply)
    {
        $this->model = $reply;
    }

    /**
     * @param $id
     */
    public function getReplyByArticleId($id)
    {

    }
}