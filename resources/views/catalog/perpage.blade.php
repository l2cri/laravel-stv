{{--<div class="limiter">--}}
    {{--<p class="pull-left mt-toolbar-label mt-slabel-1 hidden-md hidden-sm"><label>Показать</label></p>--}}
    {{--<select class="mt-limit mt_limiter" onchange="setLocation(this.value)" sb="36468048" style="display: none;">--}}
        {{--<option @if($limit == 12)selected="selected"@endif--}}
        {{--value="{{ url_set_params(array('limit=12')) }}">--}}
            {{--12					</option>--}}
        {{--<option @if($limit == 24)selected="selected"@endif--}}
        {{--value="{{ url_set_params(array('limit=24')) }}">--}}
            {{--24					</option>--}}
        {{--<option @if($limit == 48)selected="selected"@endif--}}
        {{--value="{{ url_set_params(array('limit=48')) }}">--}}
            {{--48					</option>--}}
    {{--</select>--}}

    {{--<p class="pull-left mt-toolbar-label mt-slabel-2 hidden-md hidden-sm">на странице</p>--}}
{{--</div>--}}

<?
$limit = getPerPage();
?>

<div class="inline-text">На странице</div>
<div class="simple-drop-down" style="width: 75px;">
    <select onchange="setLocation(this.value)">
        <option @if($limit == 12)selected="selected"@endif
        value="{{ url_set_params(array('limit=12')) }}">
            12					</option>
        <option @if($limit == 24)selected="selected"@endif
        value="{{ url_set_params(array('limit=24')) }}">
            24					</option>
        <option @if($limit == 48)selected="selected"@endif
        value="{{ url_set_params(array('limit=48')) }}">
            48					</option>
    </select>
</div>