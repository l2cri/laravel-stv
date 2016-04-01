<li class="menu-sub-title block-title">Поставщик</li>
<li><a href="{{ route('orders.datatables') }}">Заказы</a></li>
<li><a href="#">Моя компания</a></li>
<li><a href="/panel/supplier/sections">Категории</a></li>
<li><a href="{{ route('products.datatables') }}">Товары</a>
    <ul>
        <li><a href="{{ route('panel::products.addform') }}">Добавить товар</a></li>
    </ul>

</li>
<li><a href="{{ route('panel::comments.list') }}">Комментарии</a></li>