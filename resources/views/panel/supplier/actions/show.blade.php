
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Акция: {{ $action->name }}</h4>
</div>
<div class="modal-body">
    <div class="row information-blocks sections-panel article-container style-2">
        <div class="col-md-12">

            <table class="table table-striped panel">
                <tr>
                    <th>Начало</th>
                    <th>Окончание</th>
                </tr>
                <tr>
                    <td>
                        <span class="pull-left">{{ $action->start }}</span>
                    </td>
                    <td>
                        <span class="pull-left">{{ $action->end }}</span>
                    </td>
                </tr>
                <tr>
                    <th>Активная</th>
                    <td> {{ !$action->active ? 'Нет' : 'Да' }}</td>
                </tr>
                <tr>
                    <th>Процент</th>
                    <td> {{ $action->percent }} </td>
                </tr>
                <tr>
                    <th>Статичная скидка</th>
                    <td>{{ $action->static }}</td>
                </tr>
                <tr>
                    <th>Описание</th>
                    <td>{{ $action->description }}</td>
                </tr>
            </table>

        </div>
    </div>
</div>