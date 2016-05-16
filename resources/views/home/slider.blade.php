<div class="navigation-banner-swiper size-1">

    <div class="swiper-container" data-autoplay="5000" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="1">
        <div class="swiper-wrapper">
            @foreach($items as $key => $slide)
            <div class="swiper-slide @if($key == 0) active @endif " data-val="{{($slide->id)-1}}">
                <div class="navigation-banner-wrapper align-1" style="background-image: url({{ url($slide->image) }}); background-color: #f5f1e2;">
                    <div class="navigation-banner-content">
                        <div class="cell-view">
                            @if($slide->name)
                            {{--<h1 class="title">{{$slide->name}}</h1>--}}
                            @endif
                            <div class="description"></div>
                            @if($slide->url)
                            <div class="info">
                                <a class="button style-2" href="{{url($slide->url)}}">Подробнее</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="clear"></div>
        <div class="pagination"></div>
    </div>

</div>