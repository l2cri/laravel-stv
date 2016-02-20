<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 20.02.16
 * Time: 15:42
 */

namespace App\Repo;


trait DatatablesTrait
{
    public function datatables($attribute, $value, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->get($columns);
    }
}