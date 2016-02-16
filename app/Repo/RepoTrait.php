<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.02.16
 * Time: 18:44
 */

namespace App\Repo;


trait RepoTrait
{
    // protected $model - предполагается, что в родительском классе модель определена
    public function create(array $data){
        return $this->model->create($data);
    }

    public function byId($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    public function findBy($attribute, $value, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }
}