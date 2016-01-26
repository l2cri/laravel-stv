<?
/**
 * по умолчанию сортировка по возрастанию asc и по цене price
 */

$dir = ( !empty(Input::get('dir')) ) ? Input::get('dir') : Input::session()->get('dir', 'asc');
$order = ( !empty(Input::get('order')) ) ? Input::get('order') : Input::session()->get('order', 'price');
if ( !empty(Input::get('order')) || !empty(Input::get('dir'))) {
    Input::session()->put('dir', Input::get('dir'));
    Input::session()->put('order', Input::get('order'));
}
?>

{{--<div class="sort-by ">--}}
    {{--<p class="pull-left mt-toolbar-label hidden-md hidden-sm"><label>сортировать по</label></p>--}}
    {{--<select class="mt-sort mt_sort_by" onchange="setLocation(this.value)" style="display: none;">--}}
        {{--<option @if($order == 'price')selected="selected"@endif value="{{ url_set_params(array('dir='.$dir, 'order=price')) }}">--}}
            {{--Цене                </option>--}}
        {{--<option @if($order == 'name')selected="selected"@endif value="{{ url_set_params(array('dir='.$dir, 'order=name')) }}">--}}
            {{--Названию                </option>--}}
    {{--</select>--}}

    {{--<p class="mt-sort-arrows pull-left">--}}
        {{--@if($dir == 'asc')--}}
            {{--<a title="По убыванию" href="{{ url_set_params(array('dir=desc', 'order='.$order)) }}" class="set">--}}
                {{--&nbsp;<img class="v-middle" alt="По убыванию" src="{{ asset('assets/i_asc_arrow.gif') }}">&nbsp;--}}
            {{--</a>--}}
        {{--@else--}}
            {{--<a title="По возрастанию" href="{{ url_set_params(array('dir=asc', 'order='.$order)) }}" class="set">--}}
                {{--&nbsp;<img class="v-middle" alt="По убыванию" src="{{ asset('assets/i_desc_arrow.gif') }}">&nbsp;--}}
            {{--</a>--}}
        {{--@endif--}}
    {{--</p>--}}
{{--</div>--}}

<div class="inline-text">Сортировать по</div>
<div class="simple-drop-down">
    <select onchange="setLocation(this.value)">
        <option @if($order == 'price')selected="selected"@endif value="{{ url_add_params(array('dir='.$dir, 'order=price')) }}">
            Цене                </option>
        <option @if($order == 'name')selected="selected"@endif value="{{ url_add_params(array('dir='.$dir, 'order=name')) }}">
            Названию                </option>
        <option @if($order == 'rating')selected="selected"@endif value="{{ url_add_params(array('dir='.$dir, 'order=rating')) }}">
            Рейтингу                </option>
    </select>
</div>
@if($dir == 'asc')
    <a title="По убыванию" href="{{ url_add_params(array('dir=desc', 'order='.$order)) }}" class="sort-button">
        &nbsp;
    </a>
@else
    <a title="По возрастанию" href="{{ url_add_params(array('dir=asc', 'order='.$order)) }}" class="sort-button active">
        &nbsp;
    </a>
@endif