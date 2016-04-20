<?
/**
 * по умолчанию сортировка по возрастанию asc и по цене price
 */

if (!isset($prefix)) $prefix = "";

$dir = ( !empty(Input::get('dir')) ) ? Input::get('dir') : Input::session()->get('dir', 'asc');
$order = ( !empty(Input::get( $prefix.'order')) ) ? Input::get($prefix.'order') : Input::session()->get( $prefix.'order', 'price');
if ( !empty(Input::get( $prefix.'order')) || !empty(Input::get('dir'))) {
    Input::session()->put('dir', Input::get('dir'));
    Input::session()->put($prefix.'order', Input::get($prefix.'order'));
}

$currentUrl = isset($currentSection) ? $currentSection->url : URL::current();

$queryStr =(isset($query))?'q='.$query:false;
?>

<div class="inline-text">Сортировать по</div>
<div class="simple-drop-down">
    <select onchange="setLocation(this.value)">
        <option @if($order == 'price')selected="selected"@endif
                value="{{ url_add_params(array('dir='.$dir, $prefix.'order=price',$queryStr), url($currentUrl)) }}">
            Цене                </option>
        <option @if($order == 'name')selected="selected"@endif
                value="{{ url_add_params(array('dir='.$dir, $prefix.'order=name',$queryStr), url($currentUrl)) }}">
            Названию                </option>
        <option @if($order == 'rating')selected="selected"@endif
                value="{{ url_add_params(array('dir='.$dir, $prefix.'order=rating',$queryStr), url($currentUrl)) }}">
            Рейтингу                </option>
    </select>
</div>
@if($dir == 'asc')
    <a title="По убыванию" href="{{ url_add_params(array('dir=desc', $prefix.'order='.$order,$queryStr), url($currentUrl)) }}" class="sort-button">
        &nbsp;
    </a>
@else
    <a title="По возрастанию" href="{{ url_add_params(array('dir=asc', $prefix.'order='.$order,$queryStr), url($currentUrl)) }}" class="sort-button active">
        &nbsp;
    </a>
@endif