@extends('main')

@section('content')

    <div class="breadcrumb-box">
        <a href="#">Главная</a>
        <a href="#">Новости</a>
    </div>

    <div class="information-blocks">
        <div class="row">

            <div class="col-md-12 information-entry">
                <div class="blog-landing-box type-2">
                    @foreach($news as $post)
                        <?
                        $url = route('news.detail', ['id' => $post->id]);
                        $time = $post->created_at;
                        ?>
                        <div class="blog-entry">
                            @if( ! empty($post->image))
                                <a class="image hover-class-1" href="{{ $url }}">
                                    <img src="/{{ $post->image }}" alt="{{ $post->name }}" />
                                    <span class="hover-label">{{ $post->name }}</span>
                                </a>
                            @endif
                            <div class="date">{{ $time->day  }} <span>{{ $time->format('M') }}</span></div>
                            <div class="content">
                                <a class="title" href="{{ $url }}">{{ $post->name }}</a>
                                <div class="description">{{ str_limit( strip_tags($post->text),20) }}</div>
                                <a class="readmore" href="{{ $url }}">читать далее</a>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="page-selector" style="margin-left: 100px;">
                    <div class="description">Showing: 1-3 of 16</div>
                    <div class="pages-box">

                        <?$news->url = '/news';?>
                        @include('pagination.limit_links', ['paginator' => $news,'currentSection' => $news])

                    </div>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
    </div>


@endsection