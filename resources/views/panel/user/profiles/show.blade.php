
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Профиль {{ $profile->name }}</h4>
    </div>
    <div class="modal-body">
        <div class="row information-blocks sections-panel article-container style-2">
            <div class="col-md-12">

                <table class="table table-striped panel">
                    <tr>
                        <th>Имя контактного лица</th>
                        <td>{{ $profile->person }} <i class="fa fa-rub"></i></td>
                    </tr>
                    <tr>
                        <th>Телефон</th>
                        <td>{{ $profile->phone }} <i class="fa fa-rub"></i></td>
                    </tr>
                    <tr>
                        <th>Адрес</th>
                        <td>{{ $profile->address }}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>