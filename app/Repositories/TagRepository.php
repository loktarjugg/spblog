<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/6
 * Time: 14:23
 */

namespace App\Repositories;


use Conner\Tagging\Model\Tag;

class TagRepository
{
    use BaseRepository;
    protected $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    public function lists()
    {
        $tags = $this->model;

        if (\Request::has('groups')){
            $tags = $tags->inGroup(\Request::get('groups'));
        }

        return $this->paginate($tags , 50 , 'id','asc');
    }
}