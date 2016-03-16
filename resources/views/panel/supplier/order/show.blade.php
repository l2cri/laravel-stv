@extends('panel.index')

@section('panel_content')

    <div class="row information-blocks sections-panel article-container style-2">
        <div class="col-md-12">

            <h1>Заказ № {{ $order->id }}</h1>

            <table class="table table-striped panel">
                <tr>
                    <th>Итого</th>
                    <td>{{ $order->subtotal }} <i class="fa fa-rub"></i></td>
                </tr>
                <tr>
                    <th>Итого со скидками</th>
                    <td>{{ $order->total }} <i class="fa fa-rub"></i></td>
                </tr>
                <tr>
                    <th>Комментарий</th>
                    <td>{{ $order->comment }}</td>
                </tr>
            </table>

            <h1>Клиент {{ $order->profile->person }}</h1>

            <table class="table table-striped panel">
                <tr>
                    <th>Телефон</th>
                    <td>{{ $order->profile->phone }}</td>
                </tr>
                <tr>
                    <th>Адрес</th>
                    <td>{{ $order->profile->address }}</td>
                </tr>
            </table>

            <h1>Корзина</h1>

            <div class="table-responsive">
                <table class="cart-table">
                    <tr>
                        <th class="column-1">Название</th>
                        <th class="column-2">Цена</th>
                        <th class="column-3">Кол-во</th>
                        <th class="column-4">Всего</th>
                    </tr>

                    @foreach($order->cartItems as $item)

                        <?$conditions = \App\StaticHelpers\CartHelper::getConditions($item);?>
                        <? $item->attributes = unserialize($item->attributes) ?>

                        <tr>
                            <td>
                                <div class="traditional-cart-entry">
                                    <a href="{{ route('product.page', $item->id) }}" class="image"><img src="{{ @url($item->attributes['file']) }}" alt=""></a>
                                    <div class="content">
                                        <div class="cell-view">
                                            <a href="{{ url($item->attributes['section_url']) }}" class="tag">
                                                {{ $item->attributes['section_name'] }}</a>
                                            <a href="{{ route('product.page', $item->id) }}" class="title">{{ $item->name }}
                                                @foreach($conditions as $conditionName)
                                                    <span class="inline-label red">{{ $conditionName }}</span>
                                                @endforeach
                                            </a>
                                            {{--<div class="inline-description">S / Dirty Pink</div>--}}
                                            <div class="inline-description">{{ $item->attributes['supplier_name'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->final_price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td><div class="subtotal">{{ $item->total }}</div></td>
                        </tr>

                    @endforeach

                </table>
            </div>

        </div>
    </div>

@endsection