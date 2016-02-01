<?php
// config
$link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
$from = 0;
$to = 0;

$paginator->setPath($currentSection->url);
?>

@if ($paginator->lastPage() > 1)

        @if($paginator->currentPage() !== 1)
            <a class="addFilterParams square-button" href="{{ $paginator->url(1) }}"><i class="fa fa-angle-left"></i></a>
        @endif

        <? $dividerFrom = false; ?>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
                $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>

            @if($from > 0 && !$dividerFrom)
                <?$dividerFrom = true;?>
                <div class="divider">...</div>
            @endif

            @if ($from < $i && $i < $to)
                <a class="addFilterParams square-button {{ ($paginator->currentPage() == $i) ? ' active' : '' }}"
                       href="{{ $paginator->url($i) }}">{{ $i }}</a>
            @endif
        @endfor

        @if ($to <= $paginator->lastPage())
            <div class="divider">...</div>
        @endif

        @if ($paginator->currentPage() !== $paginator->lastPage())

            <a class="addFilterParams square-button" href="{{ $paginator->url($paginator->lastPage()) }}">
                <i class="fa fa-angle-right"></i>
            </a>

        @endif
@endif