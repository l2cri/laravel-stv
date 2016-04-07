@extends('main')

@section('content')

    <div class="breadcrumb-box">
        <a href="#">Главная</a>
        <a href="#">Каталог</a>
    </div>

    <div class="information-blocks">
        <div class="row">

            @include('catalog.products')

            <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 blog-sidebar">
                <div class="information-blocks categories-border-wrapper">
                    <div class="block-title size-3">
                        <a href="{{ route('supplier', $supplier->code) }}">Каталог {{ $supplier->name }}</a>
                    </div>
                    @include('supplier.sectionaccordion')
                </div>

                @include('catalog.filter', [ 'filterRoute' => route('supplier.ajax', $supplier->code) ])

            </div>
        </div>
    </div>

@endsection