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
                ]
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