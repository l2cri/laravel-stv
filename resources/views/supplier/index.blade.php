@extends('supplier.main')

@section('supplier_content')
    <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4" id="catalogProducts">
        @include('catalog.products')
    </div>
@endsection