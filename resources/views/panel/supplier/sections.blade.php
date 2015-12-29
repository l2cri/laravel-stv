@extends('panel.index')

@section('panel_content')

    <div class="table-responsive">

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

вывести добавленные категории

вывести категории, где есть товар этого поставщика
@endsection