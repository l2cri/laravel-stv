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
@if (session('status') && (session('status') !== 'success' && session('status') !== 'error'))
    <div class="message-box message-succes">
        <div class="message-icon"><i class="fa fa-times"></i></div>
        <div class="message-text">{{ session('status') }}</div>
        <div class="message-close"><i class="fa fa-times"></i></div>
    </div>
@endif