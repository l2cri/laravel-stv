@extends('main')

@section('content')

    @section('breadcrumbs', Breadcrumbs::render('common.static-sub',['name'=>'Корзина','url'=> route('cart.index')],'Оформить заказ'))

    <div class="information-blocks" id="checkoutPage">
        <div class="row">
            <div class="col-sm-9 information-entry">

                <form method="post" action="{{ route('order.create') }}">
                    {{ csrf_field() }}

                    <div class="accordeon size-1">

                        <div class="accordeon-title active"><span class="number">1</span>Профиль покупателя</div>
                        <div class="accordeon-entry" style="display: block;">
                            <div class="article-container style-1">
                                @include('order.profile')
                            </div>
                        </div>

                        <div class="accordeon-title active"><span class="number">2</span>Доставка</div>
                        <div class="accordeon-entry" style="display: block;">
                            <div class="article-container style-1">
                                @foreach($deliveries as $delivery)
                                    <label class="checkbox-entry radio">
                                        <input type="radio" name="delivery_id" value="{{ $delivery->id }}"> <span class="check"></span> {{ $delivery->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="accordeon-title active"><span class="number">3</span>Оплата</div>
                        <div class="accordeon-entry" style="display: block;">
                            <div class="article-container style-1">
                                @foreach($payments as $payment)
                                    <label class="checkbox-entry radio">
                                        <input type="radio" name="payment_id" value="{{ $payment->id }}"> <span class="check"></span> {{ $payment->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="accordeon-title active"><span class="number">4</span>Заказ</div>
                        <div class="accordeon-entry" style="display: block;">
                            <div class="article-container style-1">

                                @include('cart.checkout')

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-6 information-entry">
                            <div class="cart-summary-box">
                                <span id="cartTotal">@include('cart.total')</span>
                                <div class="button style-10">Заказать<input type="submit" value=""></div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="col-sm-3 information-entry">

                <div class="information-blocks">
                    <a class="sale-entry vertical" href="#">
                        <span class="hot-mark yellow" style="right: -21px; top: 15px; width: 87px;">помощь</span>
                        <span class="sale-price"><span><i class="fa fa-phone"></i></span> +7 (8652) 777 777</span>
                        <span class="sale-description">Если у Вас возникли вопросы, наши менеджеры с удовольствием на них ответят.</span>
                        <img style="" class="sale-image" src="{{ url('img/callcentr.jpg') }}" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection