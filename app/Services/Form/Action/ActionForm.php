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

            $action = $this->action->byId($actionId);
            $product = $this->product->byId($productId);
            $product->action()->associate($action);
            $product->save();

        } else {
            $data = array('action_id' => $actionId);
            $this->product->update($data, supplierId(), 'supplier_id');
        }
    }

    public function revoke($actionId, $productId = null){

        $data = ['action_id' => null];

        if ($productId) {
            $this->product->update($data, $productId);
        } else {
            //TODO move to ProductInterface
            foreach ( $this->product->bySupplier(supplierId()) as $product){
                if ($product->action_id == $actionId)
                    $this->product->update($data, $product->id);
            }
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

        //TODO move to ProductInterface
        foreach ( $this->product->bySupplier(supplierId()) as $product){
            if ($product->action_id == $id)
                $this->product->update(['action_id'=>null], $product->id);
        }
    }
}