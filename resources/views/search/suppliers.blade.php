@extends('search.main')

@section('breadcrumbs', Breadcrumbs::render('common.static','Поиск по поставщикам'))

@section('search_content')
    <div class="col-md-12" id="catalogProducts">
        @include('suppliers.suppliers', ['prefix'=>'supplierssearch'])
    </div>
@endsection