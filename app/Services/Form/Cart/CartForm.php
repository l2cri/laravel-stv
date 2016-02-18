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

            $attributes = array( 'unit' => $product->unit,
                                 'file' => $product->photos[0]->file,
                                 'section_url' => $product->sections[0]->url,
                                 'section_name' => $product->sections[0]->name,
                                 'supplier_name' => $product->supplier->name,
                                 'supplier_id' => $product->supplier->id,
                                );
            Cart::add($product->id, $product->name, $product->price, $data['qnt'], $attributes);

            if ( Cart::has($product->id) ) return true;

        } else {
            Cart::update($data['product_id'], array( 'quantity' => $data['qnt'] ));
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
        }
    }

    public function delete($id) {
        Cart::remove($id);
    }

    public function save() {
        // вытащить все товары и сохранить их в таблицу cart_items
    }
}