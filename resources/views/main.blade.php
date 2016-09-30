<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/idangerous.swiper.css" rel="stylesheet" type="text/css" />
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700%7CDancing+Script%7CMontserrat:400,700%7CMerriweather:400,300italic%7CLato:400,700,900' rel='stylesheet' type='text/css' />
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/main.css" rel="stylesheet" type="text/css" />
    <!--[if IE 9]>
    <link href="/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <link rel="shortcut icon" href="/img/favicon-2.ico" />

    @include('jsheader')

    @yield('headscripts')

    @section('title')
        <title>Маркетплейс - Лучшие товары  от  производителей Юга России - stavo.ru</title>
    @show

</head>
<body class="style-2">
<!-- LOADER -->
<div id="loader-wrapper">
    <div class="bubbles">
        <div class="title">Загрузки</div>
        <span></span>
        <span id="bubble2"></span>
        <span id="bubble3"></span>
    </div>
</div>

<div id="content-block">

    <div class="content-center fixed-header-margin">
        <!-- HEADER -->
        <div class="header-wrapper style-2">
            <header class="type-1">

                <div class="header-top">
                    <div class="header-top-entry">
                        {{--<div class="title"><i class="fa fa-phone"></i>Есть вопросы? Звоните нам  <a href="tel:+78652777777"><b>+7 (8652) 777 777</b></a></div>--}}
                        @include("common.geo")
                    </div>

                    <div class="socials-box">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                    <div class="menu-button responsive-menu-toggle-class"><i class="fa fa-reorder"></i></div>
                    <div class="clear"></div>
                </div>

                <div class="header-middle">
                    <div class="logo-wrapper">

                        @section('logo')
                            <a id="logo" href="{{ url('/') }}"><img src="/img/logo-main.png" alt="" /></a>
                        @show

                    </div>

                    <div class="right-entries">
                        <a class="header-functionality-entry open-search-popup" href="#">
                            <i class="fa fa-search"></i><span>Поиск</span>
                        </a>

                        @section('supplier_contacts')

                        @show

                        @if (!Auth::check())
                        <div class="drop-hover header-functionality-entry">
                            <a href="{{route('register')}}" >
                                <span>Регистрация </span><i class="fa fa-angle-down"></i>
                            </a>
                        </div>
                        @endif

                        @include('common.loginform')

                        <span id="dropdownCartDiv">
                            @include('cart.dropdown')
                        </span>

                    </div>
                </div>
                <div class="close-header-layer"></div>

                <div class="navigation">
                    <div class="navigation-header responsive-menu-toggle-class">
                        <div class="title">Навигация</div>
                        <div class="close-menu"></div>
                    </div>
                    <div class="nav-overflow">

                        <div class="menu-drop-hover">
                            <div class="sidebar-navigation-title">
                                <div>
                                    Категории продуктов <i class="fa fa-chevron-down"></i>
                                </div>

                            </div>
                            <div class="submenu" id="menusections">
                                @include('common.menusections')
                            </div>
                        </div>

                        <div class="navigation-search-content">
                            <div class="toggle-desktop-menu"><i class="fa fa-bars"></i><i class="fa fa-close"></i>меню</div>
                            <div class="search-box size-1">
                                <form id="search-head" method="get" action="{{route('search.products')}}">
                                    <div class="search-button">
                                        <i class="fa fa-search"></i>
                                        <input type="submit" />
                                    </div>

                                    <div class="search-drop-down">
                                        <div class="title"><span>По товару</span><i class="fa fa-angle-down"></i></div>
                                        <div class="list">
                                            <div class="overflow">
                                                <div data-route="{{route('search.products')}}" class="category-entry">По товару</div>
                                                <div data-route="{{route('search.suppliers')}}" class="category-entry">По производителю</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="search-field">
                                        <input name="q" type="text" value="" placeholder="Поиск..." />
                                    </div>
                                </form>
                            </div>
                        </div>

                        <nav>
                            <ul>
                                <li class="full-width">
                                    <a href="#" class="active">Каталог</a><i class="fa fa-chevron-down"></i>
                                    <div class="submenu">
                                        @include('common.menusections')
                                    </div>
                                </li>
                                <li class="full-width-columns">
                                    <a href="/suppliers">Поставщики</a><i class="fa fa-chevron-down"></i>
                                </li>

                                <li class="full-width-columns">
                                    <a href="/info/about">О проекте</a><i class="fa fa-chevron-down"></i>
                                </li>

                                <li class="fixed-header-visible">
                                    <a class="fixed-header-square-button open-cart-popup"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="fixed-header-square-button open-search-popup"><i class="fa fa-search"></i></a>
                                </li>
                            </ul>

                            <div class="clear"></div>

                            <a class="fixed-header-visible additional-header-logo"><img src="/img/logo-3.png" alt=""/></a>
                        </nav>

                    </div>
                </div>

            </header>

            <div class="clear"></div>

        </div>

        <div class="content-push">

            @include('errors')

            @yield('breadcrumbs')
            @yield('content')

            <!-- FOOTER -->

            <div class="footer-wrapper style-2">
                <footer class="type-1">
                    <div class="footer-columns-entry">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="footer-logo" src="/img/logo-small.png" alt="" />
                                <div class="footer-description">Лучшие товары  от  производителей Юга России.
                                </div>
                                <div class="footer-address">г. Ставрополь, пр. Кулакова 16В, ТДЦ "Нептун", оф 507<br/>

                                    Email: <a href="mailto:info@stavo.ru">info@stavo.ru</a><br/>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="col-md-2 col-sm-4">
                                <h3 class="column-title">О проекте</h3>
                                <ul class="column">
                                    <li><a href="{{ route('infopage', 'about') }}">О проекте</a></li>
                                    <li><a href="{{ route('infopage', 'regvendor') }}">Для поставщиков</a></li>
                                    <li><a href="{{ route('infopage', 'howtoorder') }}">Как заказать?</a></li>
                                    <li><a href="{{ route('infopage', 'obmen-vozvrat') }}">Обмен/Возврат</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>

                            <div class="col-md-3 col-sm-5">
                                <h3 class="column-title">Информация</h3>
                                <ul class="column">
                                    <li><a href="{{ route('infopage', 'payment') }}">Способы оплаты</a></li>
                                    <li><a href="{{ route('infopage', 'delivery') }}">Доставка</a></li>
                                    <li><a href="{{ route('infopage', 'contacts') }}">Контакты</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>

                            <div class="col-md-3 col-sm-5">
                                <h3 class="column-title">Часы работы call-центра</h3>
                                <div class="footer-description">
                                    Тел: 8-800-777-82-73
                                </div>
                                <div class="footer-description">
                                    <b>Пн-Пт:</b> 9.00 - 18.00<br/>
                                    <b>Суббота, Воскресенье:</b> Выходной
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-bottom-navigation">
                        <div class="footer-bottom-navigation">
                            <div class="cell-view">
                                <div class="footer-links">
                                    <a href="#">Карта сайта</a>
                                    <a href="#">Расширенный поиск</a>
                                    <a href="#">Политика конфиденциальности</a>
                                    <a href="#">Контакты</a>
                                </div>
                                <div class="copyright">2015-2016 <a href="http://www.stavo.ru">www.stavo.ru</a>. Все права защищены.</div>
                            </div>
                            <div class="cell-view">
                                <div class="payment-methods">
                                    <a href="#"><img src="/img/payment-method-3.png" alt="" /></a>
                                    <a href="#"><img src="/img/payment-method-4.png" alt="" /></a>
                                    <a href="#"><img src="/img/payment-method-6.png" alt="" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

    </div>

</div>

<div id="addcart-popup" class="overlay-popup">
    <div class="overflow">
        <div class="table-view">
            <div class="cell-view">
                <div class="close-layer"></div>
                <div class="popup-container">
                    <div class="newsletter-title">Товар добавлен в корзину!</div>
                    <div class="cart-buttons">
                        <div class="column">
                            <a class="button style-3 closePopup" href="#">Продолжить покупки</a>
                            <div class="clear"></div>
                        </div>
                        <div class="column">
                            <a class="button style-4" href="{{route('cart.index')}}">Посмотреть корзину</a>
                            <div class="clear"></div>
                        </div>
                        &nbsp;
                        <div class="column">
                            <a class="button style-14" href="{{ route('order.checkout') }}">Оформить заказ</a>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="close-popup"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('geoip')

@include('jsfooter')

</body>
</html>