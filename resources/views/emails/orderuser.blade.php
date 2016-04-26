@extends('emails.main')

@section('content')
    <div>

        @if (!empty($user->name))
            <p>{{ $user->name }}, спасибо за заказ!</p>
        @else
            <p>Уважаемый клиент, спасибо за заказ!</p>
        @endif

        <p>Вы заказали:</p>
        @foreach($orders as $order)
            <h2 style="margin-top: 0;">Заказ #{{ $order->id }} от {{ $order->created_at }}</h2>

            <table>
                <tr>
                    <th width="40%">Товар</th>
                    <th width="20%">Цена</th>
                    <th width="20%">Кол-во</th>
                    <th width="20%">Всего</th>
                </tr>
                @foreach($order->cartItems as $item)
                    <td width="40%"><a href="{{ route('product.page', $item->product_id ) }}">{{ $item->name }}</a></td>
                    <td width="20%">{{ $item->final_price }} руб.</td>
                    <td width="20%">{{ $item->quantity }}</td>
                    <td width="20%">{{ $item->total }} руб.</td>
                @endforeach
                <tr>
                    <th>Поставщик</th>
                    <th>{{ $order->supplier->name }}</th>
                    <th colspan="2" align="right">Итого: {{ $order->total }} руб.</th>
                </tr>
            </table>

        @endforeach

    </div>
@endsection