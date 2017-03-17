<?php

namespace App\Transformers;

use App\Models\Share;
use League\Fractal\TransformerAbstract;

class ShareTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'tags'
    ];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Share $share)
    {
        return [
            'title' => $share->title ,
            'logo'  => $share->logo ,
            'content'=> $share->content,
            'link'  => $share->link
        ];
    }

    public function includeTags(Share $share)
    {
        $tags = $share->tags;

        return $this->collection($tags, new TagTransformer,false);
    }
}
