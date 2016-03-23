<select name="orderstatus" class="simple-field">
    @foreach($statuses as $status)
        <?$selected = ($status->id == $selectedId) ? ' selected="selected"' : ''?>
        <option value="{{ $status->id }}" style="color: {{ $status->color }}"{!! $selected !!}>{{ $status->name }}</option>
    @endforeach
</select>