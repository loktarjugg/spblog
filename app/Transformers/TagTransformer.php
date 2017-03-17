<?php

namespace App\Transformers;

use Conner\Tagging\Model\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Tag $tag)
    {
        return [
            'name' => $tag->name,
            'count' => (int) $tag->count,
            'slug'  => $tag->slug
        ];
    }
}
