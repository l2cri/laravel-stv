<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/idangerous.swiper.css" rel="stylesheet" type="text/css" />
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700%7CDancing+Script%7CMontserrat:400,700%7CMerriweather:400,300italic%7CLato:400,700,900' rel='stylesheet' type='text/css' />
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/css/main.css" rel="stylesheet" type="text/css" />
    <!--[if IE 9]>
    <link href="/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <link rel="shortcut icon" href="/img/favicon-2.ico" />

    <script src="/js/jquery-2.1.3.min.js"></script>

    <title>Маркетплейс</title>
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
                        <div class="title"><i class="fa fa-phone"></i>Есть вопросы? Звоните нам  <a href="tel:+78652777777"><b>+7 (8652) 777 777</b></a></div>
                    </div>
                    <div class="socials-box">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                        <a href="#"><i class="fa fa-youtube"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                    </div>
                    <div class="menu-button responsive-menu-toggle-class"><i class="fa fa-reorder"></i></div>
                    <div class="clear"></div>
                </div>

                <div class="header-middle">
                    <div class="logo-wrapper">
                        <a id="logo" href="{{ url('/') }}"><img src="/img/logo-main.png" alt="" /></a>
                    </div>

                    <div class="right-entries">
                        <a class="header-functionality-entry open-search-popup" href="#">
                            <i class="fa fa-search"></i><span>Поиск</span>
                        </a>

                        <div class="drop-hover header-functionality-entry">
                            <a class="">
                                <span>Регистрация </span><i class="fa fa-angle-down"></i>
                            </a>
                            <div class="submenu"><h2>Test!</h2></div>
                        </div>

                        @include('common.loginform')

                        <a class="header-functionality-entry open-cart-popup" href="#">
                            <i class="fa fa-shopping-cart"></i><span>Корзина</span> <b>255,99 <i class="fa fa-rub"></i></b>
                        </a>
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
                                <form>
                                    <div class="search-button">
                                        <i class="fa fa-search"></i>
                                        <input type="submit" />
                                    </div>

                                    <div class="search-drop-down">
                                        <div class="title"><span>Все категории</span><i class="fa fa-angle-down"></i></div>
                                        <div class="list">
                                            <div class="overflow">
                                                <div class="category-entry">Категория 1</div>
                                                <div class="category-entry">Категория 2</div>
                                                <div class="category-entry">Категория 2</div>
                                                <div class="category-entry">Категория 4</div>
                                                <div class="category-entry">Категория 5</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="search-field">
                                        <input type="text" value="" placeholder="Поиск..." />
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
                                    <a href="/info/about">О проекте</a><i class="fa fa-chevron-down"></i>
                                    {{--<div class="submenu">--}}
                                        {{--<div class="product-column-entry">--}}
                                            {{--<div class="image"><img alt="" src="/img/product-menu-2.jpg"></div>--}}
                                            {{--<div class="submenu-list-title"><a href="contact.html">Contact Us</a><span class="toggle-list-button"></span></div>--}}
                                            {{--<div class="description toggle-list-container">--}}
                                                {{--<ul class="list-type-1">--}}
                                                    {{--<li><a href="contact.html"><i class="fa fa-angle-right"></i>Contact Us 1</a></li>--}}
                                                    {{--<li><a href="contact-2.html"><i class="fa fa-angle-right"></i>Contact Us 2</a></li>--}}
                                                    {{--<li><a href="contact-3.html"><i class="fa fa-angle-right"></i>Contact Us 3</a></li>--}}
                                                    {{--<li><a href="contact-4.html"><i class="fa fa-angle-right"></i>Contact Us 4</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                            {{--<div class="hot-mark">hot</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="product-column-entry">--}}
                                            {{--<div class="image"><img alt="" src="/img/product-menu-4.jpg"></div>--}}
                                            {{--<div class="submenu-list-title"><a href="about-1.html">About Us</a><span class="toggle-list-button"></span></div>--}}
                                            {{--<div class="description toggle-list-container">--}}
                                                {{--<ul class="list-type-1">--}}
                                                    {{--<li><a href="about-1.html"><i class="fa fa-angle-right"></i>About Us Fullwidth 1</a></li>--}}
                                                    {{--<li><a href="about-2.html"><i class="fa fa-angle-right"></i>About Us Fullwidth 2</a></li>--}}
                                                    {{--<li><a href="about-3.html"><i class="fa fa-angle-right"></i>About Us Fullwidth 3</a></li>--}}
                                                    {{--<li><a href="about-4.html"><i class="fa fa-angle-right"></i>About Us Sidebar 1</a></li>--}}
                                                    {{--<li><a href="about-5.html"><i class="fa fa-angle-right"></i>About Us Sidebar 2</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                            {{--<div class="hot-mark yellow">sale</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="product-column-entry">--}}
                                            {{--<div class="image"><img alt="" src="/img/product-menu-3.jpg"></div>--}}
                                            {{--<div class="submenu-list-title"><a href="cart.html">Cart</a><span class="toggle-list-button"></span></div>--}}
                                            {{--<div class="description toggle-list-container">--}}
                                                {{--<ul class="list-type-1">--}}
                                                    {{--<li><a href="cart.html"><i class="fa fa-angle-right"></i>Cart</a></li>--}}
                                                    {{--<li><a href="cart-traditional.html"><i class="fa fa-angle-right"></i>Cart Traditional</a></li>--}}
                                                    {{--<li><a href="checkout.html"><i class="fa fa-angle-right"></i>Checkout</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="product-column-entry">--}}
                                            {{--<div class="image"><img alt="" src="/img/product-menu-5.jpg"></div>--}}
                                            {{--<div class="submenu-list-title"><a href="teaser-background.html">Coming Soon</a><span class="toggle-list-button"></span></div>--}}
                                            {{--<div class="description toggle-list-container">--}}
                                                {{--<ul class="list-type-1">--}}
                                                    {{--<li><a href="teaser-background.html"><i class="fa fa-angle-right"></i>Coming Soon 1</a></li>--}}
                                                    {{--<li><a href="teaser-background-2.html"><i class="fa fa-angle-right"></i>Coming Soon 2</a></li>--}}
                                                    {{--<li><a href="teaser-simple.html"><i class="fa fa-angle-right"></i>Coming Soon 3</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                            {{--<div class="hot-mark">hot</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="product-column-entry">--}}
                                            {{--<div class="image"><img alt="" src="/img/product-menu-2.jpg"></div>--}}
                                            {{--<div class="submenu-list-title"><a href="shop.html">Products</a><span class="toggle-list-button"></span></div>--}}
                                            {{--<div class="description toggle-list-container">--}}
                                                {{--<ul class="list-type-1">--}}
                                                    {{--<li><a href="shop.html"><i class="fa fa-angle-right"></i>Shop</a></li>--}}
                                                    {{--<li><a href="product.html"><i class="fa fa-angle-right"></i>Product</a></li>--}}
                                                    {{--<li><a href="product-nosidebar.html"><i class="fa fa-angle-right"></i>No Sidebar</a></li>--}}
                                                    {{--<li><a href="product-tabnosidebar.html"><i class="fa fa-angle-right"></i>Tab No Sidebar</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="submenu-links-line">--}}
                                            {{--<div class="submenu-links-line-container">--}}
                                                {{--<div class="cell-view">--}}
                                                    {{--<div class="line-links"><b>Quicklinks:</b>  <a href="shop.html">Blazers</a>, <a href="shop.html">Jackets</a>, <a href="shop.html">Shoes</a>, <a href="shop.html">Bags</a>, <a href="shop.html">Special offers</a>, <a href="shop.html">Sales and discounts</a></div>--}}
                                                {{--</div>--}}
                                                {{--<div class="cell-view">--}}
                                                    {{--<div class="red-message"><b>-20% sale only this week. Don’t miss buy something!</b></div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </li>
                                {{--<li class="simple-list">--}}
                                    {{--<a href="shop.html">Products</a><i class="fa fa-chevron-down"></i>--}}
                                    {{--<div class="submenu">--}}
                                        {{--<ul class="simple-menu-list-column">--}}
                                            {{--<li><a href="shop.html"><i class="fa fa-angle-right"></i>Shop</a></li>--}}
                                            {{--<li><a href="product.html"><i class="fa fa-angle-right"></i>Product</a></li>--}}
                                            {{--<li><a href="product-nosidebar.html"><i class="fa fa-angle-right"></i>No Sidebar</a></li>--}}
                                            {{--<li><a href="product-tabnosidebar.html"><i class="fa fa-angle-right"></i>Tab No Sidebar</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                                {{--<li class="column-1">--}}
                                    {{--<a href="portfolio-default.html">Portfolio</a><i class="fa fa-chevron-down"></i>--}}
                                    {{--<div class="submenu">--}}
                                        {{--<div class="full-width-menu-items-left">--}}
                                            {{--<img class="submenu-background" src="/img/product-menu-7.jpg" alt="" />--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-md-12">--}}
                                                    {{--<div class="submenu-list-title"><a href="portfolio-default.html">Our Portfolio</a><span class="toggle-list-button"></span></div>--}}
                                                    {{--<ul class="list-type-1 toggle-list-container">--}}
                                                        {{--<li><a href="portfolio-default.html"><i class="fa fa-angle-right"></i>Portfolio Default</a></li>--}}
                                                        {{--<li><a href="portfolio-simple.html"><i class="fa fa-angle-right"></i>Portfolio Simple</a></li>--}}
                                                        {{--<li><a href="portfolio-custom.html"><i class="fa fa-angle-right"></i>Portfolio Custom</a></li>--}}
                                                        {{--<li><a href="portfolio-customfullwidth.html"><i class="fa fa-angle-right"></i>Fullwidth Custom</a></li>--}}
                                                        {{--<li><a href="portfolio-simplefullwidth.html"><i class="fa fa-angle-right"></i>Fullwidth Simple</a></li>--}}
                                                        {{--<li><a href="project-default.html"><i class="fa fa-angle-right"></i>Project Default</a></li>--}}
                                                        {{--<li><a href="project-fullwidth.html"><i class="fa fa-angle-right"></i>Project Fullwidth</a></li>--}}
                                                    {{--</ul>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="submenu-links-line">--}}
                                            {{--<div class="submenu-links-line-container">--}}
                                                {{--<div class="cell-view">--}}
                                                    {{--<div class="line-links"><b>Quicklinks:</b>  <a href="shop.html">Blazers</a>, <a href="shop.html">Jackets</a>, <a href="shop.html">Shoes</a>, <a href="shop.html">Bags</a></div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                                {{--<li class="column-1">--}}
                                    {{--<a href="blog.html">Blog</a><i class="fa fa-chevron-down"></i>--}}
                                    {{--<div class="submenu">--}}
                                        {{--<div class="full-width-menu-items-left">--}}
                                            {{--<img class="submenu-background" src="/img/product-menu-8.jpg" alt="" />--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-md-12">--}}
                                                    {{--<div class="submenu-list-title"><a href="blog.html">Blog <span class="menu-label blue">new</span></a><span class="toggle-list-button"></span></div>--}}
                                                    {{--<ul class="list-type-1 toggle-list-container">--}}
                                                        {{--<li><a href="blog.html"><i class="fa fa-angle-right"></i>Blog Default</a></li>--}}
                                                        {{--<li><a href="blog-grid.html"><i class="fa fa-angle-right"></i>Blog Grid</a></li>--}}
                                                        {{--<li><a href="blog-timeline.html"><i class="fa fa-angle-right"></i>Blog Timeline</a></li>--}}
                                                        {{--<li><a href="blog-list.html"><i class="fa fa-angle-right"></i>Blog List</a></li>--}}
                                                        {{--<li><a href="blog-biggrid.html"><i class="fa fa-angle-right"></i>Blog Big Grid</a></li>--}}
                                                        {{--<li><a href="blog-detail.html"><i class="fa fa-angle-right"></i>Single Post</a></li>--}}
                                                    {{--</ul>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="submenu-links-line">--}}
                                            {{--<div class="submenu-links-line-container">--}}
                                                {{--<div class="cell-view">--}}
                                                    {{--<div class="line-links"><b>Quicklinks:</b>  <a href="shop.html">Blazers</a>, <a href="shop.html">Jackets</a>, <a href="shop.html">Shoes</a>, <a href="shop.html">Bags</a></div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                                {{--<li class="simple-list">--}}
                                    {{--<a>More</a><i class="fa fa-chevron-down"></i>--}}
                                    {{--<div class="submenu">--}}
                                        {{--<ul class="simple-menu-list-column">--}}
                                            {{--<li><a href="login.html"><i class="fa fa-angle-right"></i>Login</a></li>--}}
                                            {{--<li><a href="error.html"><i class="fa fa-angle-right"></i>Error</a></li>--}}
                                            {{--<li><a href="faq.html"><i class="fa fa-angle-right"></i>Faq</a></li>--}}
                                            {{--<li><a href="compare.html"><i class="fa fa-angle-right"></i>Compare</a></li>--}}
                                            {{--<li><a href="wishlist.html"><i class="fa fa-angle-right"></i>Wishlist</a></li>--}}
                                            {{--<li><a href="shortcodes.html"><i class="fa fa-angle-right"></i>Shortcodes</a></li>--}}
                                            {{--<li><a href="elements-headers.html"><i class="fa fa-angle-right"></i>Elements - Headers</a></li>--}}
                                            {{--<li><a href="elements-footers.html"><i class="fa fa-angle-right"></i>Elements - Footers</a></li>--}}
                                            {{--<li><a href="elements-breadcrumbs.html"><i class="fa fa-angle-right"></i>Elements - Breadcrumbs</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</li>--}}

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

            @yield('content')

            <!-- FOOTER -->

            <div class="footer-wrapper style-2">
                <footer class="type-1">
                    <div class="footer-columns-entry">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="footer-logo" src="/img/logo-small.png" alt="" />
                                <div class="footer-description">Лучшие товары от ставропольских производителей.
                                </div>
                                <div class="footer-address">г. Ставрополь, пр. Мира, д. 1<br/>
                                    Тел: 8 800 111 22 33<br/>
                                    Email: <a href="mailto:info@buy26.ru">info@buy26.ru</a><br/>
                                    <a href="www.inmedio.com"><b>www.buy26.ru</b></a>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="col-md-2 col-sm-4">
                                <h3 class="column-title">Меню</h3>
                                <ul class="column">
                                    <li><a href="#">О нас</a></li>
                                    <li><a href="#">Как заказать</a></li>
                                    <li><a href="#">Обмен/Возврат</a></li>
                                    <li><a href="#">Оплата</a></li>
                                    <li><a href="#">Доставка</a></li>
                                    <li><a href="#">Контакты</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>

                            <div class="col-md-3 col-sm-5">
                                <h3 class="column-title">Меню</h3>
                                <ul class="column">
                                    <li><a href="#">О нас</a></li>
                                    <li><a href="#">Как заказать</a></li>
                                    <li><a href="#">Обмен/Возврат</a></li>
                                    <li><a href="#">Оплата</a></li>
                                    <li><a href="#">Доставка</a></li>
                                    <li><a href="#">Контакты</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>

                            <div class="col-md-3 col-sm-5">
                                <h3 class="column-title">Часы работы call-центра</h3>
                                <div class="footer-description">
                                    Заказы на сайте оставляйте в любое время.
                                </div>
                                <div class="footer-description">
                                    <b>Пн-Пт:</b> 9.00 - 18.30<br/>
                                    <b>Суббота:</b> 9.00 - 14.00<br/>
                                    <b>Воскресенье:</b> Выходной
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
                                <div class="copyright">2015-2016 <a href="#">www.buy26.ru</a>. Все права защищены.</div>
                            </div>
                            <div class="cell-view">
                                <div class="payment-methods">
                                    <a href="#"><img src="/img/payment-method-1.png" alt="" /></a>
                                    <a href="#"><img src="/img/payment-method-2.png" alt="" /></a>
                                    <a href="#"><img src="/img/payment-method-3.png" alt="" /></a>
                                    <a href="#"><img src="/img/payment-method-4.png" alt="" /></a>
                                    <a href="#"><img src="/img/payment-method-5.png" alt="" /></a>
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


<div class="cart-box popup">
    <div class="popup-container">
        <div class="cart-entry">
            <a class="image"><img src="/img/product-menu-1.jpg" alt="" /></a>
            <div class="content">
                <a class="title" href="#">Молоко отборное коровье</a>
                <div class="quantity">Кол-во: 4л</div>
                <div class="price">200,00 <i class="fa fa-rub"></i></div>
            </div>
            <div class="button-x"><i class="fa fa-close"></i></div>
        </div>
        <div class="cart-entry">
            <a class="image"><img src="/img/product-menu-1_.jpg" alt="" /></a>
            <div class="content">
                <a class="title" href="#">Молоко отборное коровье</a>
                <div class="quantity">Кол-во: 4л</div>
                <div class="price">200,00 <i class="fa fa-rub"></i></div>
            </div>
            <div class="button-x"><i class="fa fa-close"></i></div>
        </div>
        <div class="summary">
            <div class="subtotal">Товаров на: 400,00 <i class="fa fa-rub"></i></div>
            <div class="grandtotal">С доставкой <span>600,00 <i class="fa fa-rub"></i></span></div>
        </div>
        <div class="cart-buttons">
            <div class="column">
                <a class="button style-3">Посмотреть корзину</a>
                <div class="clear"></div>
            </div>
            <div class="column">
                <a class="button style-4">Оформить заказ</a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>


<script src="/js/idangerous.swiper.min.js"></script>
<script src="/js/global.js"></script>

<!-- custom scrollbar -->
<script src="/js/jquery.mousewheel.js"></script>
<script src="/js/jquery.jscrollpane.min.js"></script>
</body>
</html>