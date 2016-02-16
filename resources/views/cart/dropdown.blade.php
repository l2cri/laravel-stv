<a class="header-functionality-entry open-cart-popup" href="{{ route('cart.index') }}">
    <i class="fa fa-shopping-cart"></i><span>Корзина</span> <b>{{ Cart::getTotal() }} <i class="fa fa-rub"></i></b>
</a>

<div class="cart-box popup">
    <div class="popup-container">

        @foreach($items as $item)
            <div class="cart-entry">
                <a class="image"><img src="{{ @url($item->attributes['file']) }}" alt="" /></a>
                <div class="content">
                    <a class="title" href="{{ route('product.page', $item->id) }}">{{ $item->name }}</a>
                    <div class="quantity">Кол-во: {{ $item->quantity }} {{ trn($item->attributes['unit'], 'шт') }}</div>
                    <div class="price">{{ $item->price }} <i class="fa fa-rub"></i></div>
                </div>
                <a class="button-x" href="{{ route('cart.delete', $item->id) }}"><i class="fa fa-close"></i></a>
            </div>
        @endforeach

        <div class="summary">
            <div class="subtotal">Товаров на: {{ Cart::getTotal() }} <i class="fa fa-rub"></i></div>
            <div class="grandtotal">С доставкой <span>600,00 <i class="fa fa-rub"></i></span></div>
        </div>
        <div class="cart-buttons">
            <div class="column">
                <a class="button style-3" href="{{route('cart.index')}}">Посмотреть корзину</a>
                <div class="clear"></div>
            </div>
            <div class="column">
                <a class="button style-4" href="{{ route('order.checkout') }}">Оформить заказ</a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>