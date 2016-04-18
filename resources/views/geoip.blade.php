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
        .styled-form .twitter-typeahead{ width: 100%}
        #filterForm .geoip {margin-bottom: 20px}
        #filterForm .geoip a {display: block; margin-top: 3px}
    </style>

    <script>
        $(function() {

            "use strict";

            /**
             * autocomplete locations search with callback form submit
             */
            var locations = new Bloodhound({
                datumTokenizer: function (datum) {
                    return Bloodhound.tokenizers.whitespace(datum.name);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                // url points to a json file that contains an array of country names, see
                // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
                remote: {
                    url: '{{ route('locationQuery', '%QUERY') }}',
                    wildcard: '%QUERY',

                }
            });

            //locations.initialize();

            $('#locationsTypehead').typeahead({
                hint: true,
                highlight: true,
                minLength: 1

            }, {
                name: 'locations',
                source: locations,
                display: 'path'

            }).on('typeahead:selected',function(evt,data){

                var params = {}
                params.locationId = data.id;
                var url = '{{ route('setLocation') }}';

                submitFormByAjax(url, params).done(function(data) {
                    location.reload();
                })
                        .fail(function(jqXHR) {
                            $('.error-content').html("Ошибка: "+jqXHR.responseText);
                        });
            });
        });
    </script>

</div>