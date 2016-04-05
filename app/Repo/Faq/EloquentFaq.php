<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 05.04.16
 * Time: 16:16
 */

namespace App\Repo\Faq;

use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;

class EloquentFaq implements FaqInterface
{
    use RepoTrait;

    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function paginateByProductId($product_id){

        return $this->model->byProductItems($product_id);
    }

    public function create(array $data)
    {

        /**
         * @todo get this parameter from supplier settings
         */
        $data['moderated'] = 1;

        return $this->model->create($data);
    }

}