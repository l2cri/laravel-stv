@extends('emails.main')

@section('content')
    <div>

        @foreach($orders as $order)
            <h2 style="margin-top: 0;">Заказ #{{ $order->id }} от {{ $order->created_at }}</h2>
        @endforeach

        @if (!empty($user->name))
            <p>{{ $user->name }}, спасибо за заказ!</p>
        @else
            <p>Уважаемый клиент, спасибо за заказ!</p>
        @endif

        <p>Вы заказали:</p>
        @foreach($orders as $order)

            <table>
                <tr>
                    <th>Товар</th>
                    <th>Цена</th>
                    <th>Кол-во</th>
                    <th>Всего</th>
                </tr>
                @foreach($order->cartItems as $item)
                    <td><a href="{{ route('product.page', $item->product_id ) }}">{{ $item->name }}</a></td>
                    <td>{{ $item->final_price }} руб.</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->total }} руб.</td>
                @endforeach
                <tr>
                    <th colspan="4" align="right">{{ $order->total }} руб.</th>
                </tr>
            </table>

        @endforeach

    </div>
@endsection