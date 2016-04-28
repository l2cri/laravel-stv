@extends('main')

@section('content')
    {!! Breadcrumbs::render('catalog') !!}

    <div class="side-square-wrapper">
        <div class="row nopadding">
            <div class="col-md-6 col-md-push-6 nopadding side-square-entry">

                <div style="padding-top: 0;" class="block-header">
                    <h3 class="title">Промышленные товары</h3>
                </div>
                <div style="max-width: 560px; margin: 0 auto;">
                    <div class="row">

                        @include('catalog.main_sections', ['sections' => $promSections])

                    </div>
                </div>

            </div>
            <div class="col-md-6 col-md-pull-6 nopadding side-square-entry">
                <div style="padding-top: 0;" class="block-header">
                    <h3 class="title">Потребительские товары</h3>
                </div>
                <div style="max-width: 560px; margin: 0 auto;">
                    <div class="row">

                        @include('catalog.main_sections', ['sections' => $potrebSections])

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection