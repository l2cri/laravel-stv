<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Редактировать профиль</h4>
</div>
<div class="modal-body">

    <form action="{{ route('panel::profile.add') }}" method="post" id="form_update">
        {{ csrf_field() }}

        <input type="hidden" name="profileId" value="{{ $profile->id }}">

        <div class="row">
            <div class="col-md-12">

                <label class="checkbox-entry">
                    <input type="checkbox" {{ $profile->main ? 'checked' : '' }}
                    name="main"> <span class="check"></span> По-умолчанию
                </label>
                <div class="clear"></div>

                <label>Название <span>*</span></label>
                <input type="text" required=""
                       class="simple-field"
                       name="name"
                        value="{{ $profile->name }}">
                <div class="clear"></div>

                <label>Имя контактного лица <span>*</span></label>
                <input type="text" required=""
                       class="simple-field"
                       name="person"
                        value="{{ $profile->person }}">
                <div class="clear"></div>

                <label>Телефон <span>*</span></label>
                <input type="text" required=""
                       class="simple-field"
                       name="phone"
                        value="{{ $profile->phone }}">
                <div class="clear"></div>

                <label>Город или населенный пункт <span>*</span></label>
                <input id="locationsTypeheadClassHidden" name="location_id" value="{{ @$profile->location->id }}" type="hidden">
                <input id="locationsTypeheadClass" class="simple-field typeahead" type="text"
                       value="{{ @$profile->location->name }} {{ @$profile->location->shortname }}"
                       placeholder="Город или населенный пункт">
                <div class="clear"></div>

                <label>Адрес</label>
                <textarea rows="2" class="simple-field" name="address" style="height: 70px">{{ $profile->address }}</textarea>


            </div>
        </div>

    </form>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
    <button type="button" class="btn btn-primary" id="submit_update">Сохранить</button>
</div>

@include('geojs')