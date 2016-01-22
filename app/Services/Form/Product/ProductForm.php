<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 21.01.16
 * Time: 2:30
 */

namespace App\Services\Form\Product;

use App\Repo\Product\ProductInterface;
use App\Services\Validation\ValidableInterface;
use Auth;


class ProductForm
{
    protected $data;
    protected $validator;
    protected $product;

    public function __construct(ValidableInterface $validator, ProductInterface $product){
        $this->validator = $validator;
        $this->product = $product;
    }

    public function save(array $input) {

        //var_dump($input); die();

        if ( ! $this->valid($input) ) return false;

        $input['regular_price'] = $input['price'];
        $input['supplier_id'] = $this->getSupplierId();

        return $this->product->create($input)->sections()->attach($input['section_ids']);
    }

    public function errors() {
        return $this->validator->errors();
    }

    protected function valid(array $input){
        return $this->validator->with($input)->passes();
    }

    /**
     * Проверяет, является ли текущий пользователь поставщиком этого товара
     * @return bool
     */
    protected function isValidSupplier($supplierId){

        $suppliers = Auth::user()->suppliers;
        $filtered = $suppliers->where('id', $supplierId);

        if (count($filtered->all() > 0)) return true;

        return false;
    }

    /**
     * Возвращает айди поставщика если он явно в форме не указан - сделано с учетом будующих требований,
     * когда один пользователь сможет иметь несколько компаний на аккаунте
     * @return mixed
     */
    protected function getSupplierId(){
        return Auth::user()->suppliers[0]->id;
    }
}