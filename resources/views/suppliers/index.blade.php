@extends('main')

@section('content')

    <div class="breadcrumb-box">
        <a href="#">Главная</a>
        <a href="#">Каталог компаний</a>
    </div>

    <div class="information-blocks">
        <div class="row">

            <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4" id="catalogSuppliers">
            </div>

            <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 blog-sidebar">
                <div class="information-blocks categories-border-wrapper">
                    <div class="block-title size-3">
                        Потребительские товары
                    </div>

                    @if (isset($currentSectionPotreb))
                        @include('common.saccordion', ['sections' => $sectionsPotreb, 'currentSection' => $currentSectionPotreb])
                    @else
                        @include('common.saccordion', ['sections' => $sectionsPotreb])
                    @endif


                    <div class="block-title size-3">
                        Промышленные товары
                    </div>

                    @if (isset($currentSectionProm))
                        @include('common.saccordion', ['sections' => $sectionsProm, 'currentSection' => $currentSectionProm])
                    @else
                        @include('common.saccordion', ['sections' => $sectionsProm])
                    @endif

                </div>

                {{--@include('catalog.filter', [ 'filterRoute' => route('supplier.ajax', $supplier->code) ])--}}

            </div>
        </div>
    </div>

@endsection