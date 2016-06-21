@section('headscripts')
    @parent
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
@endsection

@if($order->conditions)

    @foreach($order->conditions as $condition)

        @if($condition->type == 'delivery')
            @if($condition->attributes)
                <?$attrs = unserialize($condition->attributes);?>

                @if(isset($attrs['data'][3]))

                    <?$data = explode_assoc($attrs['data'][3]);?>

                    <div class="row deliveryWay">

                        <div class="col-md-8">
                            <div id="map{{ $order->id }}" style="width: 100%; height: 400px"></div>
                        </div>

                        <div class="col-md-4">
                            <dl>
                                <dt>{{ $data['office_type'] }}</dt>
                                <dd>{{ $data['name'] }}</dd>

                                <dt>Метро</dt>
                                <dd>{{ $data['metro'] }}</dd>

                                <dt>Телефон</dt>
                                <dd>{{ $data['phone'] }}</dd>

                                <dt>Время работы</dt>
                                <dd>{{ $data['work_schedule'] }}</dd>

                                <dt>Адрес</dt>
                                <dd>{{ $data['address'] }}</dd>

                                <dt>Как добраться</dt>
                                <dd>{{ $data['trip_description'] }}</dd>
                            </dl>
                        </div>
                    </div>

                    <script type="text/javascript">

                        ymaps.ready(init{{ $order->id }});
                        var myMap{{ $order->id }};

                        function init{{ $order->id }}() {
                            myMap{{ $order->id }}  = new ymaps.Map("map{{ $order->id }}", {
                                center: [{{ $data['gps'] }}],
                                zoom: 15
                            });

                            myPlacemark{{ $order->id }}  = new ymaps.Placemark([{{ $data['gps'] }}], {
                                hintContent: '{{ $data['office_type'] }}',
                                balloonContent: '{{ $data['address'] }}'
                            });

                            myMap{{ $order->id }}.geoObjects.add(myPlacemark{{ $order->id }});
                        }

                    </script>
                @endif
            @endif
        @endif

    @endforeach
    {{--Здесь может быть общее итого заказа с доставкой, какими-то скидками --}}

@endif