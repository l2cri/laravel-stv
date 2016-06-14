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
            minLength: 3

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

        // для изменения локации профиля при оформлении заказа
        $('#locationsTypeheadProfile').typeahead({
            hint: true,
            highlight: true,
            minLength: 3

        }, {
            name: 'locations',
            limit: 10,
            source: locations,
            display: 'path',

        }).on('typeahead:selected',function(evt,data){

            var params = {}
            params.location_id = data.id;
            params.profileId = $('#profileIdForType').val();
            var url = '{{ route('panel::profile.setLocation') }}';

            submitFormByAjax(url, params).done(function(data) {
                location.reload();
            })
                    .fail(function(jqXHR) {
                        $('.error-content').html("Ошибка: "+jqXHR.responseText);
                    });
        });

        // для других полей: профили, может быть еще где-то
        $('#locationsTypeheadClass').typeahead({
            hint: true,
            highlight: true,
            minLength: 3

        }, {
            name: 'locations',
            source: locations,
            display: 'path'

        }).on('typeahead:selected',function(evt,data){

            $('#locationsTypeheadClassHidden').val(data.id);
            $('#locationsTypeheadClass').val(data.name);
        });
    });
</script>