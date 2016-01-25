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
                            <div class="inline-text">Сортировать по</div>
                            <div class="simple-drop-down">
                                <select>
                                    <option>Названию</option>
                                    <option>Цене</option>
                                    <option>Рейтингу</option>
                                </select>
                            </div>
                            <div class="sort-button"></div>
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
                    <div class="accordeon">

                        <? $opened = false;
                           $previosDepth = 0;
                        ?>
                        @foreach($sections as $section)

                            {{--первый уровень и есть потомки--}}
                            @if( ($section->depth == 1) && ($previosDepth <= 1) )

                                @if (count($section->children) > 0 && !$opened)
                                    <? $opened = true; ?>
                                    <div class="accordeon-title">{{ $section->name }}</div>
                                        <div class="accordeon-entry">
                                            <div class="article-container style-1">
                                                <ul>
                                @else
                                    <a href="{{ url($section->url) }}" class="nonaccordeon-title">{{ $section->name }}</a>
                                @endif
                            @endif

                            {{--первый уроверь и предыдущая первый уровень, плюс открыто -  то есть закрываем--}}
                            @if( ($section->depth == 1) && ($previosDepth == 2) && $opened )
                                <?$opened = false;?>
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            @if ($section->depth == 2)
                                <li><a href="{{ url($section->url) }}">{{ $section->name }}</a></li>
                            @endif


                            <? // избегаем нулевых больших категорий
                                    $previosDepth = (int) ($section->depth > 0) ? $section->depth : $previosDepth;?>
                        @endforeach

                    </div>
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

                {{--<div class="information-blocks">--}}
                    {{--<div class="block-title size-2">По размеру</div>--}}
                    {{--<div class="size-selector">--}}
                        {{--<div class="entry active">xs</div>--}}
                        {{--<div class="entry">s</div>--}}
                        {{--<div class="entry">m</div>--}}
                        {{--<div class="entry">l</div>--}}
                        {{--<div class="entry">xl</div>--}}
                        {{--<div class="spacer"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

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

                {{--<div class="information-blocks">--}}
                    {{--<div class="block-title size-2">По цвету</div>--}}
                    {{--<div class="color-selector detail-info-entry">--}}
                        {{--<div style="background-color: #cf5d5d;" class="entry active"></div>--}}
                        {{--<div style="background-color: #c9459f;" class="entry"></div>--}}
                        {{--<div style="background-color: #689dd4;" class="entry"></div>--}}
                        {{--<div style="background-color: #68d4aa;" class="entry"></div>--}}
                        {{--<div style="background-color: #a8d468;" class="entry"></div>--}}
                        {{--<div style="background-color: #d4c368;" class="entry"></div>--}}
                        {{--<div style="background-color: #c2c2c2;" class="entry"></div>--}}
                        {{--<div style="background-color: #000000;" class="entry"></div>--}}
                        {{--<div style="background-color: #f0f0f0;" class="entry"></div>--}}
                        {{--<div class="spacer"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

            </div>
        </div>
    </div>


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