<?
    $sectionId = isset($currentSection) ? $currentSection->id : null;
?>

<form id="filterForm" method="post">

    {{ csrf_field() }}
    <input type="hidden" value="{{ $sectionId }}" name="sectionId">

    {{--start serialize div--}}
    <div id="srlz">
        <input type="hidden" name="minprice" id="minPriceHidden" value="0">
        <input type="hidden" name="maxprice" id="maxPriceHidden" value="{{ $maxProductPrice }}">

        <div class="information-blocks">
        <div class="block-title size-2">По цене</div>
        <div class="range-wrapper">
            <div id="prices-range"></div>
            <div class="range-price">
                Цена:
                <div class="min-price"><b><span>0</span> <i class="fa fa-rub"></i></b></div>
                <b>-</b>
                <div class="max-price"><b><span>{{ $maxProductPrice }}</span> <i class="fa fa-rub"></i></b></div>
            </div>
            <a class="button style-14" id="submitFilterForm">Фильтр</a>
        </div>
        </div>

        @if (isset($suppliers) && !empty($suppliers))

            <?
            $evenOdd = array();
            if (count($suppliers) > 1) {
                $evenOdd = evenOddArray($suppliers);
            } else {
                $evenOdd['even'] = $suppliers;
                $evenOdd['odd'] = array();
            }
            ?>

            <div class="information-blocks">
                <div class="block-title size-2">По производителю</div>
                <div class="row">
                    <div class="col-xs-6">

                        @foreach($evenOdd['even'] as $supplier)

                            <label class="checkbox-entry">
                                <input type="checkbox" name="suppliers[]" value="{{ $supplier->id }}" />
                                <span class="check"></span> {{ $supplier->name }}
                            </label>

                        @endforeach

                    </div>
                    <div class="col-xs-6">

                        @foreach($evenOdd['odd'] as $supplier)

                            <label class="checkbox-entry">
                                <input type="checkbox" name="suppliers[]" value="{{ $supplier->id }}" />
                                <span class="check"></span> {{ $supplier->name }}
                            </label>

                        @endforeach

                    </div>
                </div>
            </div>

        @endif

    </div>
    {{--end serialize div--}}
</form>

<!-- range slider -->
<script src="{{ url('js/jquery-ui.min.js') }}"></script>
<script>
    $(document).ready(function(){
        var minVal = parseInt($('.min-price span').text());
        var maxVal = parseInt($('.max-price span').text());
        $( "#prices-range" ).slider({
            range: true,
            min: minVal,
            max: maxVal,
            step: 5,
            values: [ minVal, maxVal ],
            slide: function( event, ui ) {

                // set form hiddens
                $('#minPriceHidden').val(ui.values[ 0 ]);
                $('#maxPriceHidden').val(ui.values[ 1 ]);

                $('.min-price span').text(ui.values[ 0 ]);
                $('.max-price span').text(ui.values[ 1 ]);
            }
        });
    });
</script>

<script>
    function submitFilterForm(){

        return $.ajax({
            type: "POST",
            url: '{{ $filterRoute }}',
            data: $( "#filterForm" ).serialize(),
            dataType: 'html'
        });
    }

    function proceedFilter(){
        submitFilterForm().done(function(data) {
            $("#catalogProducts").html(data);
            addFilterParams();
        });
    }

    function addFilterParams(){
        $('a.addFilterParams').each(function() {
            var data = $( "#filterForm #srlz input" ).serialize();
            var href = this.href;
            if (href.indexOf('?') != -1) {
                href = href + '&' + data;
            }
            else {
                href = href + '?' + data;
            }
            $(this).attr('href', href);
        });
    }

    function setParamsFromLocation(selectors, supplementUrl){
        $(selectors).each(function(){
            var href = this.href;
            if (href.indexOf('?') != -1) {
                href = href + '&' + supplementUrl;
            }
            else {
                href = href + '?' + supplementUrl;
            }
            $(this).attr('href', href);
        });
    }

    $(function() {

        {{--параметры для фильтрации из GET-запроса, формируем в контроллере и передаем в шаблон--}}
        var supplementUrl = "{!! $supplementUrl !!}";
        if (supplementUrl.length > 0) {
            setParamsFromLocation('a.addFilterParams', supplementUrl);
        }

        /*
            кнопка фильтра
         */
        var filterButton = $("#submitFilterForm");
        filterButton.on("click", function() {
            proceedFilter();
        });

        /*
        чекбоксы
         */
        var checkboxes = $('#filterForm input[type=checkbox]');
        checkboxes.on('click', function(){
           proceedFilter();
        });

    });

</script>