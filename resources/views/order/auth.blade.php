@extends('main')

@section('content')

    <div class="row" id="checkout_auth">
        <div class="col-md-6 information-entry">
            <div class="login-box">
                <div class="article-container style-1">
                <h3>Регистрация</h3>
                <form action="{{ route('checkout.register') }}" method="post">

                    {!! csrf_field() !!}

                    <label>Имя</label>
                    <input type="text" placeholder="Имя Фамилия" class="simple-field" name="name">
                    <label>Email</label>
                    <input type="text" placeholder="Введите Email" class="simple-field" name="email">
                    <label>Пароль</label>
                    <input type="password" class="simple-field" name="password">
                    <label>Подтвердите пароль</label>
                    <input type="password" name="password_confirmation" class="simple-field">
                    <div class="button style-12">Зарегистрироваться<input type="submit" value=""></div>
                </form>
            </div>
            </div>
        </div>
        <div class="col-md-6 information-entry">
            <div class="login-box">
                <div class="article-container style-1">
                <h3>Авторизация</h3>
                <p>Вход для пользователей нашей площадки.</p>
                <form action="{{ route('auth.post') }}" method="post">

                    {!! csrf_field() !!}

                    <input type="hidden" name="checkout_page" value="true">

                    <label>Email</label>
                    <input type="text" placeholder="Введите Email" class="simple-field" name="email">
                    <label>Пароль</label>
                    <input type="password" placeholder="Введите пароль" class="simple-field" name="password">
                    <div class="button style-10">Войти<input type="submit" value=""></div>
                    <a class="forgot-password" href="#">Забыли пароль?</a>
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection