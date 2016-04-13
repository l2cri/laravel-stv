<?$namePage = 'О нас'?>
@extends('supplier.main')

@section('supplier_content')

@section('breadcrumbs', Breadcrumbs::render('supplier-static',$supplier,$namePage))

<div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
    <h1 class="block-title">{{$namePage}}</h1>
    @if(isset($supplier->logo))
        <div class="information-blocks">
            <div class="col-md-6">
                <img class="project-thumbnail" src="{{url($supplier->logo)}}" alt="{{$supplier->name}}" />
            </div>
        </div>
    @endif
    @if(isset($supplier->description))
        <div class="article-container style-1">
            <div class="row">
                {!! $supplier->description !!}
            </div>
        </div>
    @endif
</div>

@endsection