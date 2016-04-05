@if(Auth::check())
    <div class="blog-entry">
        <form id="faq-add" action="{{ route('faq.add',['id'=>$id]) }}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-12">
                    <label>Ваш вопрос <span>*</span></label>
                    <textarea class="simple-field" name="question" placeholder="Текст вашего вопроса (обязательно для заполнения)"></textarea>
                    <div class="button style-10">Отправить вопрос<input type="submit" value="" /></div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(function(){
            $('#faq-add').submit(function(){
                var _this = $(this),
                        url = _this.attr('action'),
                        data = _this.serialize(),
                        $list = $('#faq-list');

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