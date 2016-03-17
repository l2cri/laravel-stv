@extends('main')

@section('content')

    <div class="breadcrumb-box">
        <a href="#">Главная</a>
        <a href="{{ route('news.index')  }}">Новости</a>
        <a href="#">{{ $post->name }}</a>
    </div>

    <div class="information-blocks">
        <div class="row">

            <div class="col-md-12 information-entry">
                <div class="blog-landing-box type-1 detail-post">
                    <div class="blog-entry">
                        @if( ! empty($post->image))
                            <a class="image hover-class-1" href="#">
                                <img src="{{ $post->image }}" alt="{{ $post->name }}" />
                                <span class="hover-label">{{ $post->name }}</span>
                            </a>
                        @endif
                        <div class="content">
                            <h1 class="title">{{ $post->name }}</h1>

                            <div class="article-container style-1">
                                {!!  $post->text !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection