@if( isset($profile) && !empty($profile) )

    <input type="hidden" name="profile_id" value="{{ $profile->id }}" id="profileIdForType">

    <? $selectedProfileId = $profile->id; ?>
    @if (isset($profiles) && (count($profiles) > 0))
        <label>Выбрать другой профиль</label>
        <select name = "chooseProfile" class="simple-field" id="chooseProfile">
            @foreach($profiles as $prof)
                <option value="{{ $prof->id }}" @if( $selectedProfileId == $prof->id) selected @endif>
                    {{ $prof->name }} </option>
            @endforeach
        </select>
    @endif

    <label>Имя <span>*</span></label>
    <input type="text" value="{{ $profile->person }}" required class="simple-field" name="person" autocomplete=off>
    <label>Телефон <span>*</span></label>
    <input type="text" value="{{ $profile->phone }}" required class="simple-field" name="phone" autocomplete=off>

    <label>Город или населенный пункт <span>*</span></label>
    <input id="locationsTypeheadClassHidden" name="location_id" value="{{ @$profile->location->id }}" type="hidden">
    <input id="locationsTypeheadProfile" class="simple-field typeahead" type="text"
           value="{{ @$profile->location->name }} {{ @$profile->location->shortname }}"
           placeholder="Город или населенный пункт" autocomplete="off">
    <div class="clear"></div>

    <label>Адрес <span>*</span></label>
    <textarea name="address" required="" placeholder="Адрес как можно подробнее" class="simple-field" autocomplete=off>{{ $profile->address }}</textarea>
@else
    <label>Имя <span>*</span></label>
    <input type="text" value="{{ $user->name }}" required class="simple-field" name="person">
    <label>Телефон <span>*</span></label>
    <input type="text" value="" required placeholder="Телефон для связи" class="simple-field" name="phone">

    <label>Город или населенный пункт <span>*</span></label>
    <input id="locationsTypeheadClassHidden" name="location_id" value="{{ $currentLocation->id }}" type="hidden">
    <input id="locationsTypehead" class="simple-field typeahead" type="text"
           value="{{ $currentLocation->name }} {{ $currentLocation->shortname }}"
           placeholder="Город или населенный пункт">
    <div class="clear"></div>

    <label>Адрес <span>*</span></label>
    <textarea required="" name="address" placeholder="Адрес как можно подробнее" class="simple-field"></textarea>
@endif

<script>

    $('#chooseProfile').on('change', function () {

        var profileId = $(this).val();
        var url = '{{ route('order.checkout') }}' + '?profileId=' + profileId;
        window.location = url; //
        return false;
    });

</script>