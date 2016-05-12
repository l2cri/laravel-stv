@extends('panel.index')
@section('breadcrumbs', Breadcrumbs::render('common.panel-sub','Настройки аккаунта'))
@section('panel_content')
    <div class="information-blocks">
        <h3 class="block-title main-heading">Настройки аккаунта</h3>

        <form method="post" action="{{ route('panel::account.update') }}" >
            {{ csrf_field() }}

            <!-- The text and password here are to prevent FF from auto filling my login credentials because it ignores autocomplete="off"-->
            <input type="text" style="display:none">
            <input type="password" style="display:none">

            <div class="row">
                <div class="col-sm-12">

                    <label>ФИО <span>*</span></label>
                    <input type="text" required=""
                           class="simple-field"
                           name="name"
                           value="{{ $user->name }}">
                    <div class="clear"></div>

                    <label>E-mail <span>*</span></label>
                    <input type="text" required=""
                           class="simple-field"
                           name="email"
                           value="{{ $user->email }}">
                    <div class="clear"></div>

                    <label>Пароль</label>
                    <input class="simple-field"
                           type="password"
                           name="password"
                           placeholder="Введите пароль" value="" autocomplete="off" />
                    <div class="clear"></div>

                    <label>Повторить пароль (обязательно, если меняете пароль)</label>
                    <input class="simple-field"
                           type="password"
                           name="password_confirmation"
                           placeholder="Повторите пароль" value="" autocomplete="off" />
                    <div class="clear"></div>

                    <br>
                    <div class="button style-10">Сохранить<input type="submit" value=""></div>

                </div>
            </div>
        </form>
    </div>

@endsection