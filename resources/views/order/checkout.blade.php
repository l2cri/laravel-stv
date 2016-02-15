@extends('main')

@section('content')

    <div class="breadcrumb-box">
        <a href="{{ url() }}">Главная</a>
        <a href="#">Оформить заказ</a>
    </div>

    <div class="information-blocks">
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
                                <p>Пока сделать курьером или самовывоз</p>
                            </div>
                        </div>

                        <div class="accordeon-title active"><span class="number">3</span>Оплата</div>
                        <div class="accordeon-entry" style="display: block;">
                            <div class="article-container style-1">
                                <p>Наличные, безналичные - предусмотреть так,
                                    чтобы после сохранения заказа платежная система решала, куда отправить пользователя,
                                    на страницу оплаты или на подтверждение заказа
                                    - в случае подключения мерчанта
                                </p>
                            </div>
                        </div>

                        <div class="accordeon-title active"><span class="number">4</span>Заказ</div>
                        <div class="accordeon-entry" style="display: block;">
                            <div class="article-container style-1">
                                вставить сюда шаблон с корзины с мЕньшими картинками и добавить его в композер
                                доставка отдельно будет
                            </div>
                        </div>

                    </div>

                    <div class="button style-10">Оформить заказ<input type="submit" value=""></div>

                </form>

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