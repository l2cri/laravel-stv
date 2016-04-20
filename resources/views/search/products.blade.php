@extends('search.main')

@section('breadcrumbs', Breadcrumbs::render('common.static','Поиск по продуктам'))

@section('search_content')
    <div class="col-md-12" id="catalogProducts">
        @include('catalog.products',['prefix'=>'productssearch'])
    </div>
@endsection