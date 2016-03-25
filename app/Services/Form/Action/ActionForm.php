<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 25.03.16
 * Time: 19:24
 */

namespace App\Services\Form\Action;


use App\Repo\Action\ActionInterface;
use App\Repo\Product\ProductInterface;
use App\Services\Form\FormTrait;
use App\Services\Validation\ValidableInterface;

class ActionForm
{
    use FormTrait;
    protected $validator;
    protected $action;
    protected $product;

    public function __construct(ValidableInterface $validator, ActionInterface $action,
                                    ProductInterface $product){
        $this->validator = $validator;
        $this->action = $action;
        $this->product = $product;
    }

    public function apply($actionId, $productId = null){
        
    }

    public function revoke($actionId, $productId = null){

    }

    public function activate($actionId){

    }

    public function deactivate($actionId) {

    }
}