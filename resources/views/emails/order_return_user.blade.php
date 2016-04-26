@extends('emails.main')

@section('content')
    <div>

        <h2 style="margin-top: 0;">Возврат заказа
            <a href="{{ route('panel::userorder', $order->id) }}" target="_blank">#{{ $order->id }}</a>
            от {{ $order->created_at }}</h2>

        <p>Уважаемый <strong>{{ $user->name }}</strong>, Вы возвращаете заказ от поставщика <strong>{{ $supplier->name }}</strong></p>

        @include('emails.order', ['order' => $order])
    </div>
@endsection