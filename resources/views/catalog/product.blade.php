@extends('main')

@section('content')

    <?
            $unit = !empty($product->unit) ? $product->unit : 'шт';
    ?>

    <div class="list-breadcrumb">
        @foreach($product->sections as $section)
            {!! Breadcrumbs::render('product',$product,$section) !!}
        @endforeach
    </div>

    <div class="information-blocks">
        <div class="row">
            <div class="col-sm-5 col-md-4 col-lg-5 information-entry">
                <div class="product-preview-box">
                    <div class="swiper-container product-preview-swiper" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                        <div class="swiper-wrapper">

                            @foreach( $product->photos as $photo )
                                <div class="swiper-slide">
                                    <div class="product-zoom-image">
                                        <img src="{{ url($photo->file) }}" alt="" data-zoom="{{ url($photo->file) }}" />
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="pagination"></div>
                        <div class="product-zoom-container">
                            <div class="move-box">
                                <img class="default-image" src="{{ url($product->photos[0]->file) }}" alt="" />
                                <img class="zoomed-image" src="{{ url($product->photos[0]->file) }}" alt="" />
                            </div>
                            <div class="zoom-area"></div>
                        </div>
                    </div>
                    <div class="swiper-hidden-edges">
                        <div class="swiper-container product-thumbnails-swiper" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="3" data-int-slides="3" data-sm-slides="3" data-md-slides="4" data-lg-slides="4" data-add-slides="4">
                            <div class="swiper-wrapper">

                                <?$i=0;?>
                                @foreach( $product->photos as $photo )
                                    <? $i++; ?>
                                    <div class="swiper-slide" @if($i == 1) selected @endif>
                                        <div class="paddings-container">
                                            <img src="{{ url($photo->file) }}" alt="" />
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 col-md-4 information-entry">
                <div class="product-detail-box">
                    <h1 class="product-title">{{ $product->name }}
                        @if($product->action_id && $product->action_price)
                            <span class="inline-label red">{{ $product->action->name }}</span>
                        @endif</h1>
                    <h3 class="product-subtitle">{{ $product->supplier->name }}</h3>
                    @include('rating.list',['item'=>$product,'routeName'=>'rating.rateProduct'])
                    <div class="product-description detail-info-entry">
                        {{ $product->preview }}
                    </div>
                    <div class="price detail-info-entry">

                        @if($product->action_id && $product->action_price)
                            <div class="prev">{{ $product->price }} <i class="fa fa-rub"></i></div>
                            <div class="current">{{ $product->action_price }} <i class="fa fa-rub"></i></div>
                        @else
                            <div class="current">{{ $product->price }} <i class="fa fa-rub"></i></div>
                        @endif
                            <div class="whosale">
                                {{ $product->whosale_price }} <i class="fa fa-rub"></i> оптом от {{ $product->whosale_quantity }} {{ $unit }}.
                            </div>
                    </div>
                    <div class="quantity-selector detail-info-entry">
                        <div class="detail-info-entry-title">Кол-во</div>
                        <div class="entry number-minus">&nbsp;</div>
                        <div class="entry number">10</div>
                        <div class="entry number-plus">&nbsp;</div>
                    </div>
                    <div class="detail-info-entry">
                        <a class="button style-10">В корзину</a>
                        <a class="button style-11"><i class="fa fa-heart"></i> В избранное</a>
                        <div class="clear"></div>
                    </div>
                    <div class="tags-selector detail-info-entry">
                        <div class="detail-info-entry-title">Теги:</div>
                        <a href="#">ставрополь</a>/
                        <a href="#">одежда</a>/
                        <a href="#">платья/</a>
                        <a href="#">для женщин</a>
                    </div>
                    <div class="share-box detail-info-entry">
                        <div class="title">Поделиться</div>
                        <div class="socials-box">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="clear visible-xs visible-sm"></div>
            <div class="col-md-4 col-lg-3 information-entry product-sidebar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="information-blocks production-logo">
                            <div class="background">
                                <div class="logo"><img src="{{ url( $product->supplier->logo ) }}" alt="{{ $product->supplier->name }}" /></div>
                                <a href="{{ route('supplier', $product->supplier->code) }}">О поставщике</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="information-blocks">
                            <div class="information-entry products-list">
                                <h3 class="block-title inline-product-column-title">Рекомендуем</h3>
                                <div class="inline-product-entry">
                                    <a href="#" class="image"><img alt="" src="{{ url('img/product-image-inline-1.jpg') }}"></a>
                                    <div class="content">
                                        <div class="cell-view">
                                            <a href="#" class="title">Товар 1</a>
                                            <div class="price">
                                                <div class="prev">199,99 <i class="fa fa-rub"></i></div>
                                                <div class="current">119,99 <i class="fa fa-rub"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="inline-product-entry">
                                    <a href="#" class="image"><img alt="" src="{{ url('img/product-image-inline-1.jpg') }}"></a>
                                    <div class="content">
                                        <div class="cell-view">
                                            <a href="#" class="title">Товар 2</a>
                                            <div class="price">
                                                <div class="prev">199,99 <i class="fa fa-rub"></i></div>
                                                <div class="current">119,99 <i class="fa fa-rub"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="inline-product-entry">
                                    <a href="#" class="image"><img alt="" src="{{ url('img/product-image-inline-1.jpg') }}"></a>
                                    <div class="content">
                                        <div class="cell-view">
                                            <a href="#" class="title">Товар 3</a>
                                            <div class="price">
                                                <div class="prev">199,99 <i class="fa fa-rub"></i></div>
                                                <div class="current">119,99 <i class="fa fa-rub"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="information-blocks">
        <div class="tabs-container style-1">
            <div class="swiper-tabs tabs-switch">
                <div class="title">Описание</div>
                <div class="list">
                    <a class="tab-switcher active">Описание</a>
                    <a class="tab-switcher">Условия работы</a>
                    <a class="tab-switcher">Отзывы ({{ $comments->total()  }})</a>
                    <a class="tab-switcher">Вопросы ({{ $faq->total() }})</a>
                    <div class="clear"></div>
                </div>
            </div>
            <div>
                <div class="tabs-entry">
                    <div class="article-container style-1">
                        <div class="row">
                            <div class="col-md-12 information-entry">

                                <h4>Подзаголовок</h4>
                                <p>{!! $product->description !!}</p>

                                <h4>Габариты</h4>
                                @if (!empty($product->weight)) <b>Вес:</b> {{ $product->weight }} грамм. <br>@endif
                                @if (!empty($product->volume)) <b>Объем:</b> {{ $product->volume }} мл. <br>@endif
                                @if (!empty($product->length)) <b>Длина:</b> {{ $product->length }} мм. <br>@endif
                                @if (!empty($product->width)) <b>Ширина:</b> {{ $product->width }} мм. <br>@endif
                                @if (!empty($product->height)) <b>Высота:</b> {{ $product->height }} мм. <br>@endif
                                <br>

                                <h4>5 причин заказать товар у нас</h4>
                                <ul>
                                    <li>Раз</li>
                                    <li>Два</li>
                                    <li>Три</li>
                                    <li>Четыре</li>
                                    <li>Пять</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabs-entry">
                    <div class="article-container style-1">
                        <div class="row">
                            <div class="col-md-6 information-entry">
                                <h4>Обмен/Возврат</h4>
                                <p>Вы можете вернуть или обменять товар в течение 14 дней без объяснения причин.
                                Для этого Вам нужно сделать следующее:</p>
                                <ul>
                                    <li>Раз</li>
                                    <li>Два</li>
                                    <li>Три</li>
                                    <li>Четыре</li>
                                    <li>Пять</li>
                                </ul>
                            </div>
                            <div class="col-md-6 information-entry">
                                <h4>Доставка</h4>
                                <p>Мы доставляем товар следующими способами:</p>
                                <ul>
                                    <li>Раз</li>
                                    <li>Два</li>
                                    <li>Три</li>
                                    <li>Четыре</li>
                                    <li>Пять</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabs-entry">
                    <div class="article-container style-1">
                        <div class="row">
                            <div id="comments-list" class="col-md-12 information-entry">
                                @include('comments.list',['comments'=> $comments,'id'=>$product->id])
                            </div>
                                @include('comments.form',['comments'=> $product->comments(),'id'=>$product->id])
                        </div>
                    </div>
                </div>
                <div class="tabs-entry">
                    <div class="article-container style-1">
                        <div class="row">
                            <div id="faq-list" class="col-md-12 information-entry">
                                @include('faq.list',['items' => $faq,'id'=>$product->id])
                            </div>
                            @include('faq.form',['comments'=> $product->comments(),'id'=>$product->id])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="information-blocks">--}}
        {{--<div class="tabs-container">--}}
            {{--<div class="swiper-tabs tabs-switch">--}}
                {{--<div class="title">Products</div>--}}
                {{--<div class="list">--}}
                    {{--<a class="block-title tab-switcher active">Featured Products</a>--}}
                    {{--<a class="block-title tab-switcher">Popular Products</a>--}}
                    {{--<a class="block-title tab-switcher">New Arrivals</a>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div>--}}
                {{--<div class="tabs-entry">--}}
                    {{--<div class="products-swiper">--}}
                        {{--<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5" data-add-slides="5">--}}
                            {{--<div class="swiper-wrapper">--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-1.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-11.jpg" alt="" />--}}
                                                {{--<a class="top-line-a left"><i class="fa fa-retweet"></i></a>--}}
                                                {{--<a class="top-line-a right"><i class="fa fa-heart"></i></a>--}}
                                                {{--<div class="bottom-line">--}}
                                                    {{--<a class="bottom-line-a"><i class="fa fa-shopping-cart"></i> Add to cart</a>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-2.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-12.jpg" alt="" />--}}
                                                {{--<a class="top-line-a right"><i class="fa fa-expand"></i> <span>Quick View</span></a>--}}
                                                {{--<div class="bottom-line">--}}
                                                    {{--<div class="right-align">--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="left-align">--}}
                                                        {{--<a class="bottom-line-a"><i class="fa fa-shopping-cart"></i> Add to cart</a>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-3.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-11.jpg" alt="" />--}}
                                                {{--<div class="bottom-line left-attached">--}}
                                                    {{--<a class="bottom-line-a square"><i class="fa fa-shopping-cart"></i></a>--}}
                                                    {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                                                    {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                                                    {{--<a class="bottom-line-a square"><i class="fa fa-expand"></i></a>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-4.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-12.jpg" alt="" />--}}
                                                {{--<a class="top-line-a right"><i class="fa fa-expand"></i> <span>Quick View</span></a>--}}
                                                {{--<div class="bottom-line">--}}
                                                    {{--<div class="right-align">--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="left-align">--}}
                                                        {{--<a class="bottom-line-a"><i class="fa fa-shopping-cart"></i> Add to cart</a>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-5.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-11.jpg" alt="" />--}}
                                                {{--<a class="top-line-a right"><i class="fa fa-expand"></i> <span>Quick View</span></a>--}}
                                                {{--<div class="bottom-line">--}}
                                                    {{--<div class="right-align">--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="left-align">--}}
                                                        {{--<a class="bottom-line-a"><i class="fa fa-shopping-cart"></i> Add to cart</a>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="pagination"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="tabs-entry">--}}
                    {{--<div class="products-swiper">--}}
                        {{--<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5" data-add-slides="5">--}}
                            {{--<div class="swiper-wrapper">--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-6.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-12.jpg" alt="" />--}}
                                                {{--<a class="top-line-a left"><i class="fa fa-retweet"></i></a>--}}
                                                {{--<a class="top-line-a right"><i class="fa fa-heart"></i></a>--}}
                                                {{--<div class="bottom-line">--}}
                                                    {{--<a class="bottom-line-a"><i class="fa fa-shopping-cart"></i> Add to cart</a>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-7.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-11.jpg" alt="" />--}}
                                                {{--<a class="top-line-a right"><i class="fa fa-expand"></i> <span>Quick View</span></a>--}}
                                                {{--<div class="bottom-line">--}}
                                                    {{--<div class="right-align">--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="left-align">--}}
                                                        {{--<a class="bottom-line-a"><i class="fa fa-shopping-cart"></i> Add to cart</a>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-8.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-12.jpg" alt="" />--}}
                                                {{--<div class="bottom-line left-attached">--}}
                                                    {{--<a class="bottom-line-a square"><i class="fa fa-shopping-cart"></i></a>--}}
                                                    {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                                                    {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                                                    {{--<a class="bottom-line-a square"><i class="fa fa-expand"></i></a>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-9.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-11.jpg" alt="" />--}}
                                                {{--<a class="top-line-a right"><i class="fa fa-expand"></i> <span>Quick View</span></a>--}}
                                                {{--<div class="bottom-line">--}}
                                                    {{--<div class="right-align">--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="left-align">--}}
                                                        {{--<a class="bottom-line-a"><i class="fa fa-shopping-cart"></i> Add to cart</a>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-10.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-12.jpg" alt="" />--}}
                                                {{--<a class="top-line-a right"><i class="fa fa-expand"></i> <span>Quick View</span></a>--}}
                                                {{--<div class="bottom-line">--}}
                                                    {{--<div class="right-align">--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="left-align">--}}
                                                        {{--<a class="bottom-line-a"><i class="fa fa-shopping-cart"></i> Add to cart</a>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="pagination"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="tabs-entry">--}}
                    {{--<div class="products-swiper">--}}
                        {{--<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5" data-add-slides="5">--}}
                            {{--<div class="swiper-wrapper">--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-1.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-11.jpg" alt="" />--}}
                                                {{--<a class="top-line-a left"><i class="fa fa-retweet"></i></a>--}}
                                                {{--<a class="top-line-a right"><i class="fa fa-heart"></i></a>--}}
                                                {{--<div class="bottom-line">--}}
                                                    {{--<a class="bottom-line-a"><i class="fa fa-shopping-cart"></i> Add to cart</a>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-3.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-11.jpg" alt="" />--}}
                                                {{--<a class="top-line-a right"><i class="fa fa-expand"></i> <span>Quick View</span></a>--}}
                                                {{--<div class="bottom-line">--}}
                                                    {{--<div class="right-align">--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="left-align">--}}
                                                        {{--<a class="bottom-line-a"><i class="fa fa-shopping-cart"></i> Add to cart</a>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-5.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-11.jpg" alt="" />--}}
                                                {{--<div class="bottom-line left-attached">--}}
                                                    {{--<a class="bottom-line-a square"><i class="fa fa-shopping-cart"></i></a>--}}
                                                    {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                                                    {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                                                    {{--<a class="bottom-line-a square"><i class="fa fa-expand"></i></a>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-7.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-11.jpg" alt="" />--}}
                                                {{--<a class="top-line-a right"><i class="fa fa-expand"></i> <span>Quick View</span></a>--}}
                                                {{--<div class="bottom-line">--}}
                                                    {{--<div class="right-align">--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="left-align">--}}
                                                        {{--<a class="bottom-line-a"><i class="fa fa-shopping-cart"></i> Add to cart</a>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="swiper-slide">--}}
                                    {{--<div class="paddings-container">--}}
                                        {{--<div class="product-slide-entry shift-image">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<img src="img/product-minimal-9.jpg" alt="" />--}}
                                                {{--<img src="img/product-minimal-11.jpg" alt="" />--}}
                                                {{--<a class="top-line-a right"><i class="fa fa-expand"></i> <span>Quick View</span></a>--}}
                                                {{--<div class="bottom-line">--}}
                                                    {{--<div class="right-align">--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                                                        {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="left-align">--}}
                                                        {{--<a class="bottom-line-a"><i class="fa fa-shopping-cart"></i> Add to cart</a>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<a class="tag" href="#">Men clothing</a>--}}
                                            {{--<a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>--}}
                                            {{--<div class="rating-box">--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star"><i class="fa fa-star"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="price">--}}
                                                {{--<div class="prev">$199,99</div>--}}
                                                {{--<div class="current">$119,99</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="pagination"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="information-blocks">--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-4 information-entry">--}}
                {{--<h3 class="block-title inline-product-column-title">Featured products</h3>--}}
                {{--<div class="inline-product-entry">--}}
                    {{--<a href="#" class="image"><img alt="" src="img/product-image-inline-1.jpg"></a>--}}
                    {{--<div class="content">--}}
                        {{--<div class="cell-view">--}}
                            {{--<a href="#" class="title">Ladies Pullover Batwing Sleeve Zigzag</a>--}}
                            {{--<div class="price">--}}
                                {{--<div class="prev">$199,99</div>--}}
                                {{--<div class="current">$119,99</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}

                {{--<div class="inline-product-entry">--}}
                    {{--<a href="#" class="image"><img alt="" src="img/product-image-inline-2.jpg"></a>--}}
                    {{--<div class="content">--}}
                        {{--<div class="cell-view">--}}
                            {{--<a href="#" class="title">Ladies Pullover Batwing Sleeve Zigzag</a>--}}
                            {{--<div class="price">--}}
                                {{--<div class="prev">$199,99</div>--}}
                                {{--<div class="current">$119,99</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}

                {{--<div class="inline-product-entry">--}}
                    {{--<a href="#" class="image"><img alt="" src="img/product-image-inline-3.jpg"></a>--}}
                    {{--<div class="content">--}}
                        {{--<div class="cell-view">--}}
                            {{--<a href="#" class="title">Ladies Pullover Batwing Sleeve Zigzag</a>--}}
                            {{--<div class="price">--}}
                                {{--<div class="prev">$199,99</div>--}}
                                {{--<div class="current">$119,99</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4 information-entry">--}}
                {{--<h3 class="block-title inline-product-column-title">Featured products</h3>--}}
                {{--<div class="inline-product-entry">--}}
                    {{--<a href="#" class="image"><img alt="" src="img/product-image-inline-1.jpg"></a>--}}
                    {{--<div class="content">--}}
                        {{--<div class="cell-view">--}}
                            {{--<a href="#" class="title">Ladies Pullover Batwing Sleeve Zigzag</a>--}}
                            {{--<div class="price">--}}
                                {{--<div class="prev">$199,99</div>--}}
                                {{--<div class="current">$119,99</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}

                {{--<div class="inline-product-entry">--}}
                    {{--<a href="#" class="image"><img alt="" src="img/product-image-inline-2.jpg"></a>--}}
                    {{--<div class="content">--}}
                        {{--<div class="cell-view">--}}
                            {{--<a href="#" class="title">Ladies Pullover Batwing Sleeve Zigzag</a>--}}
                            {{--<div class="price">--}}
                                {{--<div class="prev">$199,99</div>--}}
                                {{--<div class="current">$119,99</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}

                {{--<div class="inline-product-entry">--}}
                    {{--<a href="#" class="image"><img alt="" src="img/product-image-inline-3.jpg"></a>--}}
                    {{--<div class="content">--}}
                        {{--<div class="cell-view">--}}
                            {{--<a href="#" class="title">Ladies Pullover Batwing Sleeve Zigzag</a>--}}
                            {{--<div class="price">--}}
                                {{--<div class="prev">$199,99</div>--}}
                                {{--<div class="current">$119,99</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4 information-entry">--}}
                {{--<h3 class="block-title inline-product-column-title">Featured products</h3>--}}
                {{--<div class="inline-product-entry">--}}
                    {{--<a href="#" class="image"><img alt="" src="img/product-image-inline-1.jpg"></a>--}}
                    {{--<div class="content">--}}
                        {{--<div class="cell-view">--}}
                            {{--<a href="#" class="title">Ladies Pullover Batwing Sleeve Zigzag</a>--}}
                            {{--<div class="price">--}}
                                {{--<div class="prev">$199,99</div>--}}
                                {{--<div class="current">$119,99</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}

                {{--<div class="inline-product-entry">--}}
                    {{--<a href="#" class="image"><img alt="" src="img/product-image-inline-2.jpg"></a>--}}
                    {{--<div class="content">--}}
                        {{--<div class="cell-view">--}}
                            {{--<a href="#" class="title">Ladies Pullover Batwing Sleeve Zigzag</a>--}}
                            {{--<div class="price">--}}
                                {{--<div class="prev">$199,99</div>--}}
                                {{--<div class="current">$119,99</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}

                {{--<div class="inline-product-entry">--}}
                    {{--<a href="#" class="image"><img alt="" src="img/product-image-inline-3.jpg"></a>--}}
                    {{--<div class="content">--}}
                        {{--<div class="cell-view">--}}
                            {{--<a href="#" class="title">Ladies Pullover Batwing Sleeve Zigzag</a>--}}
                            {{--<div class="price">--}}
                                {{--<div class="prev">$199,99</div>--}}
                                {{--<div class="current">$119,99</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection