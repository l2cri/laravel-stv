@if( isset($profile) && !empty($profile) )
    <input type="hidden" name="profile_id" value="{{ $profile->id }}">

    <label>Имя <span>*</span></label>
    <input type="text" value="{{ $profile->person }}" required class="simple-field" name="person">
    <label>Телефон <span>*</span></label>
    <input type="text" value="{{ $profile->phone }}" required class="simple-field" name="phone">
    <label>Адрес <span>*</span></label>
    <textarea name="address" required="" placeholder="Адрес как можно подробнее" class="simple-field">{{ $profile->address }}</textarea>
@else
    <label>Имя <span>*</span></label>
    <input type="text" value="{{ $user->name }}" required class="simple-field" name="person">
    <label>Телефон <span>*</span></label>
    <input type="text" value="" required placeholder="Телефон для связи" class="simple-field" name="phone">
    <label>Адрес <span>*</span></label>
    <textarea required="" name="address" placeholder="Адрес как можно подробнее" class="simple-field"></textarea>
@endif