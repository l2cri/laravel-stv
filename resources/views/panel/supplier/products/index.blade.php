@extends('panel.index')

@section('panel_content')
    <script>
        $(function() {
            $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('panel::products.datatables.data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' }
                ],
                language: {
                    "processing": "Подождите...",
                    "search": "Поиск:",
                    "lengthMenu": "Показать _MENU_ товаров",
                    "info": "Товары с _START_ до _END_ из _TOTAL_ товаров",
                    "infoEmpty": "Товары с 0 до 0 из 0 товаров",
                    "infoFiltered": "(отфильтровано из _MAX_ товаров)",
                    "infoPostFix": "",
                    "loadingRecords": "Загрузка товаров...",
                    "zeroRecords": "Товары отсутствуют.",
                    "emptyTable": "В таблице отсутствуют данные",
                    "paginate": {
                        "first": "<<",
                        "previous": "<",
                        "next": ">",
                        "last": ">>"
                    },
                    "aria": {
                        "sortAscending": ": активировать для сортировки столбца по возрастанию",
                        "sortDescending": ": активировать для сортировки столбца по убыванию"
                    }
                }

            });
        });
    </script>

    <table class="table table-bordered" id="products-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Название</th>
            <th>Создан</th>
            <th>Отредактирован</th>
        </tr>
        </thead>
    </table>
@endsection