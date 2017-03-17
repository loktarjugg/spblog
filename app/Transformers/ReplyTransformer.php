<?php

namespace App\Transformers;

use App\Models\Reply;
use League\Fractal\TransformerAbstract;

class ReplyTransformer extends TransformerAbstract
{

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

    public function includeUsers(Reply $reply)
    {
        $user = $reply->user;

        return $this->item($user , new UserTransformer,false);
    }


}
