<div class="accordeon">

    <? $opened = false;
    $previosDepth = 0;
    ?>
    @foreach($sections as $section)

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
                                   class="nonaccordeon-title @if ($currentSection->id == $section->id) active @endif "

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
                <li><a @if ($currentSection->id == $section->id)class="active"@endif
                            href="{{ url($section->url) }}">{{ $section->name }}</a></li>
            @endif


            <? // избегаем нулевых больших категорий
            $previosDepth = (int) ($section->depth > 0) ? $section->depth : $previosDepth;?>
            @endforeach

</div>