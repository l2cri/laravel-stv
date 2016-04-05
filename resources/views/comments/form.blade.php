@if(Auth::check())
<div class="blog-entry">
    <form id="comment-add" action="{{ route('comments.add',['id'=>$id]) }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-12">
                <label>Ваш комментарий <span>*</span></label>
                <textarea class="simple-field" name="text" placeholder="Текст вашего сообщения (обязательно для заполнения)"></textarea>
                <div class="button style-10">Отправить отзыв<input type="submit" value="" /></div>
            </div>
        </div>
    </form>
</div>
    <script>
        $(function(){
            $('#comment-add').submit(function(){
                var _this = $(this),
                    url = _this.attr('action'),
                    data = _this.serialize(),
                    $list = $('#comments-list');

                $list.html(getHtmlLoader());

                submitFormByAjax(url, data).done(function(data) {
                    $list.html(data);
                    _this[0].reset();
                })
                .fail(function(jqXHR) {
                      $list.html("Ошибка: "+jqXHR.responseText);
                });

                return false;
            });
        });
    </script>
@else
    <div><a href="{{route('login')}}">Войдите, чтобы оставить комментарий</a></div>
@endif