<div id="fav-inner-{{$item->id}}">
    @if($check)
        <div class="button style-11"><i class="fa fa-heart-o"></i> В избранном</div>
    @else
        <a id="addFav-{{$item->id}}" class="button style-11"><i class="fa fa-heart"></i> В избранное</a>

        <script>
            $('#addFav-{{$item->id}}').click(function(){
                submitFormByAjax('{{ route($routeName)}}',{'id':'{{$item->id}}'}).done(function(data) {
                    try {
                        obj =  $.parseJSON(data);
                    } catch (e) {
                        $('#fav-inner-{{$item->id}}').html(data);
                    }
                })
                return false;
            })
        </script>
    @endif
</div>