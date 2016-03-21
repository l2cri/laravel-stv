@extends('panel.index')

@section('panel_content')

    <div class="row information-blocks sections-panel article-container style-2">
        <div class="col-md-12">

            <h1>Заказ № {{ $order->id }}</h1>

            <table class="table table-striped panel">
                <tr>
                    <th>Итого</th>
                    <td>{{ $order->subtotal }} <i class="fa fa-rub"></i></td>
                </tr>
                <tr>
                    <th>Итого со скидками</th>
                    <td>{{ $order->total }} <i class="fa fa-rub"></i></td>
                </tr>
                <tr>
                    <th>Комментарий</th>
                    <td>{{ $order->comment }}</td>
                </tr>
            </table>

            <h1>Клиент {{ $order->profile->person }}</h1>

            <table class="table table-striped panel">
                <tr>
                    <th>Телефон</th>
                    <td>{{ $order->profile->phone }}</td>
                </tr>
                <tr>
                    <th>Адрес</th>
                    <td>{{ $order->profile->address }}</td>
                </tr>
            </table>

            <h1>Корзина</h1>

            <div id="addToCartSearchDiv">
                <input class="typeahead simple-field" type="text" placeholder="Добавить в заказ">
            </div>


            <div class="error-content"></div>
            <div id="cartdiv">
                <form id="updateOrderCartForm" action="{{ route("panel::ordercart.update") }}" method="post">

                    {{ csrf_field() }}

                    <input type="hidden" name="deliveryCost" value="300" />
                    <input type="hidden" name="orderId" value="{{ $order->id }}">

                    <div class="table-responsive">
                        <table class="cart-table">
                            <tr>
                                <th class="column-1">Название</th>
                                <th class="column-2">Цена</th>
                                <th class="column-3">Кол-во</th>
                                <th class="column-4">Всего</th>
                                <th class="column-5"></th>
                            </tr>

                            @foreach($order->cartItems as $item)
                                <?$conditions = \App\StaticHelpers\CartHelper::getConditions($item);?>
                                <? $item->attributes = unserialize($item->attributes) ?>

                                @foreach($item->conditions as $condition)
                                @endforeach

                                <tr>
                                    <td>
                                        <div class="traditional-cart-entry">
                                            <a href="{{ route('product.page', $item->product_id) }}" class="image"><img src="{{ @url($item->attributes['file']) }}" alt=""></a>
                                            <div class="content">
                                                <div class="cell-view">
                                                    <a href="{{ url($item->attributes['section_url']) }}" class="tag">
                                                        {{ $item->attributes['section_name'] }}</a>
                                                    <a href="{{ route('product.page', $item->product_id) }}" class="title">{{ $item->name }}
                                                    </a>
                                                    @foreach($conditions as $conditionId => $conditionName)
                                                        <span class="inline-label red"> <a href="{{ route('panel::ordercondition.delete', [$order->id, $conditionId]) }}" title="Удалить"><i class="fa fa-remove"></i></a> {{ $conditionName }}  </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->final_price }}</td>
                                    <td class="nopadding">
                                        <div class="quantity-selector detail-info-entry">
                                            <div class="entry ordercart-minus minus" data-id="{{ $item->id }}">&nbsp;</div>
                                            <div class="entry number">{{ $item->quantity }}</div>
                                            <div class="entry ordercart-plus plus" data-id="{{ $item->id }}">&nbsp;</div>
                                        </div>

                                        <input autocomplete="off" type="hidden" id="item{{ $item->id }}" name="cartIds[{{ $item->id }}]" value="{{ $item->quantity }}">

                                    </td>
                                    <td><div class="subtotal">{{ $item->total }}</div></td>
                                    <td><a href="{{ route('panel::ordercart.delete', ['itemId'=>$item->id, 'orderId'=>$order->id]) }}" class="remove-button"><i class="fa fa-times"></i></a></td>
                                </tr>

                            @endforeach

                        </table>
                    </div>
                </form>
            </div>

            <script>
                $(function() {

                    "use strict";

                    /**
                     * autocomplete product search with callback form submit
                     */
                    var products = new Bloodhound({
                        datumTokenizer: function (datum) {
                            return Bloodhound.tokenizers.whitespace(datum.name);
                        },
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        // url points to a json file that contains an array of country names, see
                        // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
                        prefetch: {
                            url: '{{ route('panel::products.json', $order->supplier_id) }}',
                            cache: false
                        }
                    });

                    products.initialize();

                    $('#addToCartSearchDiv .typeahead').typeahead({
                        hint: true,
                        highlight: true,
                        minLength: 1

                    }, {
                        name: 'products',
                        source: products,
                        display: 'name'

                    }).on('typeahead:selected',function(evt,data){

                        var params = {}
                        params.productId = data.id;
                        params.orderId = {{ $order->id }};
                        var url = '{{ route('panel::ordercart.add') }}';

                        submitFormByAjax(url, params).done(function(data) {
                            location.reload();
                        })
                                .fail(function(jqXHR) {
                                    $('.error-content').html("Ошибка: "+jqXHR.responseText);
                                });
                    });

                    /** ------------------ autocomplete end ------------------- */

                    $( document ).on( "click", ".ordercart-minus", function() {
                        //$('.number-minus-update').on('click', function(){
                        var divUpd = $(this).parent().find('.number'), newVal = parseInt(divUpd.text(), 10)-1;
                        if(newVal>=0) {
                            divUpd.text(newVal);
                            $('#item' + $(this).data('id')).val(newVal);
                            updateOrderCart();
                        }
                    });

                    $( document ).on( "click", ".ordercart-plus", function() {
                        var divUpd = $(this).parent().find('.number'), newVal = parseInt(divUpd.text(), 10)+1;
                        divUpd.text(newVal);
                        $('#item' + $(this).data('id')).val(newVal);
                        updateOrderCart();
                    });
                });

                function updateOrderCart(){
                    var form = $('#updateOrderCartForm');
                    var params = form.serialize();
                    var url = form.attr('action');

                    submitFormByAjax(url, params).done(function(data) {
                        //$('#cartdiv').html(data);
                        location.reload();
                    })
                            .fail(function(jqXHR) {
                                $('.error-content').html("Ошибка: "+jqXHR.responseText);
                            });
                }
            </script>

            <style>
                #updateOrderCartForm .cart-table th {border-top: none}
                #addToCartSearchDiv .twitter-typeahead {width: 100%;}
            </style>

        </div>
    </div>

@endsection