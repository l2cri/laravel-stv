@extends('emails.main')

@section('content')
    <div>

        <h2 style="margin-top: 0;">Смена статуса заказа
            <a href="{{ route('panel::userorder', $order->id) }}" target="_blank">#{{ $order->id }}</a>
            от {{ $order->created_at }} на "{{ $order->status->name }}"</h2>

        <p>Уважаемый <strong>{{ $user->name }}</strong>, статус Вашего заказа изменен на <strong style="color: {{ $order->status->color }}">"{{ $order->status->name }}"</strong></p>

        @include('emails.order', ['order' => $order])
    </div>
@endsection