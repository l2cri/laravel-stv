@extends('emails.main')

@section('content')
    <div>

        <h2 style="margin-top: 0;">Регистрация на сайте buy26.ru</h2>

        <p>Уважаемый <strong>{{ $user->name }}</strong>, спасибо за регистрацию.</p>

        <p>Для входа в личный кабинет введите Ваш email {{ $user->email }} и пароль, который Вы задали при регистрации.</p>
    </div>
@endsection