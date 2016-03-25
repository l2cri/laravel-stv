<div class="blog-entry">
    <h3 class="additional-blog-title">Оставить комментарий</h3>
    <form action="{{ route('comments.add',['id'=>$id]) }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-12">
                <label>Ваш комментарий <span>*</span></label>
                <textarea class="simple-field" name="text" placeholder="Текст вашего сообщения (обязательно для заполнения)"></textarea>
                <div class="button style-10">Отправить комментарий<input type="submit" value="" /></div>
            </div>
        </div>
    </form>
</div>