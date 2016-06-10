@if($order->conditions)

    @foreach($order->conditions as $condition)

        @if($condition->type == 'delivery')

            <div class="row">
                <div class="col-md-12" style="text-align: right">
                    Доставка: <i class="fa fa-rub"></i> {{ $condition->value }} <br>
                    Итого с доставкой: <i class="fa fa-rub"></i> {{ $order->total + $condition->value }}
                </div>
            </div>

        @endif

    @endforeach
    {{--Здесь может быть общее итого заказа с доставкой, какими-то скидками --}}

@endif