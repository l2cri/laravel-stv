<span class="pull-right">

    @if ($supplier->user->company)

        @if ($supplier->company)

            <a href="{{ route('panel::company.toggleSupplier', $supplier->id) }}">Отключить реквизиты</a>

        @else

            <a href="{{ route('panel::company.toggleSupplier', $supplier->id) }}">Включить реквизиты</a>

        @endif

    @else
        <a href="{{ route('panel::company') }}">Добавить реквизиты</a>
    @endif


</span>