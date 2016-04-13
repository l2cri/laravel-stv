<?$namePage = 'Контакты';?>
@extends('supplier.main')

@section('supplier_content')

@section('breadcrumbs', Breadcrumbs::render('supplier-static',$supplier,$namePage))

<div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
    <h1 class="block-title">{{$namePage}}</h1>
    @include('success')
    @include('supplier.feedback',$supplier)
    @if($company = $supplier->company)
        @include('panel.common.companyshow',$company)
    @endif
</div>

@endsection