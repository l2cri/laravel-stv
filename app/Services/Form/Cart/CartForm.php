<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 05.02.16
 * Time: 21:06
 */

namespace App\Services\Form\Cart;

use App\Repo\Cart\CartInterface;
use Cart;
use App\Repo\Product\ProductInterface;

class CartForm
{
    protected $product;
    protected $cart;

    public function __construct(ProductInterface $product, CartInterface $cart){
        $this->product = $product;
        $this->cart = $cart;
        $this->app = app();
    }

    // $data - айди товара и кол-во
    //
    public function add($data){

        if (!Cart::has($data['product_id'])){

            $product = $this->product->byId($data['product_id']);

            $attributes = array( 'unit' => $product->unit,
                                 'file' => $product->photos[0]->file,
                                 'section_url' => $product->sections[0]->url,
                                 'section_name' => $product->sections[0]->name,
                                 'supplier_name' => $product->supplier->name,
                                 'supplier_id' => $product->supplier->id,
                                 'whosale_price' => $product-> whosale_price
                                );
            Cart::add($product->id, $product->name, $product->price, $data['qnt'], $attributes);

            if ( Cart::has($product->id) ) {

                $this->cart->cartConditions(Cart::get($product->id), app('cart'));

                return true;
            }

        } else {
            Cart::update($data['product_id'], array( 'quantity' => $data['qnt'] ));
            $this->cart->cartConditions(Cart::get($data['product_id']), app('cart'));
            return true;
        }

        return false;
    }

    public function update($data){

        foreach($data['cartIds'] as $id => $qnt){
            Cart::update($id, array(
                'quantity' => array(
                    'relative' => false, // чтобы не прибавляло или убавляло, а ставило жестко
                    'value' => $qnt
                ),
            ));

            $this->cart->cartConditions(Cart::get($id), app('cart'));
        }
    }

    public function delete($id) {
        Cart::remove($id);
    }

    public function save() {
        // вытащить все товары и сохранить их в таблицу cart_items
    }


}