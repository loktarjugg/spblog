<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'  => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'status' => (boolean) $user->status,
            'is_admin' => (boolean) $user->is_admin
        ];
    }
}
