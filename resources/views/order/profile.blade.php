@if( isset($profile) && !empty($profile) )

    <input type="hidden" name="profile_id" value="{{ $profile->id }}">

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
    <label>Адрес <span>*</span></label>
    <textarea name="address" required="" placeholder="Адрес как можно подробнее" class="simple-field" autocomplete=off>{{ $profile->address }}</textarea>
@else
    <label>Имя <span>*</span></label>
    <input type="text" value="{{ $user->name }}" required class="simple-field" name="person">
    <label>Телефон <span>*</span></label>
    <input type="text" value="" required placeholder="Телефон для связи" class="simple-field" name="phone">
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