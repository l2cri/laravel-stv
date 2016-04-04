<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Редактировать профиль</h4>
</div>
<div class="modal-body">

    <form action="{{ route('panel::actions.update') }}" method="post" id="form_update">
        {{ csrf_field() }}

        <input type="hidden" name="actionId" value="{{ $action->id }}">

        <div class="row">
            <div class="col-md-12">

                <label class="checkbox-entry">
                <input type="checkbox" {{ $action->active ? 'checked' : '' }}
                        name="active"> <span class="check"></span> Активна
                </label>
                <div class="clear"></div>

                <label>Название <span>*</span></label>
                <input type="text" required=""
                       class="simple-field"
                       name="name"
                       value="{{ $action->name }}">
                <div class="clear"></div>

                <label>Период</label>

                <input type="text" required=""
                       class="simple-field"
                       name="start"
                       value="{{ $action->start }}"
                       id="start">
                <input type="text" required=""
                       class="simple-field"
                       name="end"
                       value="{{ $action->end }}"
                       id="end">

                <div class="clear"></div>

                <label>Процент</label>
                <input type="text"
                       class="simple-field"
                       name="percent"
                       value="{{ $action->percent }}">
                <div class="clear"></div>

                <label>Статичная скидка</label>
                <input type="text"
                       class="simple-field"
                       name="percent"
                       value="{{ $action->static }}">
                <div class="clear"></div>

                <label>Описание</label>
                <textarea rows="2" class="simple-field" name="description" style="height: 70px">{{ $action->description }}</textarea>


            </div>
        </div>

    </form>

</div>

<script>
    jQuery('#start').periodpicker({

        end: '#end',
        lang: 'ru',
        timepicker: true, // use timepicker
        timepickerOptions: {
            hours: true,
            minutes: true,
            seconds: false,
            ampm: false,
            twelveHoursFormat:false
        }
    });
</script>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
    <button type="button" class="btn btn-primary" id="submit_update">Сохранить</button>
</div>