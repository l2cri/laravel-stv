<div class="drop-hover-div header-functionality-entry">

@if($user->id > 0)

    <a class="" href="{{ route('panel::panel.index') }}">
        <span>Кабинет </span><i class="fa fa-user"></i>
    </a>
    <div class="dropped-div cabinet" id="drop-login-form">
        <ul class="dropdown-menu">
            @can('supplier_panel')
                @include('panel.menu.supplier')
            @else
                @include('panel.menu.user')
            @endcan
        </ul>

    </div>

@else

    <a class="" href="#">
        <span>Авторизация </span><i class="fa fa-angle-down"></i>
    </a>
    <div class="dropped-div" id="drop-login-form">
        <form action="{{ route('auth.post') }}" method="POST">

            {!! csrf_field() !!}

            <label>E-mail</label>
            <input type="text" value="{{ old('email') }}" name="email" placeholder="Введите Ваш Email" class="simple-field">
            <label>Пароль</label>
            <input type="password" placeholder="Введите пароль" class="simple-field" name="password" id="password">
            <div class="clear"></div>
            <div class="button style-10">Войти<input type="submit" value=""></div>
            {{--<input class="button style-10" type="submit" value="Войти">--}}
            <div class="clear"></div>
            <a class="forgot-password" href="{{route('password.remind')}}">Забыли пароль?</a>
        </form>
    </div>

@endif

</div>