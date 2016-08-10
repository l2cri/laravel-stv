@extends('main')

@section('content')

<div class="row">
    @if(isset($banners))
    <div class="col-lg-9 col-md-9 hidden-xs">
        <div class="information-blocks">
            <div class="row">
                <div class="col-md-12">
                    @include('home.slider',['items'=>$banners])
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-lg-3 col-md-3 hidden-xs">
        <div class="row">
            @include('home.right-banners',['items'=>$rightBanners])
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="catalizator-section">
    <div class="title">
        Потребительские товары
    </div>
    <div class="row">

        @foreach($potrebSections as $potrebS)
            @if($potrebS->depth == 1)
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <a class="wrap-icon" href="{{ url($potrebS->url) }}">
                        <i class="{{ $potrebS->icon }}"></i>
                        <span class="section-name">{{ $potrebS->name }}</span>
                    </a>
                </div>
            @endif
        @endforeach

    </div>
</div>

<div class="clear"></div>
<div class="catalizator-section">
    <div class="title">
        Промышленные товары
    </div>
    <div class="row">

        @foreach($promSections as $promS)
            @if($promS->depth == 1)
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <a class="wrap-icon" href="{{ url($promS->url) }}">
                        <i class="{{ $promS->icon }}"></i>
                        <span class="section-name">{{ $promS->name }}</span>
                    </a>
                </div>
            @endif
        @endforeach

    </div>
</div>

@endsection