<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.02.16
 * Time: 16:02
 */

namespace App\Repo;


interface RepoInterface
{
    public function byId($id);
    public function all($columns = array('*'));
    public function delete($id);
    public function update(array $data, $id, $attribute="id");
    public function create(array $data);
    public function findBy($field, $value, $columns = array('*'));
    public function findAllBy($field, $value, $columns = array('*'));
    public function prefix();
}