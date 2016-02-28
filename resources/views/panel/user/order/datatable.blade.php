@extends('panel.index')

@section('headscripts')

    @parent

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>


@endsection

@section('panel_content')

    {!! $dataTable->table() !!}
    {!! $dataTable->scripts() !!}

@endsection