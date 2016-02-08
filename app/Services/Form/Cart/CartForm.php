<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 05.02.16
 * Time: 21:06
 */

namespace App\Services\Form\Cart;

use Cart;
use App\Repo\Product\ProductInterface;

class CartForm
{
    protected $product;

    public function __construct(ProductInterface $product){
        $this->product = $product;
    }

    // $data - айди товара и кол-во
    //
    public function add($data){

        if (!Cart::has($data['product_id'])){
            $product = $this->product->byId($data['product_id']);
            Cart::add($product->id, $product->name, $product->price, $data['qnt'], array());
            if ( Cart::has($product->id) ) return true;
        } else {
            Cart::update($data['product_id'], array( 'quantity' => $data['qnt'] ));
            return true;
        }

        return false;
    }

    public function delete($id) {
        Cart::remove($id);
    }
}