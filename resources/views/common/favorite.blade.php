<? $show_all = (!isset($type))? true: false; ?>

@if($show_all || $type == 'icon')
<span id="fav-icon-{{$item->id}}" class="fav-icon">
    @if($check)
        <a href="{{ route($routeName)}}" data-id="{{$item->id}}" data-alt="true" class="bottom-line-a square"><i class="fa fa-heart-o"></i></a>
    @else
        <a href="{{ route($routeName)}}" data-id="{{$item->id}}" data-alt="true" class="bottom-line-a square"><i class="fa fa-heart"></i></a>
    @endif
</span>
@endif

@if($show_all || $type == 'label')
<span id="fav-label-{{$item->id}}" class="fav-label">
    @if($check)
        <a href="{{ route($routeName)}}" data-id="{{$item->id}}" data-alt="false" class="button style-11"><i class="fa fa-heart-o"></i> В избранном</a>
    @else
        <a href="{{ route($routeName)}}" data-id="{{$item->id}}" data-alt="false" class="button style-11"><i class="fa fa-heart"></i> В избранное</a>
    @endif
</span>
@endif