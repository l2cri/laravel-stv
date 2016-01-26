@extends('main')

@section('content')

    <div class="breadcrumb-box">
        <a href="#">Главная</a>
        <a href="#">Каталог</a>
    </div>

    <div class="information-blocks">
        <div class="row">
            <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">

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
                            <div class="inline-text">На странице</div>
                            <div class="simple-drop-down" style="width: 75px;">
                                <select>
                                    <option>12</option>
                                    <option>20</option>
                                    <option>30</option>
                                    <option>40</option>
                                    <option>all</option>
                                </select>
                            </div>
                            {{--<div class="inline-text">на странице</div>--}}
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
                                <div class="bottom-line left-attached">
                                    <a class="bottom-line-a square"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="bottom-line-a square"><i class="fa fa-heart"></i></a>
                                    <a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>
                                    <a class="bottom-line-a square"><i class="fa fa-expand"></i></a>
                                </div>
                            </div>
                            <a class="tag" href="{{ url($section->url) }}">{{ $section->name }}</a>
                            <a class="title" href="{{ route('product.page', ['id' => $product->id]) }}">{{ $product->name }}</a>
                            <div class="rating-box">
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="reviews-number">отзывы (25)</div>
                            </div>
                            <div class="article-container style-1">
                                <p>{{ $product->preview }}</p>
                            </div>
                            <div class="price">
                                {{--<div class="prev">$199,99</div>--}}
                                <div class="current">{{ $product->price }} <i class="fa fa-rub"></i></div>
                            </div>
                            <div class="list-buttons">
                                <a class="button style-10">В корзину</a>
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
                <div class="information-blocks categories-border-wrapper">
                    <div class="block-title size-3">Каталог</div>
                    @include('common.sectionaccordion')
                </div>

                <div class="information-blocks">
                    <div class="block-title size-2">По цене</div>
                    <div class="range-wrapper">
                        <div id="prices-range"></div>
                        <div class="range-price">
                            Цена:
                            <div class="min-price"><b><span>0</span> <i class="fa fa-rub"></i></b></div>
                            <b>-</b>
                            <div class="max-price"><b><span>200</span> <i class="fa fa-rub"></i></b></div>
                        </div>
                        <a class="button style-14">Фильтр</a>
                    </div>
                </div>

                <div class="information-blocks">
                    <div class="block-title size-2">По производителю</div>
                    <div class="row">
                        <div class="col-xs-6">
                            <label class="checkbox-entry">
                                <input type="checkbox" /> <span class="check"></span> Армани
                            </label>
                            <label class="checkbox-entry">
                                <input type="checkbox" /> <span class="check"></span> ДольчеГабанна
                            </label>
                            <label class="checkbox-entry">
                                <input type="checkbox" /> <span class="check"></span> Дядя Ваня
                            </label>
                            <label class="checkbox-entry">
                                <input type="checkbox" /> <span class="check"></span> Юнилевер
                            </label>
                        </div>
                        <div class="col-xs-6">
                            <label class="checkbox-entry">
                                <input type="checkbox" /> <span class="check"></span> Армани
                            </label>
                            <label class="checkbox-entry">
                                <input type="checkbox" /> <span class="check"></span> Дольче Габанна
                            </label>
                            <label class="checkbox-entry">
                                <input type="checkbox" /> <span class="check"></span> Дядя Ваня
                            </label>
                            <label class="checkbox-entry">
                                <input type="checkbox" /> <span class="check"></span> Юнилевер
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- range slider -->
    <script src="{{ url('js/jquery-ui.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            var minVal = parseInt($('.min-price span').text());
            var maxVal = parseInt($('.max-price span').text());
            $( "#prices-range" ).slider({
                range: true,
                min: minVal,
                max: maxVal,
                step: 5,
                values: [ minVal, maxVal ],
                slide: function( event, ui ) {
                    $('.min-price span').text(ui.values[ 0 ]);
                    $('.max-price span').text(ui.values[ 1 ]);
                }
            });
        });
    </script>

@endsection