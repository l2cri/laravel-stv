@extends('main')

@section('content')
    @section('breadcrumbs', Breadcrumbs::render('common.static','Заказ оформлен'))

    <div class="information-blocks" id="thanksPage">
        <div class="row">

            <div class="col-sm-9 information-entry">
                <h1 class="block-title">
                    {{ Auth::user()->name}}, спасибо за ваш заказ!
                    <small>Поставщики свяжутся с вами в ближайшее время.</small>
                </h1>
                <div class="article-container style-1">

                    @foreach($ordersCollection as $order)
                        <h4>
                            <a class="pull-right" href="{{ route('supplier', $order->supplier->code) }}">{{ $order->supplier->name }}</a>
                            Заказ #{{ $order->id }} от {{ localizedFormat($order->created_at) }}
                        </h4>
                        @include('order.ordercart', ['order' => $order])
                    @endforeach
                </div>
            </div>

            <div class="col-sm-3 information-entry">

                <div class="information-blocks">
                    <a class="sale-entry vertical" href="#">
                        <span class="hot-mark yellow" style="right: -21px; top: 15px; width: 87px;">помощь</span>
                        <span class="sale-price"><span><i class="fa fa-phone"></i></span> +7 (8652) 777 777</span>
                        <span class="sale-description">Если у Вас возникли вопросы, наши менеджеры с удовольствием на них ответят.</span>
                        <img style="" class="sale-image" src="{{ url('img/callcentr.jpg') }}" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection