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

        if ($productId) {
            $this->action->applyOne($actionId, $productId);
        } else {
            $this->action->applyAll($actionId, supplierId());
        }
    }

    public function revoke($actionId, $productId = null){

        if ($productId) {
            $this->action->revokeOne($actionId, $productId);
        } else {
            $this->action->revokeAll($actionId, supplierId());
        }
    }

    public function save(array $input){

        if ( ! $this->valid($input) ) return false;

        $input['supplier_id'] = supplierId();
        $this->action->create($input);

        return true;
    }

    public function update(array $input) {
        if (!$this->valid($input)) return false;

        $actionId = $input['actionId'];
        unset($input['actionId']);
        unset($input['_token']);
        $this->action->update($input, $actionId);
        return true;
    }

    public function delete($id) {
        $this->action->delete($id);
        $this->action->revokeAll($id, supplierId());
    }
}