<?php

namespace App\Transformers;

use App\Models\Share;
use League\Fractal\TransformerAbstract;

/**
 * Class ShareTransformer
 * @package App\Transformers
 */
class ShareTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
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
            'id' => $share->id ,
            'title' => $share->title ,
            'logo'  => $share->logo ,
            'content'=> $share->content,
            'link'  => $share->link
        ];
    }

    /**
     * @param Share $share
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTags(Share $share)
    {
        $tags = $share->tags;

        return $this->collection($tags, new TagTransformer,false);
    }
}
