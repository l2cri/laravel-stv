@extends('panel.index')
@section('breadcrumbs', Breadcrumbs::render('common.panel-sub','Товары'))
@section('headscripts')

    @parent

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>


@endsection

@section('panel_content')

    <div class="table-responsive information-blocks sections-panel">

        <form action="" method="post">
            {{ csrf_field() }}
            <table class="cart-table">

                <tr>
                    <td>
                        <label>Фильтр по категории</label>
                        <select class="simple-field" name="section_id" id="sectionSelect">
                            @foreach($sectionTree as $section)
                                <option value={{ $section->id }}>
                                    {{ treeSymbol($section->depth*2, '&nbsp;') }}{{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>

            </table>
        </form>
    </div>

    {!! $dataTable->table() !!}
    {!! $dataTable->scripts() !!}

    <script>
        $( document ).on( "change", "#sectionSelect", function() {
            window.LaravelDataTables["dataTableBuilder"].ajax.url( '{{ route('products.datatables') }}' + '?section_id=' + this.value );
            window.LaravelDataTables["dataTableBuilder"].draw();
        });
    </script>
@endsection