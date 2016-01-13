@if ($errors->has())
    <div class="message-box message-danger">
        <div class="message-icon"><i class="fa fa-times"></i></div>
        <div class="message-text"><b>Ошибка!</b>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
        <div class="message-close"><i class="fa fa-times"></i></div>
    </div>
@endif