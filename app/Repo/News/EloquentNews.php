<?php
/**
 * Created by PhpStorm.
 * User: Unizoo5
 * Date: 14.03.2016
 * Time: 17:06
 */

namespace App\Repo\News;

use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;


class EloquentNews implements  NewsInterface
{
    use RepoTrait;

    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function getList()
    {
        return $this->model->orderBy('created_at', 'desc')->paginable();
    }
}