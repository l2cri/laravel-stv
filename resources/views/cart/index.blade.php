@extends('main')

@section('content')
    
    <div class="breadcrumb-box">
        <a href="{{ url('/') }}">Главная</a>
        <a href="#">Корзина</a>
    </div>

    <div class="information-blocks">
        <div class="table-responsive">
            <table class="cart-table">
                <tr>
                    <th class="column-1">Название</th>
                    <th class="column-2">Цена</th>
                    <th class="column-3">Кол-во</th>
                    <th class="column-4">Всего</th>
                    <th class="column-5"></th>
                </tr>

                @foreach($items as $item)
                    <tr>
                        <td>
                            <div class="traditional-cart-entry">
                                <a href="#" class="image"><img src="img/product-minimal-1.jpg" alt=""></a>
                                <div class="content">
                                    <div class="cell-view">
                                        <a href="#" class="tag">woman clothing</a>
                                        <a href="{{ route('product.page', $item->id) }}" class="title">{{ $item->name }}</a>
                                        {{--<div class="inline-description">S / Dirty Pink</div>--}}
                                        {{--<div class="inline-description">Zigzag Clothing</div>--}}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $item->price }}</td>
                        <td class="nopadding">
                            <div class="quantity-selector detail-info-entry">
                                <div class="entry number-minus">&nbsp;</div>
                                <div class="entry number">{{ $item->quantity }}</div>
                                <div class="entry number-plus">&nbsp;</div>
                            </div>
                        </td>
                        <td><div class="subtotal">{{ $item->getPriceSum() }}</div></td>
                        <td><a class="remove-button"><i class="fa fa-times"></i></a></td>
                    </tr>
                @endforeach

            </table>
        </div>
        <div class="cart-submit-buttons-box">
            <a class="button style-15">Продолжить покупки</a>
            <a class="button style-15">Пересчитать корзину</a>
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
                    <div class="sub-total">Итого: 990,00 <i class="fa fa-rub"></i></div>
                    <div class="grand-total">Итого с доставкой 1029,79 <i class="fa fa-rub"></i></div>
                    <a class="button style-10" href="#">Оформить заказ</a>
                </div>
            </div>
        </div>
    </div>

@endsection