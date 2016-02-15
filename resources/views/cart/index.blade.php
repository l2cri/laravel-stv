@extends('main')

@section('content')

    <div class="breadcrumb-box">
        <a href="{{ url('/') }}">Главная</a>
        <a href="#">Корзина</a>
    </div>

    <div class="information-blocks">
        <div id="cartUpdateDiv">

        @include('cart.updateForm')

        </div>

        <div class="cart-submit-buttons-box">
            {{--<a class="button style-15">Продолжить покупки</a>--}}
            {{--<a class="button style-15">Пересчитать корзину</a>--}}
        </div>
        <div class="row">
            <div class="col-md-4 information-entry">
                <h3 class="cart-column-title">Калькулятор доставки</h3>
                <form>

                    <label>Город или населенный пункт</label>
                    <input type="text" value="" placeholder="..." class="simple-field size-1">

                    <label>Индекс</label>
                    <input type="text" value="" placeholder="..." class="simple-field size-1">

                    <div class="button style-16" style="margin-top: 10px;">Посчитать<input type="submit"/></div>
                </form>
            </div>
            <div class="col-md-4 information-entry">
                {{--<h3 class="cart-column-title">Discount Codes <span class="inline-label red">Promotion</span></h3>--}}
                {{--<form>--}}
                    {{--<label>Enter your coupon code if you have one.</label>--}}
                    {{--<input type="text" value="" placeholder="" class="simple-field size-1">--}}
                    {{--<div class="button style-16" style="margin-top: 10px;">Apply Coupon<input type="submit"/></div>--}}
                {{--</form>--}}
            </div>
            <div class="col-md-4 information-entry">
                <div class="cart-summary-box">
                    <span id="cartTotal">@include('cart.total')</span>
                    <a class="button style-10" href="{{ route('order.checkout') }}">Оформить заказ</a>
                </div>
            </div>
        </div>
    </div>

@endsection