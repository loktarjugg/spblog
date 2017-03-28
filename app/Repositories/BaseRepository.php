<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/6
 * Time: 10:27
 */

namespace App\Repositories;


/**
 * Class BaseRepository
 * @package App\Repositories
 */
/**
 * Class BaseRepository
 * @package App\Repositories
 */
trait BaseRepository
{

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function lists()
    {
        $model = $this->model;

        if (\Request::has('title')){
            $model = $model->orWhere('title' , 'like' ,'%' . \Request::get('title') .'%');
        }

        if (\Request::has('tags')){
            $model = $model->withAllTags(\Request::get('tags'));
        }

        $per_count = \Request::has('per_count') ? (int) \Request::get('per_count') : 10;

        return $this->paginate($model , $per_count);

    }

    /**
     * @param int $per_count
     * @param string $sortColumn
     * @param string $sort
     * @return mixed
     */
    public function page($per_count = 10 , $sortColumn ='created_at' , $sort = 'desc')
    {
        return $this->paginate($this->model , $per_count , $sortColumn , $sort);
    }

    /**
     * @param $model
     * @param int $per_count
     * @param string $sortColumn
     * @param string $sort
     * @return mixed
     */
    public function paginate($model , $per_count = 10 , $sortColumn ='id' , $sort = 'desc')
    {
        return $model->orderBy($sortColumn , $sort)->paginate($per_count);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->save($this->model , $data);
    }

    /**
     * @param $model
     * @param $data
     * @return mixed
     */
    public function save($model , $data)
    {
        $model->fill($data);

        $model->save();

        return $model;
    }
}