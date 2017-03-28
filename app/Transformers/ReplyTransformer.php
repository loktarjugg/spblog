<?php

namespace App\Transformers;

use App\Models\Reply;
use League\Fractal\TransformerAbstract;

/**
 * Class ReplyTransformer
 * @package App\Transformers
 */
class ReplyTransformer extends TransformerAbstract
{

    /**
     * @var array
     */
    protected $defaultIncludes =[
        'users'
    ];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Reply $reply)
    {
        return [
            'vote_count' => $reply->vote_count,
            'body'   => $reply->body
        ];
    }

    /**
     * @param Reply $reply
     * @return \League\Fractal\Resource\Item
     */
    public function includeUsers(Reply $reply)
    {
        $user = $reply->user;

        return $this->item($user , new UserTransformer,false);
    }


}
