<form id="filterForm" method="post">

    {{ csrf_field() }}

    <input type="hidden" value="{{ $currentSection->id }}" name="sectionId">

    <div class="information-blocks">
    <div class="block-title size-2">По цене</div>
    <div class="range-wrapper">
        <div id="prices-range"></div>
        <div class="range-price">
            Цена:
            <div class="min-price"><b><span>0</span> <i class="fa fa-rub"></i></b></div>
            <b>-</b>
            <div class="max-price"><b><span>200</span> <i class="fa fa-rub"></i></b></div>
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