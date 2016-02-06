<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 04.02.16
 * Time: 19:27
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repo\Product\ProductInterface;
use App\Services\Form\Cart\CartForm;

class CartController extends Controller {

    protected $product;
    protected $form;

    public function __construct(ProductInterface $product, CartForm $form) {
        $this->product = $product;
        $this->form = $form;
    }

    public function index(){
        return view('cart.index');
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
}