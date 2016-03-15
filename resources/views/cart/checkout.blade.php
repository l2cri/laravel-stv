<div class="table-responsive">
    <table class="cart-table">
        <tr>
            <th class="column-1">Название</th>
            <th class="column-2">Цена</th>
            <th class="column-2">Цена со скидкой</th>
            <th class="column-3">Кол-во</th>
            <th class="column-4">Всего</th>
        </tr>

        @foreach($items as $item)

            <?
                $conditions = array();
                foreach($item->conditions as $condition) {
                    $arr = $condition->getAttributes();
                    if (isset($arr['name'])) $conditions[] = $arr['name'];
                }
            ?>

            <tr>
                <td>
                    <div class="traditional-cart-entry">
                        <a href="{{ route('product.page', $item->id) }}" class="image"><img src="{{ @url($item->attributes['file']) }}" alt=""></a>
                        <div class="content">
                            <div class="cell-view">
                                <a href="{{ url($item->attributes['section_url']) }}" class="tag">
                                    {{ $item->attributes['section_name'] }}</a>
                                <a href="{{ route('product.page', $item->id) }}" class="title">{{ $item->name }}
                                    @foreach($conditions as $conditionName)
                                        <span class="inline-label red">{{ $conditionName }}</span>
                                    @endforeach
                                </a>
                                {{--<div class="inline-description">S / Dirty Pink</div>--}}
                                <div class="inline-description">{{ $item->attributes['supplier_name'] }}</div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->getPriceWithConditions() }}</td>
                <td>{{ $item->quantity }}</td>
                <td><div class="subtotal">{{ $item->getPriceSumWithConditions() }}</div></td>
            </tr>

        @endforeach

    </table>
</div>