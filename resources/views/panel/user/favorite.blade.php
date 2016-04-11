@extends('main')

@section('content')


<div class="information-blocks">
    <div class="row">
        <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4" id="catalogProducts">

            <div class="page-selector">
                <div class="pages-box hidden-xs">

                    @include('pagination.limit_links', ['paginator' => $products])

                </div>
                <div class="shop-grid-controls">
                    <div class="entry">
                        @include('catalog.sort')
                    </div>
                    <div class="entry">
                        <div class="view-button active grid"><i class="fa fa-th"></i></div>
                        <div class="view-button list"><i class="fa fa-list"></i></div>
                    </div>
                    <div class="entry">
                        @include('catalog.perpage')
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="row shop-grid grid-view">

                @foreach($products as $product)
                    <? $section = $product->sections[0]; ?>
                    <div class="col-md-3 col-sm-4 shop-grid-item">
                        <div class="product-slide-entry shift-image">
                            <div class="product-image">
                                <img src="{{ @url($product->photos[0]->file) }}" alt="" />
                                <img src="{{ @url($product->photos[1]->file) }}" alt="" />

                                @if($product->action_id && $product->action_price)
                                    <div class="product-image-label type-2">
                                        <span>Акция</span>
                                    </div>
                                @endif

                                <div class="bottom-line left-attached">
                                    <a class="bottom-line-a square addToCart" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="bottom-line-a square"><i class="fa fa-heart"></i></a>
                                    <a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>
                                    <a class="bottom-line-a square"><i class="fa fa-expand"></i></a>
                                </div>
                            </div>
                            <a class="tag" href="{{ url($section->url) }}">{{ $section->name }}</a>
                            <a class="title" href="{{ route('product.page', ['id' => $product->id]) }}">{{ $product->name }}</a>
                            @include('rating.list',['item'=>$product,'routeName'=>'rating.rateProduct'])
                            <div class="article-container style-1">
                                <p>{{ $product->preview }}</p>
                            </div>
                            <div class="price">

                                @if($product->action_id && $product->action_price)
                                    <div class="prev">{{ $product->price }} <i class="fa fa-rub"></i></div>
                                    <div class="current">{{ $product->action_price }} <i class="fa fa-rub"></i></div>
                                @else
                                    <div class="current">{{ $product->price }} <i class="fa fa-rub"></i></div>
                                @endif

                            </div>
                            <div class="list-buttons">
                                <a class="button style-10 addToCart" data-id="{{ $product->id }}">В корзину</a>
                                <a class="button style-11"><i class="fa fa-heart"></i> В избранное</a>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                @endforeach

            </div>
            <div class="page-selector">
                <div class="description">Товары: 1-3 из 16</div>
                <div class="pages-box">

                    @include('pagination.limit_links', ['paginator' => $products])

                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 blog-sidebar">
            @include('catalog.filter', ['filterRoute' => '/panel/user/favorite/ajax'])
        </div>
    </div>
</div>

@endsection