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
                        <option></option>
                        <option>родительская</option>
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

    <div class="row">
        <div class="col-md-12">
            <h3 class="block-title">Мои категории</h3>

            @foreach ($addedSections as $section)
                <div class="row">
                    <div class="col-md-6"><a href="{{ url($section->url) }}">{{$section->name}}</a></div>
                    <div class="col-md-6"><a href="{{ route('panel::sections.delete', [$section->id]) }}"><i class="fa fa-times"></i></a></div>
                </div>
            @endforeach
        </div>
    </div>


вывести категории, где есть товар этого поставщика
@endsection