@foreach($items as $item)
<div class="col-lg-12 col-md-4">
    <div class="swiper-slide">
        <div class="navigation-banner-wrapper align-1" style="background-image: url({{ url($item->image) }}); background-color: #f6e8d8;">
            <div class="" style="height: 145px">
                <div class="cell-view">
                    {{--<h2 class="subtitle">Распродажа 4</h2>--}}
                    {{--<h1 class="title">распродажа 4</h1>--}}
                    {{--<div class="description">Описание распродажа 4.</div>--}}
                    <div class="info">
                        <br><br><br><br><br><br><br>

                        <a class="button style-2 pull-right" href="{{$item->url}}">Подбробнее</a>
                    </div>
                </div>
            </div>
            {{--<div class="clear"></div>--}}
        </div>
    </div>
</div>
@endforeach