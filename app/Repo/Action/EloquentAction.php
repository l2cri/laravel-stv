<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 25.03.16
 * Time: 17:40
 */

namespace App\Repo\Action;

use App\Repo\RepoTrait;

class EloquentAction implements ActionInterface
{
    use RepoTrait;

    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }
}