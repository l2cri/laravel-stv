@extends('panel.index')

@section('headscripts')

    @parent

    <script src="{{ url('js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('js/ckeditor/config.js') }}"></script>
    <script src="{{ url('js/ckeditor/styles.js') }}"></script>

@endsection

@section('panel_content')
    <div class="information-blocks">
        <h3 class="block-title main-heading">Настройки магазина</h3>

        <form method="post" action="{{ route('panel::supplier.settings.update') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-sm-12">

                    <label>Название <span>*</span></label>
                    <input type="text" required=""
                           class="simple-field"
                           name="name"
                           value="{{ $supplier->name }}">
                    <div class="clear"></div>

                    <label>Никнейм <span>*</span></label>
                    <input type="text" required=""
                           class="simple-field"
                           name="code"
                           value="{{ $supplier->code }}">
                    <div class="clear"></div>

                    <label>Цвет </label>
                    <input type="text"
                           class="simple-field"
                           name="color"
                           value="{{ $supplier->color }}">
                    <div class="clear"></div>

                    <label>Сумма для оптового заказ </label>
                    <input type="text"
                           class="simple-field"
                           name="whosale_order"
                           value="{{ $supplier->whosale_order }}">
                    <div class="clear"></div>

                    <label>Кол-во для оптового заказа </label>
                    <input type="text"
                           class="simple-field"
                           name="whosale_quantity"
                           value="{{ $supplier->whosale_quantity }}">
                    <div class="clear"></div>

                    <label>Логотип</label>
                    <input type='file' name="logo" class="simple-field">
                    @if(!empty($supplier->logo)) <img src="{{ url($supplier->logo) }}" class="img-responsive"> @endif
                    <div class="clear"></div>

                    <br>
                    <br>

                    <label>Условия работы</label>
                    <textarea rows="2" class="simple-field" name="conditions" style="height: 70px">{{ $supplier->conditions }}</textarea>
                    <div class="clear"></div>

                    <label>Обмен/Возврат и Гарантии</label>
                    <textarea rows="2" class="simple-field" name="responsibility" style="height: 70px">{{ $supplier->responsibility }}</textarea>
                    <div class="clear"></div>

                    <label>Описание</label>
                    <textarea rows="5" class="simple-field" id="supplier_description" name="description" style="height: 270px">{{ $supplier->description }}</textarea>
                    <div class="clear"></div>

                    <br>
                    <div class="button style-10">Сохранить<input type="submit" value=""></div>

                </div>
            </div>
        </form>
    </div>


    <script>
        CKEDITOR.replace( 'supplier_description', {
            language: 'ru',
            //filebrowserUploadUrl: '/ckupload?_token={{ csrf_token() }}'
        } );
        //если понадобиться загрузка файлов - сделаем, а так будет лого и реквизиты
    </script>
@endsection