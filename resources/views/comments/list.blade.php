@if(isset($status))
    @include('comments.status',['status'=>$status,'errors'=>$errors])
@endif
<?$comments->url = '/catalog/product/'.$id;?>
@include('pagination.limit_links', ['paginator' => $comments,'currentSection' => $comments])
<div class="list">
    @foreach($comments as $comment )
        <div class="comment">
            <div class="comment-content">
                <div class="comment-title"><span>{{ $comment->user->name  }}</span>  Опубликован {{ localizedFormat($comment->created_at)->format('d F Y')}}</div>
                <div class="comment-text">{{ $comment->text  }}</div>
            </div>
        </div>
    @endforeach
</div>

<script>
    function getHtmlLoader(){
        return '<div class="bubbles">' +
                '<div class="title">Загрузки</div>' +
                '<span></span>' +
                '<span id="bubble2"></span>' +
                '<span id="bubble3"></span>' +
                '</div>';
    }
    $('#comments-list .square-button').click(function(){
        var page = getParameterByName('page',$(this).attr('href'));

        $('#comments-list').html(getHtmlLoader());

        $('#comments-list').load('{{ route('comment.page',['id'=>$id]) }}?page='+page);

        return false;
    });
</script>