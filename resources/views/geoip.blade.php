<div id="geo-popup" class="overlay-popup">
    <div class="overflow">
        <div class="table-view">
            <div class="cell-view">
                <div class="close-layer"></div>
                <div class="popup-container">
                    <div class="newsletter-title">Выбрать местополжение</div>

                    <div class="styled-form">

                        <form>
                            <input id="locationsTypehead" class="simple-field typeahead" type="text" value="" placeholder="Город или населенный пункт">
                        </form>
                    </div>

                    <div class="close-popup"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .twitter-typeahead{ width: 100%}
        #filterForm .geoip {margin-bottom: 20px}
        #filterForm .geoip a {display: block; margin-top: 3px}
    </style>

    @include('geojs')

</div>