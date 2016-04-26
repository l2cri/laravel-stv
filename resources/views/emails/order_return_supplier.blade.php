@extends('emails.main')

@section('content')
    <div>

        <h2 style="margin-top: 0;">Возврат заказа
            <a href="{{ route('panel::ordersupplier.page', $order->id) }}" target="_blank">#{{ $order->id }}</a>
            от {{ $order->created_at }}</h2>

        <p>Уважаемый <strong>{{ $supplier->user->name }}</strong>, Вам возвращает заказ клиент <strong>{{ $user->name }}</strong></p>

        @include('emails.order', ['order' => $order])

    </div>
@endsection