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
}