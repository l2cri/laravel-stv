@foreach($items as $item)
<div class="col-lg-12 col-md-4">
    <div class="swiper-slide">
        <div class="navigation-banner-wrapper align-1">

            <a href="{{$item->url}}">
                <img src="{{ url($item->image) }}" style="margin-bottom: 16px; margin-left: 12px">
            </a>
        </div>
    </div>
</div>
@endforeach