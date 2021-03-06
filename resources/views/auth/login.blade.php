@extends('main')

@section('content')
    <div class="breadcrumb-box">
        <a href="#">Home</a>
        <a href="#">Login Form</a>
    </div>

    <div class="information-blocks">
        <div class="row">
            <div class="col-sm-6 information-entry">
                <div class="login-box">
                    <div class="article-container style-1">
                        <h3>Зарегистрированный пользователь</h3>
                        <p>Если вы ужезарегистрированы на сайте, то введите сюда email и пароль, указанные при регистрации</p>
                    </div>
                    <form method="POST" action="{{ route('auth.post')}}">
                        {!! csrf_field() !!}
                        <label>Email адрес</label>
                        <input class="simple-field" type="email" name="email" value="{{ old('email') }}" placeholder="Введите ваш Email адрес" />
                        <label>Пароль</label>
                        <input class="simple-field" type="password" name="password" id="password" placeholder="Введите пароль" value="" />
                        <label class="checkbox-entry">
                            <input type="checkbox" name="remember" value="1" />
                            <span class="check"></span> Запомнить меня
                        </label>
                        <div class="pull-right"><a class="forgot-password" href="{{route('password.remind')}}">Забыли пароль?</a></div>

                        <div class="button style-10">Войти<input type="submit" value="" /></div>
                        <div class="clear"></div>

                    </form>
                </div>
            </div>
            <div class="col-sm-6 information-entry">
                <div class="login-box">
                    <div class="article-container style-1">
                        <h3>Новый пользователь</h3>
                        <p>
                            Создавая учетную запись в нашем магазине , вы сможете пройти через процесс оформления заказа быстрее , хранить несколько адресов доставки, просматривать и отслеживать заказы в вашем аккаунте и многое другое.</p>
                    </div>
                    <a href="{{ route('register')}}" class="button style-12">Регистрация аккаунта</a>
                </div>
            </div>
        </div>
    </div>
@endsection