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


    public function store($data)
    {
        $this->model->fill($data)->save();

        $this->model->tag($data['tags']);

        $this->model->tags->map(function ($tag) {
            if (!$tag->isInGroup('share')) {
                $tag->setGroup('share');
            }
        });

        return true;
    }

    public function update($data, $id)
    {

        $this->model = $this->getById($id);

        $tags = collect($data['tags'])->pluck('name');

        $this->model->retag($tags->toArray());

        $this->model->tags->map(function ($tag) {
            if (!$tag->isInGroup('share')) {
                $tag->setGroup('share');
            }
        });

        return $this->save($this->model, $data);
    }

}