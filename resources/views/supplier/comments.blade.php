@extends('supplier.main')

@section('supplier_content')

    <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
        <h3 class="block-title">Отзывы</h3>
        <div class="article-container style-1">
            <div class="row">
                <div id="comments-list" class="col-md-12 information-entry">
                    @include('comments.list',['comments'=> $comments,'id'=>$supplier->id])
                </div>
                @include('comments.form',['comments'=> $comments,'id'=>$supplier->id])
            </div>
        </div>
    </div>

@endsection