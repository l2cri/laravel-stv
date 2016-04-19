<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 19.04.16
 * Time: 12:36
 */

namespace App\Repo\Banners;


use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;

class EloquentBanner implements BannerInterface
{
    use RepoTrait;
    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function sortable($order,$by,$type = null){
        return $this->model->where('type',$type)->orderBy($order,$by)->get();
    }
}