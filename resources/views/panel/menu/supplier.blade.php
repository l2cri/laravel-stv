<li class="menu-sub-title block-title">Поставщик</li>
<li><a href="{{ route('orders.datatables') }}">Заказы</a></li>
<li><a href="{{ route('panel::sections') }}">Категории</a></li>
<li><a href="{{ route('products.datatables') }}">Товары</a>
    <ul>
        <li><a href="{{ route('panel::products.addform') }}">Добавить товар</a></li>
    </ul>

</li>
<li><a href="{{ route('panel::comments.list') }}">Комментарии</a></li>
<li><a href="{{ route('panel::supplierComments.list') }}">Отзывы</a></li>
<li><a href="{{ route('panel::faq.list') }}">Вопросы</a></li>
</li>
<li><a href="{{ route('panel::actions') }}">Акции</a></li>
<li><a href="{{ route('panel::location.zones') }}">Зоны доставки</a></li>
<li><a href="{{ route('panel::supplier.settings') }}">Настройки магазина</a></li>
<br>
<br>

