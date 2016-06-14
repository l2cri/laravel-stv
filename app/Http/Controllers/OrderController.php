<?php

namespace App\Http\Controllers;

use App\DataTables\SupplierOrdersDataTable;
use App\DataTables\UserOrdersDataTable;
use App\Events\OrderMade;
use App\Events\OrderReturned;
use App\Events\OrderStatusChanged;
use App\Repo\Cart\CartInterface;
use App\Repo\Location\LocationInterface;
use App\Repo\Message\MessageInterface;
use App\Repo\Order\OrderInterface;
use App\Repo\Profile\ProfileInterface;
use App\Services\Delivery\DeliveryServiceInterface;
use App\Services\Form\Cart\CartForm;
use App\Services\Form\Order\OrderForm;
use App\User;
use Illuminate\Http\Request;
use Cart;

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
    protected $deliveryService;
    protected $location;
    protected $cart;

    public function __construct(OrderForm $form, ProfileInterface $profile, OrderInterface $order, CartForm $cartForm,
                                MessageInterface $message, DeliveryServiceInterface $deliveryService,
                                LocationInterface $location, CartInterface $cart) {
        $this->form = $form;
        $this->profile = $profile;
        $this->order = $order;
        $this->cartForm = $cartForm;
        $this->message = $message;
        $this->deliveryService = $deliveryService;
        $this->location = $location;
        $this->cart = $cart;

        $this->middleware('auth', ['except' => ['auth']]);
    }

    public function index(SupplierOrdersDataTable $dataTable) {
        return $dataTable->render('panel.supplier.order.datatablesupplier');
    }

    public function getUserOrders(UserOrdersDataTable $dataTable) {
        return $dataTable->render('panel.user.order.datatable');
    }

    public function create(Request $request) {
        $input = removeEmptyValues($request->all());


        if ($orders = $this->form->create($input)) {

            /**
             * EVENT
             */
            event(new OrderMade($orders, userId()));

            return Redirect::to( route('order.thanks', serialize($orders)) );
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

        /**
         * достаем доставки боксберри
         */
        //$locationId = isset($profile) ? $profile->location_id : $this->location->getSessionLocation();
//        $location = $this->location->getSessionLocation();

        if (isset($profile) && !empty($profile->location_id)){
            $location = $this->location->byId($profile->location_id);
        } else $location = $this->location->getSessionLocation();

        $zip = isset($profile) ? $profile->zip : false;
        $deliveries = $this->deliveryService->getDeliveries(
            $location->id,
            Cart::getTotal(), // это из корзины возвращать
            0, // сумма доставки неизвестна - 0
            Cart::getTotal(), // сумма к оплате пока равна общей сумме, без доставки
            $this->cart->weight(), // вес из корзины
            0, // объем из корзины
            $zip);   // зип из профиля, а если профиль пуст, то взять любой зип из города, второй, первый основной индекс - лагает

        //$deliveries = $this->order->deliveries();
        $payments = $this->order->payments();

        return view('order.checkout', compact('profile', 'profiles', 'deliveries', 'payments', 'location'));
    }

    public function thanks($orders = null){

        $ordersCollection = array();
        if ($orders){
            $ordersCollection = $this->order->byWhereIn('id', unserialize($orders));
        }

        return view('order.thanks', compact('ordersCollection'));//'спасибо за заказ';
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

        $statusChanged = $this->form->update($request->all());
        if ($statusChanged) event(new OrderStatusChanged($request->get('orderId'), userId()));

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

        /**
         * EVENT
         */
        event( new OrderReturned($orderId, userId()) );

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
