<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 08.02.16
 * Time: 18:44
 */

namespace App\Http\ViewComposers;

use App\Repo\Cart\CartInterface;
use Illuminate\View\View;

class CartUpdateFormComposer
{
    protected $cart;

    public function __construct(CartInterface $cart){
        $this->cart = $cart;
    }

    public function compose(View $view)
    {
        $view->with('items', $this->cart->all());
    }
}
