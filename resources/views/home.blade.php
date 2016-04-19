@extends('main')

@section('content')

<div class="row">
    @if(isset($banners))
    <div class="col-lg-9 col-md-12">
        <div class="information-blocks">
            <div class="row">
                <div class="col-md-12">
                    @include('home.slider',['items'=>$banners])
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-lg-3 col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-4">
                <div class="swiper-slide">
                    <div class="navigation-banner-wrapper align-1" style="background-image: url({{ url('img/traktor.jpg') }}); background-color: #f6e8d8;">
                        <div class="" style="height: 145px">
                            <div class="cell-view">
                                {{--<h2 class="subtitle">Распродажа 4</h2>--}}
                                {{--<h1 class="title">распродажа 4</h1>--}}
                                {{--<div class="description">Описание распродажа 4.</div>--}}
                                <div class="info">
                                    <br><br><br><br><br><br><br>
                                    <a class="button style-2" href="#">Купить</a>
                                    <a class="button style-2" href="#">Подбробнее</a>
                                </div>
                            </div>
                        </div>
                        {{--<div class="clear"></div>--}}
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-4">
                <div class="swiper-slide">
                    <div class="navigation-banner-wrapper align-1" style="background-image: url({{ url('img/traktor.jpg') }}); background-color: #f6e8d8;">
                        <div class="" style="height: 145px">
                            <div class="cell-view">
                                {{--<h2 class="subtitle">Распродажа 4</h2>--}}
                                {{--<h1 class="title">распродажа 4</h1>--}}
                                {{--<div class="description">Описание распродажа 4.</div>--}}
                                <div class="info">
                                    <br><br><br><br><br><br><br>
                                    <a class="button style-2" href="#">Купить</a>
                                    <a class="button style-2" href="#">Подбробнее</a>
                                </div>
                            </div>
                        </div>
                        {{--<div class="clear"></div>--}}
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-4">
                <div class="swiper-slide">
                    <div class="navigation-banner-wrapper align-1" style="background-image: url({{ url('img/traktor.jpg') }}); background-color: #f6e8d8;">
                        <div class="" style="height: 145px">
                            <div class="cell-view">
                                {{--<h2 class="subtitle">Распродажа 4</h2>--}}
                                {{--<h1 class="title">распродажа 4</h1>--}}
                                {{--<div class="description">Описание распродажа 4.</div>--}}
                                <div class="info">
                                    <br><br><br><br><br><br><br>
                                    <a class="button style-2" href="#">Купить</a>
                                    <a class="button style-2" href="#">Подбробнее</a>
                                </div>
                            </div>
                        </div>
                        {{--<div class="clear"></div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="catalizator-section">
    <div class="title">
        каталогизатор популярных потребительских товаров
    </div>
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-dress"></i>
                <span class="section-name">Одежда и аксессуары для женщин</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-clock"></i>
                <span class="section-name">Часы</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-bag"></i>
                <span class="section-name">Багаж и сумки</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-ring"></i>
                <span class="section-name">Ювелирные украшения</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-sound"></i>
                <span class="section-name">Бытовая электроника</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-car"></i>
                <span class="section-name">Автомобили и мотоциклы</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-short"></i>
                <span class="section-name">Одежда и аксессуары для мужчин</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-child"></i>
                <span class="section-name">Детские товары</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-sofa"></i>
                <span class="section-name">Для дома и сада</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-computer"></i>
                <span class="section-name">Компьютеры и сетевое оборудование</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-phone"></i>
                <span class="section-name">Телефоны и телекоммуникации</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-other"></i>
                <span class="section-name">Другие категории</span>
            </a>
        </div>


    </div>
</div>

<div class="clear"></div>
<div class="catalizator-section">
    <div class="title">
        каталогизатор популярных пРОМЫШЛЕНЫХ товаров
    </div>
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-cook"></i>
                <span class="section-name">Бакалейная и кондитерская продукция</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-apple"></i>
                <span class="section-name">Овощи, фрукты и семена</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-bag"></i>
                <span class="section-name">Сумки, обувь и аксессуары</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-sofa"></i>
                <span class="section-name">Для дома и сада</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-chemistry"></i>
                <span class="section-name">Металургия, химия, пластик</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-tractor"></i>
                <span class="section-name">Автомобили, мотоциклы и сельхоз техника</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-fish"></i>
                <span class="section-name">Мясо, рыба, птица</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-short"></i>
                <span class="section-name">Одежда, текстиль и аксессуары</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-parfum"></i>
                <span class="section-name">Здоровье и красота</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-computer"></i>
                <span class="section-name">Компьютеры  и сетевое оборудование</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-book"></i>
                <span class="section-name">Офис, обучение и реклама</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="wrap-icon" href="#">
                <i class="iconsection-other"></i>
                <span class="section-name">Другие категории</span>
            </a>
        </div>

    </div>
</div>

@endsection