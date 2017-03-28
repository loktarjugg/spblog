<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/7
 * Time: 17:40
 */

namespace App\Repositories;


use App\Models\Share;

/**
 * Class ShareRepository
 * @package App\Repositories
 */
class ShareRepository
{
    use BaseRepository;

    /**
     * @var Share
     */
    protected $model;

    /**
     * ShareRepository constructor.
     * @param Share $share
     */
    public function __construct(Share $share)
    {
        $this->model = $share;
    }

}