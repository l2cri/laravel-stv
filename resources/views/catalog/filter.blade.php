<form id="filterForm" method="post">

    {{ csrf_field() }}

    <input type="hidden" value="{{ $currentSection->id }}" name="sectionId">
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

    <div class="information-blocks">
    <div class="block-title size-2">По производителю</div>
    <div class="row">
        <div class="col-xs-6">
            <label class="checkbox-entry">
                <input type="checkbox" /> <span class="check"></span> Армани
            </label>
            <label class="checkbox-entry">
                <input type="checkbox" /> <span class="check"></span> ДольчеГабанна
            </label>
            <label class="checkbox-entry">
                <input type="checkbox" /> <span class="check"></span> Дядя Ваня
            </label>
            <label class="checkbox-entry">
                <input type="checkbox" /> <span class="check"></span> Юнилевер
            </label>
        </div>
        <div class="col-xs-6">
            <label class="checkbox-entry">
                <input type="checkbox" /> <span class="check"></span> Армани
            </label>
            <label class="checkbox-entry">
                <input type="checkbox" /> <span class="check"></span> Дольче Габанна
            </label>
            <label class="checkbox-entry">
                <input type="checkbox" /> <span class="check"></span> Дядя Ваня
            </label>
            <label class="checkbox-entry">
                <input type="checkbox" /> <span class="check"></span> Юнилевер
            </label>
        </div>
    </div>
</div>
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
            url: '/catalog/ajax',
            data: $( "#filterForm" ).serialize(),
            dataType: 'html'
        });
    }

    $(function() {

        var filterButton = $("#submitFilterForm");

        filterButton.on("click", function() {

            submitFilterForm().done(function(data) {
                $("#catalogProducts").html(data);
            });
        });
    });

</script>