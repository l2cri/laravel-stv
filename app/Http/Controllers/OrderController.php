<?php

namespace App\Http\Controllers;

use App\Services\Form\Order\OrderForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    protected $form;

    public function __construct(OrderForm $form) {
        $this->form = $form;
    }

    public function create(Request $request) {
        $input = removeEmptyValues($request->all());

        if ($this->form->create($input)) {
            return Redirect::to( route('order.thanks') )->with('status', 'success');
        } else {
            return Redirect::back()->withInput()
                                   ->withErrors($this->form->errors())
                                   ->with('status', 'error');
        }
    }

    public function checkout(){
        return view('order.checkout');
    }

    public function thanks(){
        return 'спасибо за заказ';
    }
}
