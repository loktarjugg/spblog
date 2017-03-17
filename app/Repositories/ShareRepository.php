<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/7
 * Time: 17:40
 */

namespace App\Repositories;


use App\Models\Share;

class ShareRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Share $share)
    {
        $this->model = $share;
    }

}