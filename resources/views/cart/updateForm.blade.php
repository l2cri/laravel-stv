<form id="updateCartForm">

    {{ csrf_field() }}

    <input type="hidden" name="deliveryCost" value="300" />

    <div class="table-responsive">
        <table class="cart-table">
            <tr>
                <th class="column-1">Название</th>
                <th class="column-2">Цена</th>
                <th class="column-2">Цена со скидкой</th>
                <th class="column-3">Кол-во</th>
                <th class="column-4">Всего</th>
                <th class="column-5"></th>
            </tr>

            @foreach($items as $item)

                <tr>
                    <td>
                        <div class="traditional-cart-entry">
                            <a href="{{ route('product.page', $item->id) }}" class="image"><img src="{{ @url($item->attributes['file']) }}" alt=""></a>
                            <div class="content">
                                <div class="cell-view">
                                    <a href="{{ url($item->attributes['section_url']) }}" class="tag">
                                        {{ $item->attributes['section_name'] }}</a>
                                    <a href="{{ route('product.page', $item->id) }}" class="title">{{ $item->name }}</a>
                                    {{--<div class="inline-description">S / Dirty Pink</div>--}}
                                    <div class="inline-description">{{ $item->attributes['supplier_name'] }}</div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->getPriceWithConditions() }}</td>
                    <td class="nopadding">
                        <div class="quantity-selector detail-info-entry">
                            <div class="entry number-minus-update" data-id="{{ $item->id }}">&nbsp;</div>
                            <div class="entry number">{{ $item->quantity }}</div>
                            <div class="entry number-plus-update" data-id="{{ $item->id }}">&nbsp;</div>
                        </div>

                        <input autocomplete="off" type="hidden" id="item{{ $item->id }}" name="cartIds[{{ $item->id }}]" value="{{ $item->quantity }}">

                    </td>
                    <td><div class="subtotal">{{ $item->getPriceSumWithConditions() }}</div></td>
                    <td><a href="{{ route('cart.delete', $item->id) }}" class="remove-button"><i class="fa fa-times"></i></a></td>
                </tr>

            @endforeach

        </table>
    </div>
</form>