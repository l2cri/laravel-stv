<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 12.05.16
 * Time: 14:59
 */

namespace App\Repo\User;


use App\Repo\RepoTrait;

class EloquentUser implements UserInterface
{
    use RepoTrait;
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }
}