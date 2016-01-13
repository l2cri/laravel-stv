@extends('panel.index')

@section('panel_content')

    <div class="table-responsive information-blocks sections-panel">

        <form action="/panel/supplier/sections/add" method="post">
            {{ csrf_field() }}
            <table class="cart-table">

            <tr>
                <td>
                        <label>Название<span>*</span></label>
                        <input name="name" class="simple-field" type="text" placeholder="Введите название новой категории" required value="" />
                </td>
                <td>
                    <label>Родительская</label>
                    <select class="simple-field" name="parent_id">
                        <option value=0>&nbsp;</option>
                        @foreach($sectionTree as $section)
                            <option value={{ $section->id }}>
                                {{ treeSymbol($section->depth*2, '&nbsp;') }}{{ $section->name }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <br>
                    <div class="button style-2">Добавить<input type="submit" value="" /></div>
                </td>
            </tr>

        </table>
        </form>
    </div>

    <div class="row information-blocks sections-panel">
        <div class="col-md-12">
            <h3 class="block-title">Мои категории (добавленные мной)</h3>

            @foreach ($addedSections as $section)
                <div class="row padding-bottom-10">
                    <div class="col-md-6"><a href="{{ url($section->url) }}">
                            {{ treeSymbol($section->depth*2, '&nbsp;') }}{{$section->name}}
                        </a></div>
                    <div class="col-md-6">
                        @if (!$section->moderated)
                            <a href="{{ route('panel::sections.delete', [$section->id]) }}"><i class="fa fa-times"></i></a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row information-blocks sections-panel">
        <div class="col-md-12">
            <h3 class="block-title">Мой магазин</h3>
            <div class="row">
                <div class="col-md-12">
                    вывести категории, где есть товар этого поставщика
                </div>
            </div>
        </div>
    </div>

@endsection