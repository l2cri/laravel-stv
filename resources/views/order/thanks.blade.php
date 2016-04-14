@extends('main')

@section('content')
    @section('breadcrumbs', Breadcrumbs::render('common.static','Заказ оформлен'))

    <div class="information-blocks" id="checkoutPage">
        <div class="row">
            <div class="col-sm-9 information-entry">
                <h1 class="block-title">Спасибо за ваш заказ</h1>
                <div class="article-container style-1">

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