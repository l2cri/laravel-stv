<?$namePage = 'Акции'?>
@extends('supplier.main')

@section('supplier_content')

@section('breadcrumbs', Breadcrumbs::render('supplier-static',$supplier,$namePage))

<div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
    <h1 class="block-title">{{$namePage}}</h1>
    <div class="article-container style-1">
        <div class="row">
            <div class="blog-landing-box type-2">
                @foreach($news as $post)
                    <?
                    $time = localizedFormat($post->created_at);
                    ?>
                    <div class="blog-entry">
                        <div class="date">{{ $time->day  }} <span>{{ $time->format('M') }}</span></div>
                        <div class="content">
                            <span class="title">{{ $post->name }}
                                @if($post->active)
                                    <span class="inline-label green">Активна</span>
                                @else()
                                    <span class="inline-label red">Неактивна</span>
                                @endif()
                            </span>
                            <div class="description">{{ strip_tags($post->description) }}</div>
                            <div class="description">
                                <b>Начало:</b> {{localizedFormat($post->start)->format('j F Y')}}
                                <b>Конец:</b> {{localizedFormat($post->end)->format('j F Y')}}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="page-selector" style="margin-left: 100px;">
                <div class="pages-box">

                    @include('pagination.limit_links', ['paginator' => $news])

                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

@endsection