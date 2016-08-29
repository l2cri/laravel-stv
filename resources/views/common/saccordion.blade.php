@if ( isset($currentSection) )
    @if ($currentSection->parent instanceof \App\Models\Section)
        <div class="catalog-parent-section">
            <a href="{{ url( $mainRoute.'/'.$currentSection->parent->code ) }}"> {{$currentSection->parent->name}} </a>
            <i class="fa fa-level-up"></i>
        </div>
    @endif

    <div class="block-title size-3 active">{{ $currentSection->name }}</div>
@endif

<div class="accordeon">

    @foreach($sections as $section)

        @if( ($section->depth == 0))

            <a href="{{ url( $mainRoute.'/'.$section->code ) }}" class="nonaccordeon-title"><b>{{ $section->name }}</b></a>

        @endif

        <?if (isset($currentSection)) {
            $section->depth = (int)($section->depth - $currentSection->depth);
        }?>

        <?
            $children = $sections->filter(function ($item) use ($section) {
                return $item['parent_id'] == $section->id;
            });
        ?>
        @if( ($section->depth == 1) && count($children) > 0 )

            <div class="accordeon-title">{{ $section->name }}</div>
                <div class="accordeon-entry">
                    <div class="article-container style-1">
                        <ul>

                            @foreach($children as $child)
                                <li><a href="{{ url( $mainRoute.'/'.$child->code ) }}">{{ $child->name }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>

        @endif

        @if( ($section->depth == 1) && count($section->children) == 0 )
            <a href="{{ url( $mainRoute.'/'.$section->code ) }}" class="nonaccordeon-title">{{ $section->name }}</a>
        @endif

    @endforeach

</div>