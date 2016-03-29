@if(isset($status) && $status == 'error')
    <div class="message-box message-danger">
        <div class="message-icon">
            <i class="fa fa-times"></i>
        </div>
        <div class="message-text">
            <b>Ошибка!</b>
            @foreach($errors->all() as $str)
                {{$str}} <br>
            @endforeach
        </div>
        <div class="message-close">
            <i class="fa fa-times"></i>
        </div>
    </div>
@elseif(isset($status) && $status == 'success')
    <div class="message-box message-success">
        <div class="message-icon">
            <i class="fa fa-times"></i>
        </div>
        <div class="message-text">
            <b>Успешно добавлен!</b>
            Спасибо за ваш комментарий.
            <br>
        </div>
        <div class="message-close">
            <i class="fa fa-times"></i>
        </div>
    </div>
@endif