@extends('main')

@section('content')
    <div class="breadcrumb-box">
        <a href="#">Home</a>
        <a href="#">Login Form</a>
    </div>

    <div class="information-blocks">
        <div class="row">
            <div class="col-sm-12 information-entry">
                <div class="login-box">
                    <div class="article-container style-1">
                        <h3>Восстановление пароля</h3>
                        <p>Мы вышлем вам на почту ссылку для восстновления пароля</p>
                    </div>
                    <form method="POST" action="{{ route('password.update')}}">
                        {!! csrf_field() !!}
                        <label>Email адрес</label>
                        <input class="simple-field" type="email" name="email" value="{{ old('email') }}" placeholder="Введите ваш Email адрес" />
                        <label>Пароль</label>
                        <input class="simple-field" type="password" name="password" id="password" placeholder="Введите пароль" value="" />
                        <label>Повторить пароль</label>
                        <input class="simple-field" type="password" name="password_confirmation" placeholder="Повторите пароль" value="" />
                        <input type="hidden" name="token" value="{{$token}}" />
                        <div class="button style-10">Отправить<input type="submit" value="" /></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection