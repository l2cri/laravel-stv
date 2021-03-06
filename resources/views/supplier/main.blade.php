@extends('main')

@section('logo')
    <a id="logo" href="{{ route('supplier', $supplier->code) }}">
        <img src="{{ url( $supplier->logo_store ? $supplier->logo_store : $supplier->logo ) }}" alt="" />
    </a>
@endsection

@section('title')
    <title>{{ $supplier->name }} - каталог товаров на buy26.ru</title>
@endsection

@section('supplier_contacts')
    <? $company = $supplier->company; ?>
    @if(!empty($company))
        <div class="header-functionality-entry">
            <i class="fa fa-phone"></i> {{ $company->phone }} &nbsp; &nbsp; |
            &nbsp; &nbsp; <i class="fa fa-envelope-o"></i> <a href="mailto:{{ $company->email }}">{{ $company->email }}</a>
        </div>
    @endif
@endsection

@section('content')

    @section('breadcrumbs', Breadcrumbs::render('supplier',$supplier,@$currentSection))

    <div class="information-blocks">
        <div class="row">

            @yield('supplier_content')

            <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 blog-sidebar">
                @if(isset($sections))
                <div class="information-blocks categories-border-wrapper">
                    <div class="block-title size-3">
                        <a href="{{ route('supplier', $supplier->code) }}">Каталог {{ $supplier->name }}</a>
                    </div>
                    @include('rating.list',['item'=>$supplier,'routeName'=>'rating.rateSupplier'])
                    @include('supplier.sectionaccordion')
                </div>

                @include('catalog.filter', [ 'filterRoute' => route('supplier.ajax', $supplier->code) ])

                <br><br><br>
                @endif
                <div class="information-blocks">
                    <div class="categories-list">
                        <div class="block-title size-3">Компания</div>
                        <ul>
                            <li><a href="{{ route('supplier.about', $supplier->code) }}"> О нас </a></li>
                            <li><a href="{{ route('supplier.comments', $supplier->code) }}"> Отзывы </a></li>
                            <li><a href="{{ route('supplier.actions', $supplier->code) }}"> Акции </a></li>
                            <li><a href="{{ route('supplier.contacts', $supplier->code) }}"> Контакты </a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if( !empty( $supplier->color ) )

        <?
        $color = new \Mexitek\PHPColors\Color( $supplier->color );
        ?>

        <style>
            a {color: {{ $supplier->color }} }
            body.style-2 .price .current { color: {{ $supplier->color }} }
            body.style-2 .product-slide-entry .title:hover{color: {{ $supplier->color }};}
            .header-wrapper.style-2 .navigation {background-color: {{ $supplier->color }}}
            .navigation-search-content .toggle-desktop-menu {border-left: 1px solid #{{ $color->lighten(30) }} }
            .header-wrapper.style-2 header:not(.fixed-header) nav > ul > li .fa { color: #{{ $color->lighten(30) }} }
        </style>

    @endif

@endsection