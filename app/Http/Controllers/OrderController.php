<?php

namespace App\Http\Controllers;

use App\Repo\Profile\ProfileInterface;
use App\Services\Form\Order\OrderForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;

class OrderController extends Controller
{
    protected $form;
    protected $profile;

    public function __construct(OrderForm $form, ProfileInterface $profile) {
        $this->form = $form;
        $this->profile = $profile;
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
        $profile = $this->profile->findBy('user_id', Auth::user()->id);
        return view('order.checkout', compact('profile'));
    }

    public function thanks(){
        return 'спасибо за заказ';
    }
}
