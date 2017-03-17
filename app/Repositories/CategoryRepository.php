<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/6
 * Time: 12:54
 */

namespace App\Repositories;


use App\Models\Category;

class CategoryRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}