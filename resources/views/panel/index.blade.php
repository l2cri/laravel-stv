@extends('main')

@section('content')
    панель управления

    @can('supplier_panel')
        @include('panel.menu.supplier')
    @endcan
@endsection