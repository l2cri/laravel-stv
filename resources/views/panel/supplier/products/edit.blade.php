@extends('panel.index')

@section('panel_content')
    <?
            $sectionIds = getColumnArray($product->sections);
    ?>
    <div class="information-blocks">
        <h3 class="block-title main-heading">Редактировать товар</h3>

        <form method="post" action="{{ route('panel::products.update') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="supplier_id" value="{{ $product->supplier_id }}">

            <div class="row">
                <div class="col-sm-7">

                    @if($product->action)
                        Акция: <span class="inline-label red">
                                    <a href="{{ route('panel::actions.removeProduct', [$product->action->id, $product->id]) }}" title="Удалить"> <i class="fa fa-remove"></i> </a> {{ $product->action->name  }}  </span>
                        <br>
                        <br>
                        <br>
                    @else
                        @if( !empty($actions) )

                            <label>Участвует в акции:</label>
                            <select name="action_id" class="simple-field">
                                    <option selected></option>
                                @foreach( $actions as $action )
                                    <option value={{ $action->id }}>
                                        {{ $action->name }}
                                    </option>
                                @endforeach

                            </select>

                        @endif
                    @endif

                    <div class="clear"></div>

                    <label class="checkbox-entry">
                        <input type="checkbox" checked name="active" value="{{ $product->active }}"> <span class="check"></span> Активный
                    </label>
                    <div class="clear"></div>

                    <label>Название <span>*</span></label>
                    <input type="text" required=""
                           class="simple-field"
                           name="name"
                           value="{{ $product->name }}">
                    <div class="clear"></div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Артикул</label>
                            <input type="text" value="{{ $product->articul }}"
                                   class="simple-field"
                                   name="articul">
                        </div>
                        <div class="col-md-6">
                            <label>Штрихкод</label>
                            <input type="text" value="{{ $product->barcode }}"
                                   class="simple-field"
                                   name="barcode">
                        </div>
                    </div>
                    <div class="clear"></div>

                </div>
                <div class="col-sm-5">
                    <label>Категория <span>*</span></label>
                    <div class="simple-drop-down simple-field multiple-drop-down">
                        <select name="section_ids[]" multiple>
                            @foreach($sectionTree as $section)
                                <?
                                    $selected = in_array($section->id, $sectionIds) ? " selected" : "";
                                ?>
                                <option value={{ $section->id }}{{ $selected }}>
                                    {{ treeSymbol($section->depth*2, '&nbsp;') }}{{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-12 padding-top-30">

                    <div class="row padding-bottom-30">
                        <div class="col-md-4">
                            <label>Длина</label>
                            <div class="input-group">
                                <span class="input-group-addon">мм</span>
                                <input class="form-control simple-field" type="text" name="length"
                                       value="{{ $product->length }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Ширина</label>
                            <div class="input-group">
                                <span class="input-group-addon">мм</span>
                                <input class="form-control simple-field" type="text" name="width"
                                       value="{{ $product->width }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Высота</label>
                            <div class="input-group">
                                <span class="input-group-addon">мм</span>
                                <input class="form-control simple-field" type="text" name="height"
                                       value="{{ $product->height }}">
                            </div>
                        </div>
                    </div>

                    <div class="row padding-bottom-30">
                        <div class="col-md-4">
                            <label>Единицы измерения</label>
                            <input type="text" value="{{ $product->unit }}"
                                   class="simple-field"
                                   name="unit">
                        </div>
                        <div class="col-md-4">
                            <label>Вес</label>
                            <div class="input-group">
                                <span class="input-group-addon">грамм</span>
                                <input class="form-control simple-field" type="text" name="weight"
                                       value="{{ $product->weight }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Объем</label>
                            <div class="input-group">
                                <span class="input-group-addon">мл</span>
                                <input class="form-control simple-field" type="text" name="volume"
                                       value="{{ $product->volume }}">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <label>Цена <span>*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                                <input class="form-control simple-field" type="text" name="price" required
                                       value="{{ $product->price }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Оптовая цена <span>*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                                <input class="form-control simple-field" type="text" name="whosale_price" required
                                       value="{{ $product->whosale_price }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Кол-во единиц товара для оптовой цены</label>
                            <input type="text" value="{{ $product->whosale_quantity }}"
                                   class="simple-field"
                                   name="whosale_quantity">

                            <div class="clear"></div>
                        </div>
                    </div>

                    <label>Краткое описание</label>
                <textarea rows="2" class="simple-field" name="preview" style="height: 70px">{{ $product->preview }}</textarea>
                    <label>Полное описание</label>
                <textarea class="simple-field" name="description">{{ $product->description }}</textarea>

                <label>Фотографии</label>
                @foreach($product->photos as $photo)
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object width-pixel-150" src="{{ url($photo->file) }}">
                            </div>
                            <div class="media-body">

                            </div>
                            <div class="media-right">
                                <a href="{{ route('panel::products.deleteimg', $photo->id) }}" class="fa fa-times"></a>
                            </div>
                        </div>
                @endforeach

                <label>Добавить фотографии</label>
                <input type='file' name="photos[]" class="simple-field">

                <div class="button style-10">Сохранить<input type="submit" value=""></div>
                </div>
            </div>
        </form>

        <script>
            jQuery(function($) {
                $('form').delegate('input[type=file]', 'change', function() {
                    $( "input[type=file]" ).last().after('<input type="file" name="photos[]" class="simple-field">');
                });
            });
        </script>

    </div>

@endsection