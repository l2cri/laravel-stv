@foreach($items as $item)
<div class="col-lg-12 col-md-4">
    <div class="swiper-slide">
        <div class="navigation-banner-wrapper align-1" style="background-image: url({{ url($item->image) }}); background-color: #f6e8d8; margin-bottom: 10px">

            <a href="{{$item->url}}">
                <div class="" style="height: 145px; width: 270px">
                    &nbsp;
                </div>
            </a>
        </div>
    </div>
</div>
@endforeach