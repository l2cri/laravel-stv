<?
   $firstImg = current($product->photos);

    $sharePage = [
    'url'=>route('product.page',['id'=>$product->id]),
    'title'=>$product->name,
    'description'=>$product->description,
    'image'=> url(@$firstImg->file)]
?>
@extends('main')
@section('headscripts')

    @parent

    <meta name="name"  content="{{$sharePage['title']}}" />
    <meta name="description"  content="{{$sharePage['description']}}" />
    <meta name="image"  content="{{$sharePage['image']}}" />

    <meta property="og:title" content="{{$sharePage['title']}}" />
    <meta property="og:description" content="{{$sharePage['description']}}"/>
    <meta property="og:image" content="{{$sharePage['image']}}"/>

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{$sharePage['title']}}">
    <meta name="twitter:description" content="{{$sharePage['description']}}"/>
    <meta name="twitter:image:src" content="{{$sharePage['image']}}"/>

@endsection

@section('title')
    <title>{{ $product->name }}</title>
@endsection

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
                                <img class="default-image" src="{{ url(@$firstImg->file) }}" alt="" />
                                <img class="zoomed-image" src="{{ url(@$firstImg->file) }}" alt="" />
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
                        <div class="entry number">1</div>
                        <div class="entry number-plus">&nbsp;</div>
                    </div>
                    <div class="detail-info-entry">
                        <a data-id="{{$product->id}}" class="button addToCart style-10">В корзину</a>
                        @include('common.favorite',['item'=>$product,'routeName'=>'panel::favorite-product.add','check'=>isset($favorite),'type'=>'label'])
                        <div class="clear"></div>
                    </div>
                    @include('common.social-share',$sharePage)
                </div>
            </div>
            <div class="clear visible-xs visible-sm"></div>
            <div class="col-md-4 col-lg-3 information-entry product-sidebar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="information-blocks production-logo">
                            <div class="background">
                                <div class="logo">
                                    <a href="{{ route('supplier', $product->supplier->code) }}">
                                        <img src="{{ url( $product->supplier->logo ) }}" alt="{{ $product->supplier->name }}" />
                                    </a>
                                </div>
                                <a href="{{ route('supplier', $product->supplier->code) }}">О поставщике</a>
                            </div>
                        </div>
                    </div>
                    @if(isset($randProducts))
                    <div class="col-md-12">
                        <div class="information-blocks">
                            <div class="information-entry products-list">
                                <h3 class="block-title inline-product-column-title">Рекомендуем</h3>
                                @foreach($randProducts as $randProduct)
                                <div class="inline-product-entry">
                                    <a href="{{route('product.page',['id'=>$randProduct->id])}}" class="image">
                                        <img alt="{{$randProduct->name}}" src="{{ @url($randProduct->photos->shift()->file) }}">
                                    </a>
                                    <div class="content">
                                        <div class="cell-view">
                                            <a href="{{route('product.page',['id'=>$randProduct->id])}}" class="title">{{$randProduct->name}}</a>
                                            <div class="price">
                                                @if($randProduct->action_id && $randProduct->action_price)
                                                    <div class="prev">{{$randProduct->regular_price}} <i class="fa fa-rub"></i></div>
                                                    <div class="current">{{$randProduct->action_price}} <i class="fa fa-rub"></i></div>
                                                @else
                                                    <div class="current">{{$randProduct->regular_price}} <i class="fa fa-rub"></i></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
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

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabs-entry">
                    <div class="article-container style-1">
                        <div class="row">
                            <div class="col-md-4 information-entry">
                                <h4>Условия работы</h4>
                                <p>{{strip_tags($product->supplier->conditions)}}</p>
                            </div>
                            <div class="col-md-4 information-entry">
                                <h4>Доставка</h4>
                                <p>{{strip_tags($product->supplier->responsibility)}}</p>
                            </div>

                            <div class="col-md-4 information-entry">
                                <h4>Контакты</h4>

                                <? $company = $product->supplier->company; ?>
                                @if (!empty($company))

                                    <p><b>Телефон:</b> {{ $company->phone }}</p>
                                    <p><b>E-mail:</b> {{ $company->email }}</p>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabs-entry">
                    <div class="article-container style-1">
                        <div class="row">
                            <div id="comments-list" class="col-md-12 information-entry">
                                @include('comments.list',['comments'=> $comments,'id'=>$product->id,'routeName'=>'commentProduct'])
                            </div>
                                @include('comments.form',['comments'=> $product->comments(),'id'=>$product->id,'routeName'=>'commentProduct'])
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

@endsection