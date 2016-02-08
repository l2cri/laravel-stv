<a class="header-functionality-entry open-cart-popup" href="{{ route('cart.index') }}">
    <i class="fa fa-shopping-cart"></i><span>Корзина</span> <b>{{ Cart::getTotal() }} <i class="fa fa-rub"></i></b>
</a>

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
                <a class="button style-3" href="{{route('cart.index')}}">Посмотреть корзину</a>
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