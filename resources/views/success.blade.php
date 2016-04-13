@if(Session::has('message'))
    <div class="message-box message-success">
        <div class="message-icon"><i class="fa fa-times"></i></div>
        <div class="message-text"><b>Успешно!</b>
            {{ Session::get('message') }}
        </div>
        <div class="message-close"><i class="fa fa-times"></i></div>
    </div>
@endif