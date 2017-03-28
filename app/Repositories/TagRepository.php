<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/6
 * Time: 14:23
 */

namespace App\Repositories;


use Conner\Tagging\Model\Tag;

/**
 * Class TagRepository
 * @package App\Repositories
 */
class TagRepository
{
    use BaseRepository;
    /**
     * @var Tag
     */
    protected $model;

    /**
     * TagRepository constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * @return mixed
     */
    public function lists()
    {
        $tags = $this->model;

        if (\Request::has('groups')){
            $tags = $tags->inGroup(\Request::get('groups'));
        }

        return $this->paginate($tags , 50 , 'id','asc');
    }
}