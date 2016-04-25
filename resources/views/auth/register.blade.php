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
                        <h3>Новый пользователь</h3>
                        <p>
                            Создавая учетную запись в нашем магазине , вы сможете пройти через процесс оформления заказа быстрее , хранить несколько адресов доставки, просматривать и отслеживать заказы в вашем аккаунте и многое другое</p>
                    </div>
                    <form method="POST" action="{{ route('register')}}">
                        {!! csrf_field() !!}
                        <label>Имя</label>
                        <input class="simple-field" name="name" value="{{ old('name') }}" placeholder="Введите ваше имя и фамилию" />
                        <label>Email адрес</label>
                        <input class="simple-field" type="email" name="email" value="{{ old('email') }}" placeholder="Введите ваш Email адрес" />
                        <label>Пароль</label>
                        <input class="simple-field" type="password" name="password" id="password" placeholder="Введите пароль" value="" />
                        <label>Повторить пароль</label>
                        <input class="simple-field" type="password" name="password_confirmation" placeholder="Повторите пароль" value="" />
                        <div class="button style-10">Регистрация<input type="submit" value="" /></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection