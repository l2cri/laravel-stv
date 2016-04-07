<?
/**
 * по умолчанию сортировка по возрастанию asc и по цене price
 */

$dir = ( !empty(Input::get('dir')) ) ? Input::get('dir') : Input::session()->get('dir', 'asc');
$order = ( !empty(Input::get('productsorder')) ) ? Input::get('productsorder') : Input::session()->get('productsorder', 'price');
if ( !empty(Input::get('productsorder')) || !empty(Input::get('dir'))) {
    Input::session()->put('dir', Input::get('dir'));
    Input::session()->put('productsorder', Input::get('productsorder'));
}

$currentUrl = isset($currentSection) ? $currentSection->url : URL::current();
?>

<div class="inline-text">Сортировать по</div>
<div class="simple-drop-down">
    <select onchange="setLocation(this.value)">
        <option @if($order == 'price')selected="selected"@endif
                value="{{ url_add_params(array('dir='.$dir, 'productsorder=price'), url($currentUrl)) }}">
            Цене                </option>
        <option @if($order == 'name')selected="selected"@endif
                value="{{ url_add_params(array('dir='.$dir, 'productsorder=name'), url($currentUrl)) }}">
            Названию                </option>
        <option @if($order == 'rating')selected="selected"@endif
                value="{{ url_add_params(array('dir='.$dir, 'productsorder=rating'), url($currentUrl)) }}">
            Рейтингу                </option>
    </select>
</div>
@if($dir == 'asc')
    <a title="По убыванию" href="{{ url_add_params(array('dir=desc', 'productsorder='.$order), url($currentUrl)) }}" class="sort-button">
        &nbsp;
    </a>
@else
    <a title="По возрастанию" href="{{ url_add_params(array('dir=asc', 'productsorder='.$order), url($currentUrl)) }}" class="sort-button active">
        &nbsp;
    </a>
@endif