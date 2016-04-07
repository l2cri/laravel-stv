
<input id="rating-{{$item->id}}" value="{{$item->rating}}" class="rating-loading for-rating" data-size="box" data-step="1">
<script type="text/javascript">
    $(document).on('ready', function(){

        var parameters = {
            starCaptions: {1: 'Очень плохо', 2: 'Плохо', 3: 'Ok', 4: 'Хорошо', 5: 'Очень хорошо'},
            starCaptionClasses: {1: 'text-danger', 2: 'text-warning', 3: 'text-info', 4: 'text-primary', 5: 'text-success'},
            showClear : false,
            @if(!Auth::check()) displayOnly: true, @endif
            clearCaption : ''
        };

        $("#rating-{{$item->id}}").rating(parameters).on("rating.change", function(event, value, caption) {

            submitFormByAjax('{{ route($routeName,['id'=>$item->id])}}',{'rate':value}).done(function(data) {
                obj =  $.parseJSON(data);

                if(obj.status == 'OK'){
                    $("#rating-{{$item->id}}").rating("update", obj.rating);
                }

            })
            .fail(function(jqXHR) {
                console.log(jqXHR.responseText);
            });
        });
    });
</script>