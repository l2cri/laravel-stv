<div class="page-selector">
    <div class="pages-box hidden-xs">

        @include('pagination.limit_links', ['paginator' => $suppliers])

    </div>
    <div class="shop-grid-controls">
        <div class="entry">
            @include('suppliers.sort')
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

    @foreach($suppliers as $supplier)

        <div class="col-md-3 col-sm-4 shop-grid-item">
            <div class="product-slide-entry shift-image">
                <div>
                    <img src="{{ @url($supplier->logo) }}" alt="{{ $supplier->name }}" />
                    {{--<img src="{{ @url($product->photos[1]->file) }}" alt="" />--}}

                    {{--<div class="bottom-line left-attached">--}}
                        {{--<a class="bottom-line-a square addToCart" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i></a>--}}
                        {{--<a class="bottom-line-a square"><i class="fa fa-heart"></i></a>--}}
                        {{--<a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>--}}
                        {{--<a class="bottom-line-a square"><i class="fa fa-expand"></i></a>--}}
                    {{--</div>--}}
                </div>
                {{--<a class="tag" href="{{ url($section->url) }}">{{ $section->name }}</a>--}}
                <a class="title" href="{{ route('supplier', $supplier->code) }}">{{ $supplier->name }}</a>
                <div class="rating-box">
                    <div class="star"><i class="fa fa-star"></i></div>
                    <div class="star"><i class="fa fa-star"></i></div>
                    <div class="star"><i class="fa fa-star"></i></div>
                    <div class="star"><i class="fa fa-star"></i></div>
                    <div class="star"><i class="fa fa-star"></i></div>
                    <div class="reviews-number">отзывы (25)</div>
                </div>
                <div class="article-container style-1">
                    <p>{{ $supplier->conditions }}</p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    @endforeach

</div>
<div class="page-selector">
    <div class="description">Товары: 1-3 из 16</div>
    <div class="pages-box">

        @include('pagination.limit_links', ['paginator' => $suppliers])

    </div>
    <div class="clear"></div>
</div>