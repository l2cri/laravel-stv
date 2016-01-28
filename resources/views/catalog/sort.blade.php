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

<div class="inline-text">Сортировать по</div>
<div class="simple-drop-down">
    <select onchange="setLocation(this.value)">
        <option @if($order == 'price')selected="selected"@endif
                value="{{ url_add_params(array('dir='.$dir, 'order=price'), url($currentSection->url)) }}">
            Цене                </option>
        <option @if($order == 'name')selected="selected"@endif
                value="{{ url_add_params(array('dir='.$dir, 'order=name'), url($currentSection->url)) }}">
            Названию                </option>
        <option @if($order == 'rating')selected="selected"@endif
                value="{{ url_add_params(array('dir='.$dir, 'order=rating'), url($currentSection->url)) }}">
            Рейтингу                </option>
    </select>
</div>
@if($dir == 'asc')
    <a title="По убыванию" href="{{ url_add_params(array('dir=desc', 'order='.$order), url($currentSection->url)) }}" class="sort-button">
        &nbsp;
    </a>
@else
    <a title="По возрастанию" href="{{ url_add_params(array('dir=asc', 'order='.$order), url($currentSection->url)) }}" class="sort-button active">
        &nbsp;
    </a>
@endif