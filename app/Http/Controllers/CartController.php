<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 04.02.16
 * Time: 19:27
 */

namespace App\Http\Controllers;

use App\Repo\Cart\CartInterface;
use Illuminate\Http\Request;
use App\Repo\Product\ProductInterface;
use App\Services\Form\Cart\CartForm;

class CartController extends Controller {

    protected $product;
    protected $form;
    protected $cart;

    public function __construct(ProductInterface $product, CartForm $form, CartInterface $cart) {
        $this->product = $product;
        $this->form = $form;
        $this->cart = $cart;
    }

    public function index(){
        $items = $this->cart->all();
        return view('cart.index', compact('items'));
    }

    // $data - айди товара и кол-во
    public function add(Request $request){

        if ( $this->form->add( $request->all() ) ) {
            $status = 'SUCCESS';
            $message = 'Товар успешно добавлен в корзину!';//'Вы добавили в корзину: '.$product->name.'.'
        } else {
            $status = 'ERROR';
            $message = 'Произошла ошибка с добавлением товара!';
        }

        return response()->json(['status' => $status,
            'message' => $message, 'output' => 'Корзинка']);
    }

    public function delete($id){
        $this->form->delete($id);
        return redirect()->back();
    }
}