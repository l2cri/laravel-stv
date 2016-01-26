@if ($currentSection->parent instanceof \App\Models\Section)
    <div class="catalog-parent-section">
        <a href="{{ url($currentSection->parent->url) }}"> {{$currentSection->parent->name}} </a>
        <i class="fa fa-level-up"></i>
    </div>
@endif

<div class="block-title size-3 active">{{ $currentSection->name }}</div>

<div class="accordeon">

    <? $opened = false;
    $previosDepth = 0;
    ?>
    @foreach($sections as $section)

        <?
            $section->depth = (int) ($section->depth - $currentSection->depth);
        ?>

        {{--первый уровень и есть потомки--}}
        @if( ($section->depth == 1) && ($previosDepth <= 1) )

            @if (count($section->children) > 0 && !$opened)
                <? $opened = true; ?>
                <div class="accordeon-title">{{ $section->name }}</div>
                <div class="accordeon-entry">
                    <div class="article-container style-1">
                        <ul>
                            @else
                                <a href="{{ url($section->url) }}"
                                   class="nonaccordeon-title"

                                        >{{ $section->name }}</a>
                            @endif
                            @endif

                            {{--первый уроверь и предыдущая первый уровень, плюс открыто -  то есть закрываем--}}
                            @if( ($section->depth == 1) && ($previosDepth == 2) && $opened )
                                <?$opened = false;?>
                        </ul>
                    </div>
                </div>
            @endif

            @if ($section->depth == 2)
                <li><a href="{{ url($section->url) }}">{{ $section->name }}</a></li>
            @endif

            {{--закрываем, если это последняя категория уровня 2--}}
            @if ( ($section === $sections->last()) && $opened)
                        </ul>
                    </div>
                </div>
            @endif

            <? // избегаем нулевых больших категорий
            $previosDepth = (int) ($section->depth > 0) ? $section->depth : $previosDepth;?>
            @endforeach

</div>