
<div class="accordeon">

    <?
        $opened = false;
        $previosDepth = 0;
        $curentSectionId = isset( $currentSection ) ? $currentSection->id : null;
    ?>
    @foreach($sections as $section)

        <?
      // $section->depth = (int) ($section->depth - $currentSection->depth);
                $sectionUrl = route('supplier', [$supplier->code, $section->code]);
        ?>

        {{--первый уровень и есть потомки--}}
        @if( ($section->depth == 1) && ($previosDepth <= 1) )

            @if (count($section->children) > 0 && !$opened)
                <? $opened = true; ?>
                <div class="accordeon-title">{{ $section->name }} ({{ count( ProductRepo::bySectionWithSupplier($section->id, $supplier->id, false)) }})</div>
                <div class="accordeon-entry">
                    <div class="article-container style-1">
                        <ul>
                            @else
                                <a href="{{ url($sectionUrl) }}" class="nonaccordeon-title">
                                    {{ $section->name }} ({{ count( ProductRepo::bySectionWithSupplier($section->id, $supplier->id, false)) }})
                                </a>
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
                <li><a href="{{ url($sectionUrl) }}">{{ $section->name }} ({{ count( ProductRepo::bySectionWithSupplier($section->id, $supplier->id, false)) }})</a></li>
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