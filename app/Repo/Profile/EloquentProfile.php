<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.02.16
 * Time: 17:31
 */

namespace App\Repo\Profile;


use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;

class EloquentProfile implements ProfileInterface
{

    use RepoTrait;

    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function mainProfile($userId)
    {
        $mainProfile = $this->model->where('user_id', '=', $userId)->whereNotNull('main')->first();
        if (empty($mainProfile)) $mainProfile = $this->model->where('user_id', '=', $userId)->first();

        return $mainProfile;
    }

    public function profiles($userId)
    {
        return $this->findAllBy('user_id', $userId);
    }


}