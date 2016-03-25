@foreach($comments as $comment )
<div class="comment">
    <div class="comment-content">
        <div class="comment-title"><span>{{ $comment->user->name  }}</span>  Опубликован {{ localizedFormat($comment->created_at)->format('d F Y')}}</div>
        <div class="comment-text">{{ $comment->text  }}</div>
    </div>
</div>
@endforeach