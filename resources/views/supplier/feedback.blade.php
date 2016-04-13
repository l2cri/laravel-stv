<div class="information-blocks">
    <div class="row">
        <div class="col-sm-12 information-entry">
            <div class="login-box">
                <form method="post" action="{{ route('supplier.feedback',['name'=>$supplier->code]) }}">
                    {!! csrf_field() !!}
                    <label>Как к вам обращаться</label>
                    <input class="simple-field" name="name" value="{{userField('name')}}" placeholder="Введите ваше имя" />
                    <label>Текст обращения</label>
                    <textarea class="simple-field" required name="message" placeholder="Введите текст" value=""></textarea>
                    <div class="button style-10">Отправить<input type="submit" value="" /></div>
                </form>
            </div>
        </div>
    </div>
</div>