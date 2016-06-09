@if($order->conditions)

    @foreach($order->conditions as $condition)

        @if($condition->type == 'delivery')

            <tr>
                <th colspan="2"></th>
                <th colspan="2">
                    <span class="pull-right" style="text-align: right">
                        Доставка: <i class="fa fa-rub"></i> {{ $condition->value }} <br>
                        Итого с доставкой: <i class="fa fa-rub"></i> {{ $order->total + $condition->value }}
                    </span>
                </th>
            </tr>

        @endif

    @endforeach
    {{--Здесь может быть общее итого заказа с доставкой, какими-то скидками --}}

@endif