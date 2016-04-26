<table>
    <tr>
        <th width="40%">Товар</th>
        <th width="20%">Цена</th>
        <th width="20%">Кол-во</th>
        <th width="20%">Всего</th>
    </tr>
    @foreach($order->cartItems as $item)
        <td width="40%"><a href="{{ route('product.page', $item->product_id ) }}" target="_blank">{{ $item->name }}</a></td>
        <td width="20%">{{ $item->final_price }} руб.</td>
        <td width="20%">{{ $item->quantity }}</td>
        <td width="20%">{{ $item->total }} руб.</td>
    @endforeach
    <tr>
        <th colspan="4" align="right">Итого: {{ $order->total }} руб.</th>
    </tr>
</table>