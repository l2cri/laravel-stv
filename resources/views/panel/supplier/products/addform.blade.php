@extends('panel.index')

@section('panel_content')

<div class="information-blocks">
    <h3 class="block-title main-heading">Добавить товар</h3>

    <form method="post" action="{{ route('panel::products.store') }}">
        <div class="row">
            <div class="col-sm-7">



                <label class="checkbox-entry">
                    <input type="checkbox" checked name="active"> <span class="check"></span> Активный
                </label>
                <div class="clear"></div>

                <label>Название <span>*</span></label>
                <input type="text" value="" required=""
                       class="simple-field"
                       name="name">
                <div class="clear"></div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Артикул</label>
                        <input type="text" value=""
                               class="simple-field"
                               name="articul">
                    </div>
                    <div class="col-md-6">
                        <label>Штрихкод</label>
                        <input type="text" value=""
                               class="simple-field"
                               name="barcode">
                    </div>
                </div>
                <div class="clear"></div>

            </div>
            <div class="col-sm-5">
                <label>Категория <span>*</span></label>
                <div class="simple-drop-down simple-field multiple-drop-down">
                    <select name="section_ids" multiple>
                        @foreach($sectionTree as $section)
                            <option value={{ $section->id }}>
                                {{ treeSymbol($section->depth*2, '&nbsp;') }}{{ $section->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-12 padding-top-30">

                <div class="row">
                    <div class="col-md-4">
                        <label>Цена <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                            <input class="form-control simple-field" type="text" name="price" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Оптовая цена <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                            <input class="form-control simple-field" type="text" name="whosale_price" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Кол-во единиц товара для оптовой цены</label>
                        <input type="text" value=""
                               class="simple-field"
                               name="whosale_quantity">

                        <div class="clear"></div>
                    </div>
                </div>



                <label>Краткое описание <span>*</span></label>
                <textarea rows="2" class="simple-field" name="preview" style="height: 70px"></textarea>
                <label>Полное описание <span>*</span></label>
                <textarea class="simple-field" name="description"></textarea>
                <div class="button style-10">Добавить<input type="submit" value=""></div>
            </div>
        </div>
    </form>

</div>

@endsection