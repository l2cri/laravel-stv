@extends('panel.index')

@section('headscripts')

    @parent

    <link href="https://cdn.jsdelivr.net/jquery.suggestions/16.5.3/css/suggestions.css" type="text/css" rel="stylesheet" />
    <!--[if lt IE 10]>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.suggestions/16.5.3/js/jquery.suggestions.min.js"></script>


@endsection

@section('breadcrumbs', Breadcrumbs::render('common.panel-sub','Реквизиты'))
@section('panel_content')
    <div class="information-blocks">
        <h3 class="block-title main-heading">Настройки корпоративного профиля</h3>

        <form method="post" action="{{ route('panel::company.save') }}" enctype="multipart/form-data" >
            {{ csrf_field() }}

            <input type="hidden" name="companyId" value="{{ $company->id }}">

            <div class="row">
                <div class="col-sm-12">

                    <label class="checkbox-entry">
                        <input type="checkbox" {{ $company->nds ? 'checked' : '' }}
                        name="nds"> <span class="check"></span> НДС
                    </label>
                    <div class="clear"></div>

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

                    <label>Банк </label>
                    <input type="text"
                           class="simple-field"
                           name="bank"
                           value="{{ $company->bank }}">
                    <div class="clear"></div>

                    <label>БИК </label>
                    <input type="text"
                           class="simple-field"
                           name="bik"
                           value="{{ $company->bik }}">
                    <div class="clear"></div>

                    <label>Корреспондентский счет </label>
                    <input type="text"
                           class="simple-field"
                           name="ks"
                           value="{{ $company->ks }}">
                    <div class="clear"></div>

                    <label>Расчетный счет </label>
                    <input type="text"
                           class="simple-field"
                           name="rs"
                           value="{{ $company->rs }}">
                    <div class="clear"></div>

                    <label>Сколько дней действителен счет</label>
                    <input type="text"
                           class="simple-field"
                           name="invoice_days"
                           value="{{ $company->invoice_days }}">
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

                    <label>Печать и подпись</label>
                    <input type='file' name="stamp" class="simple-field">
                    @if(!empty($company->stamp)) <img src="{{ url($company->stamp) }}" class="img-responsive"> @endif
                    <div class="clear"></div>

                    {{--<label>Подпись генерального директора</label>--}}
                    {{--<input type='file' name="signature_seo" class="simple-field">--}}
                    {{--@if(!empty($supplier->signature_seo)) <img src="{{ url($supplier->signature_seo) }}" class="img-responsive"> @endif--}}
                    {{--<div class="clear"></div>--}}

                    {{--<label>Подпись главного бухгалтера</label>--}}
                    {{--<input type='file' name="signature_buh" class="simple-field">--}}
                    {{--@if(!empty($supplier->signature_buh)) <img src="{{ url($supplier->signature_buh) }}" class="img-responsive"> @endif--}}
                    {{--<div class="clear"></div>--}}

                    <br>
                    <div class="button style-10">Сохранить<input type="submit" value=""></div>

                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $("input[name='name']").suggestions({
            serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
            token: "f669934ea60094ba7614da553bb69070b8019558",
            type: "PARTY",
            count: 5,
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            onSelect: function(suggestion) {

                $("input[name='ogrn']").val(suggestion.data.ogrn);
                $("input[name='inn']").val(suggestion.data.inn);
                $("input[name='kpp']").val(suggestion.data.kpp);
                $("input[name='ceo']").val(suggestion.data.management.name);
                $("textarea[name='law_address']").val(suggestion.data.address.value);
                $("textarea[name='fact_address']").val(suggestion.data.address.value);
            }
        });

        $("input[name='bank']").suggestions({
            serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
            token: "f669934ea60094ba7614da553bb69070b8019558",
            type: "BANK",
            count: 5,
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            onSelect: function(suggestion) {
                console.log(suggestion);
                $("input[name='bik']").val(suggestion.data.bic);
                $("input[name='ks']").val(suggestion.data.correspondent_account);
            }
        });
    </script>
@endsection