<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    use BaseRepository;
    protected $model;

    function __construct(User $user)
    {
        $this->model = $user;
    }

    public function lists()
    {
        $model = $this->model->where('is_admin',0);

        return $this->paginate($model);
    }

}