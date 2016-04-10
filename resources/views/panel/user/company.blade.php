@extends('panel.index')

@section('panel_content')
    <div class="information-blocks">
        <h3 class="block-title main-heading">Настройки корпоративного профиля</h3>

        <form method="post" action="{{ route('panel::company.save') }}" >
            {{ csrf_field() }}

            <input type="hidden" name="companyId" value="{{ $company->id }}">

            <div class="row">
                <div class="col-sm-12">

                    <label>Название <span>*</span></label>
                    <input type="text" required=""
                           class="simple-field"
                           name="name"
                           value="{{ $company->name }}">
                    <div class="clear"></div>

                    <label>ОГРН</label>
                    <input type="text"
                           class="simple-field"
                           name="ogrn"
                           value="{{ $company->ogrn }}">
                    <div class="clear"></div>

                    <label>ИНН </label>
                    <input type="text"
                           class="simple-field"
                           name="inn"
                           value="{{ $company->inn }}">
                    <div class="clear"></div>

                    <label>КПП </label>
                    <input type="text"
                           class="simple-field"
                           name="kpp"
                           value="{{ $company->kpp }}">
                    <div class="clear"></div>

                    <label>Расчетный счет </label>
                    <input type="text"
                           class="simple-field"
                           name="rs"
                           value="{{ $company->rs }}">
                    <div class="clear"></div>

                    <label>Корреспондентский счет </label>
                    <input type="text"
                           class="simple-field"
                           name="ks"
                           value="{{ $company->ks }}">
                    <div class="clear"></div>

                    <label>Генеральный директор </label>
                    <input type="text"
                           class="simple-field"
                           name="ceo"
                           value="{{ $company->ceo }}">
                    <div class="clear"></div>

                    <label>Телефон </label>
                    <input type="text"
                           class="simple-field"
                           name="phone"
                           value="{{ $company->phone }}">
                    <div class="clear"></div>

                    <label>E-mail </label>
                    <input type="text"
                           class="simple-field"
                           name="email"
                           value="{{ $company->email }}">
                    <div class="clear"></div>

                    <label>Юридический адрес</label>
                    <textarea rows="2" class="simple-field" name="law_address" style="height: 70px">{{ $company->law_address }}</textarea>
                    <div class="clear"></div>

                    <label>Фактический адрес</label>
                    <textarea rows="2" class="simple-field" name="fact_address" style="height: 70px">{{ $company->fact_address }}</textarea>
                    <div class="clear"></div>

                    <br>
                    <div class="button style-10">Сохранить<input type="submit" value=""></div>

                </div>
            </div>
        </form>
    </div>

@endsection