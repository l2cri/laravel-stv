@extends('main')

@section('headscripts')
    @parent
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
@endsection

@section('content')

@section('breadcrumbs', Breadcrumbs::render('common.static-sub',['name'=>'Корзина','url'=> route('cart.index')],'Оформить заказ'))

<div class="information-blocks" id="checkoutPage">
    <div class="row">
        <div class="col-sm-9 information-entry">

            <form method="post" action="{{ route('order.create') }}">
                {{ csrf_field() }}

                <div class="accordeon size-1">

                    <div class="accordeon-title active"><span class="number">1</span>Профиль покупателя</div>
                    <div class="accordeon-entry" style="display: block;">
                        <div class="article-container style-1">
                            @include('order.profile')
                        </div>
                    </div>

                    <div class="accordeon-title active"><span class="number">2</span>Доставка</div>
                    <div class="accordeon-entry" style="display: block;">
                        <div class="article-container style-1">

                                <? $inc = 0; ?>
                                @foreach( $deliveries as $delivery )
                                    <?
                                    $deliveryWays = $delivery->getDeliveryWays();
                                    $dWaysData = array();
                                    ?>
                                    @if ($deliveryWays)
                                            <div class="deliveryRadio">
                                        @foreach($deliveryWays as $dWay)
                                            <input type="hidden" name="dataWays[{{ $inc }}]"
                                                   value='{{ base64_encode(serialize([$dWay->getName(), $dWay->getCost(), $dWay->getTime(), $dWay->getData()])) }}'>
                                            <label class="checkbox-entry radio">
                                                <input type="radio" name="delivery_id"
                                                       value="{{ $delivery->getModel()->id }}_{{ $inc }}"> <span
                                                        class="check"></span>
                                                Самовывоз
                                                {{ $dWay->getName() }} <b class="pull-right">{{ $dWay->getTime() }} дней, <i
                                                        class="fa fa-rub"></i> {{ $dWay->getCost() }}</b>
                                            </label>
                                            <?
                                            $dWaysData[$delivery->getModel()->id . '_' . $inc] = $dWay->getData();
                                            $inc++;
                                            ?>
                                        @endforeach
                                                </div>
                                    @endif

                                @if($delivery->getModel()->type == 'App\Services\Delivery\Boxberry\PointsHandler')

                                    <div id="map" style="width: 100%; height: 400px"></div>

                                    <script type="text/javascript">

                                        ymaps.ready(init);

                                        function init() {

                                            ymaps.geocode('{{ $location->name }}').then(function (res) {
                                                var myMap = new ymaps.Map('map', {
                                                    center: res.geoObjects.get(0).geometry.getCoordinates(),
                                                    zoom: 10
                                                });

                                                @foreach($dWaysData as $id => $dataStr)
                                                <? $data = explode_assoc($dataStr); ?>

                                                myPlacemark{{ $id }}   = new ymaps.Placemark([{{ $data['gps'] }}], {
                                                    hintContent: '{{ $data['office_type'].' '.$data['name'] }}',
                                                    balloonContent: '{{ $data['address'] }}',
                                                    {{--iconContent: '{{ $data['office_type'].' '.$data['name'] }}',--}}
                                                    id: '{{ $id }}',
                                                }, {
                                                    iconColor: '#FF0041',
//                                                    hasBalloon: false,
                                                });

                                                myPlacemark{{ $id }}.events.add('click', function (e){
                                                    var pm = e.get('target');
                                                    //pm.properties.set('iconContent', '{{ $data['office_type'].' '.$data['name'] }}');
//                                                    pm.options.set('preset', 'islands#grayStretchyIcon');
//                                                    pm.options.set('iconColor', '#808D05');
                                                    clickRadio(pm.properties.get('id'));
                                                });

                                                myMap.geoObjects.add(myPlacemark{{ $id }});

                                                @endforeach

                                            });
                                        }

                                        function clickRadio(value){
                                            $('input[value='+value+']').parent('label').trigger('click');
                                            var radio = $('input[value='+value+']').parent('label');
                                            var parentDiv = $('input[value='+value+']').parent('label').parent('.deliveryRadio');

                                            //alert(parentDiv.attr('class'));

                                            parentDiv.scrollTop(parentDiv.scrollTop() + radio.position().top);
                                        }

                                    </script>
                                @endif
                            @endforeach


                            {{--@foreach($deliveries as $delivery)--}}
                            {{--<label class="checkbox-entry radio">--}}
                            {{--<input type="radio" name="delivery_id" value="{{ $delivery->id }}"> <span class="check"></span> {{ $delivery->name }}--}}
                            {{--</label>--}}
                            {{--@endforeach--}}
                        </div>
                    </div>

                    <div class="accordeon-title active"><span class="number">3</span>Оплата</div>
                    <div class="accordeon-entry" style="display: block;">
                        <div class="article-container style-1">
                            @foreach($payments as $payment)
                                <label class="checkbox-entry radio">
                                    <input type="radio" name="payment_id" value="{{ $payment->id }}"> <span
                                            class="check"></span> {{ $payment->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="accordeon-title active"><span class="number">4</span>Заказ</div>
                    <div class="accordeon-entry" style="display: block;">
                        <div class="article-container style-1">

                            @include('cart.checkout')

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 col-md-offset-6 information-entry">
                        <div class="cart-summary-box">
                            <span id="cartTotal">@include('cart.total')</span>

                            <div class="button style-10">Заказать<input type="submit" value=""></div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
        <div class="col-sm-3 information-entry">

            <div class="information-blocks">
                <a class="sale-entry vertical" href="#">
                    <span class="hot-mark yellow" style="right: -21px; top: 15px; width: 87px;">помощь</span>
                    <span class="sale-price"><span><i class="fa fa-phone"></i></span> +7 (8652) 777 777</span>
                    <span class="sale-description">Если у Вас возникли вопросы, наши менеджеры с удовольствием на них ответят.</span>
                    <img style="" class="sale-image" src="{{ url('img/callcentr.jpg') }}" alt=""/>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection