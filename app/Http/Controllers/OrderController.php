<?php

namespace App\Http\Controllers;

use App\DataTables\SupplierOrdersDataTable;
use App\DataTables\UserOrdersDataTable;
use App\Repo\Message\MessageInterface;
use App\Repo\Order\OrderInterface;
use App\Repo\Profile\ProfileInterface;
use App\Services\Form\Cart\CartForm;
use App\Services\Form\Order\OrderForm;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Input;

class OrderController extends Controller
{
    protected $form;
    protected $profile;
    protected $order;
    protected $cartForm;
    protected $message;

    public function __construct(OrderForm $form, ProfileInterface $profile, OrderInterface $order, CartForm $cartForm, MessageInterface $message) {
        $this->form = $form;
        $this->profile = $profile;
        $this->order = $order;
        $this->cartForm = $cartForm;
        $this->message = $message;

        $this->middleware('auth');
    }

    public function index(SupplierOrdersDataTable $dataTable) {
        return $dataTable->render('panel.supplier.order.datatablesupplier');
    }

    public function getUserOrders(UserOrdersDataTable $dataTable) {
        return $dataTable->render('panel.user.order.datatable');
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

        $user = Auth::user();

        if ( $user instanceof User ) {
            $profile = $this->profile->mainProfile(Auth::user()->id);
            $profiles = $this->profile->profiles(Auth::user()->id);
        }

        if ( !empty( Input::get('profileId') ) ) $profile = $this->profile->byId( Input::get('profileId') );

        return view('order.checkout', compact('profile', 'profiles'));
    }

    public function thanks(){
        return 'спасибо за заказ';
    }

    public function supplierorder($id) {

        $order = $this->order->byId($id);
        $this->message->supplierSaw($id); // поставщик просмотрел новые сообщения

        return view('panel.supplier.order.show', compact('order'));
    }

    public function userrorder($id) {
        $order = $this->order->byId($id);
        $this->message->userSaw($id); // пользователь просмотрел новые сообщения
        return view('panel.user.order.show', compact('order'));
    }

    public function auth(){
        return view('order.auth');
    }

    public function orderedit($id) {
        $order = $this->order->byId($id);
        $statuses = $this->order->statuses();
        return view('panel.supplier.order.edit', compact('order', 'statuses'));
    }

    public function cartupdate(Request $request){
        $this->form->updateOrderCart($request->all());
    }

    public function update(Request $request){

        // чтобы не создавать отдельного валидатора
        $this->validate($request, [
            'orderId' => 'required|numeric',
            'orderstatus' => 'required|numeric',
            'innercomment' => 'string',
        ]);

        $this->form->update($request->all());
        return redirect()->back();
    }

    public function cartadd(Request $request){
        $this->form->addOrderCartItem($request->all());
    }

    public function cartdelete(Request $request){
        $this->form->deleteOrderCartItem($request->all());
        return redirect()->back();
    }

    public function conditionDelete($orderId, $conditionId){
        $this->form->deleteCondition($orderId, $conditionId);
        return redirect()->back();
    }

    public function delete($id) {
        $this->order->delete($id);
        return redirect()->back();
    }

    public function returnOrder($orderId){
        $this->form->returnOrder($orderId);
        return redirect()->back();
    }

    public function repeat($orderId){
        $this->cartForm->addFromOrder($orderId);
        return redirect(route('cart.index'));
    }

    public function saveUserMessage(Request $request){
        $this->validate($request, [
            'order_id' => 'required|numeric',
            'text' => 'required|string',
        ]);

        $this->form->saveUserMessage($request->all());

        return redirect()->back();
    }

    public function saveSupplierMessage(Request $request){
        $this->validate($request, [
            'order_id' => 'required|numeric',
            'text' => 'required|string',
        ]);

        $this->form->saveSupplierMessage($request->all());

        return redirect()->back();
    }
}
