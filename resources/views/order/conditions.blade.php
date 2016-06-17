@if($order->conditions)

    @foreach($order->conditions as $condition)

        @if($condition->type == 'delivery')

            <div class="row no-gutter order-conditions">
                <div class="col-md-12 no-gutter" style="text-align: right">
                    <b>Доставка: <i class="fa fa-rub"></i> {{ $condition->value }} <br>
                    <span class="red">Итого с доставкой: <i class="fa fa-rub"></i> {{ $order->total + $condition->value }}</span> </b>
                </div>
            </div>

        @endif

    @endforeach
    {{--Здесь может быть общее итого заказа с доставкой, какими-то скидками --}}

@endif