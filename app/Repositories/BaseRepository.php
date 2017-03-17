<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/6
 * Time: 10:27
 */

namespace App\Repositories;


trait BaseRepository
{

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

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

    public function page($per_count = 10 , $sortColumn ='created_at' ,$sort = 'desc')
    {
        return $this->paginate($this->model , $per_count , $sortColumn , $sort);
    }

    public function paginate($model , $per_count = 10 , $sortColumn ='id' ,$sort = 'desc')
    {
        return $model->orderBy($sortColumn , $sort)->paginate($per_count);
    }

    public function store($data)
    {
        return $this->save($this->model , $data);
    }

    public function save($model , $data)
    {
        $model->fill($data);

        $model->save();

        return $model;
    }
}