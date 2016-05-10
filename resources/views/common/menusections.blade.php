<?
    $promCount = $promSections->count();
    $promHalf = ceil($promCount / 2);

    $potrebCount = $potrebSections->count();
    $potrebHalf = ceil($potrebCount / 2);
?>
<div class="full-width-menu-items-right">
    <div class="submenu-list-title">Промышленные товары</div>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-type-1 toggle-list-container">

                @for($i = 0; $i < $promHalf; $i++)
                    <li><a href="{{ url($promSections[$i]->url) }}"><i class="fa fa-angle-right"></i>{{ $promSections[$i]->name }}</a></li>
                @endfor

            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-type-1 toggle-list-container">

                @for($i = $promHalf; $i < $promCount; $i++)
                    <li><a href="{{ url($promSections[$i]->url) }}"><i class="fa fa-angle-right"></i>{{ $promSections[$i]->name }}</a></li>
                @endfor

            </ul>
        </div>
    </div>
</div>
<div class="full-width-menu-items-left">
    <div class="submenu-list-title">Потребительские товары</div>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-type-1 toggle-list-container">

                @for($i = 0; $i < $potrebHalf; $i++)
                    <li><a href="{{ url($potrebSections[$i]->url) }}"><i class="fa fa-angle-right"></i>{{ $potrebSections[$i]->name }}</a></li>
                @endfor

            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-type-1 toggle-list-container">

                @for($i = $potrebHalf; $i < $potrebCount; $i++)
                    <li><a href="{{ url($potrebSections[$i]->url) }}"><i class="fa fa-angle-right"></i>{{ $potrebSections[$i]->name }}</a></li>
                @endfor

            </ul>
        </div>
    </div>
</div>

<div class="submenu-links-line">
    <div class="submenu-links-line-container">
        <div class="cell-view">
            {{--<div class="line-links"><b>Популярное:</b>  <a href="#">Курица</a>, <a href="#">Подшипники</a>, <a href="#">Туфли</a>, <a href="#">Шины</a>, <a href="#">Распродажа</a>, <a href="#">Яйца</a></div>--}}
        </div>
        <div class="cell-view">
            {{--<div class="red-message"><b>-20% только на этой неделе. Спешите купить выгодно!</b></div>--}}
        </div>
    </div>
</div>