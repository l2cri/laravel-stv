<?
$limit = getPerPage();
$currentUrl = isset($currentSection) ? $currentSection->url : URL::current();
?>

<div class="inline-text">На странице</div>
<div class="simple-drop-down" style="width: 75px;">
    <select onchange="setLocation(this.value)">
        <option @if($limit == 12)selected="selected"@endif
        value="{{ url_set_params(array('limit=12'), url($currentUrl)) }}">
            12					</option>
        <option @if($limit == 24)selected="selected"@endif
        value="{{ url_set_params(array('limit=24'), url($currentUrl)) }}">
            24					</option>
        <option @if($limit == 48)selected="selected"@endif
        value="{{ url_set_params(array('limit=48'), url($currentUrl)) }}">
            48					</option>
    </select>
</div>