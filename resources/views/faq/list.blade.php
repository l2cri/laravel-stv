@if(isset($status))
    @include('common.status',['status'=>$status,'errors'=>$errors])
@endif
<?$items->url = '/catalog/product/'.$id;?>
@include('pagination.limit_links', ['paginator' => $items,'currentSection' => $items])
<div class="list">
    @foreach($items as $faq )
        <div class="faq pull-left">
            <div class="comment-content">
                <div class="comment-title"><span>{{ $faq->user->name  }}</span>  Опубликован {{ localizedFormat($faq->created_at)->format('d F Y')}}</div>
                <div class="comment-text">Вопрос: <br>{{ $faq->question  }}</div>
            </div>
        </div>
        <div class="clear"></div>
        @if(!empty($faq->answer))
            <div class="faq pull-right">
                <div class="comment-content">
                    <div class="comment-title"><span>{{ $faq->product->supplier->name  }}</span> Опубликован {{ localizedFormat($faq->updated_at)->format('d F Y')}}</div>
                    <div class="comment-text">Ответ:<br>{{ $faq->answer  }}</div>
                </div>
            </div>
            <div class="clear"></div>
        @endif
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
    $('#faq-list .square-button').click(function(){
        var page = getParameterByName('page',$(this).attr('href'));

        $('#faq-list').html(getHtmlLoader());

        $('#faq-list').load('{{ route('faq.page',['id'=>$id]) }}?page='+page);

        return false;
    });
</script>