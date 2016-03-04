@extends('panel.index')

@section('panel_content')

    <div class="information-blocks sections-panel">

        <button data-toggle="modal" data-target="#modal_create" class="button style-2">Добавить профиль</button>

        <!-- Modal Add -->
        <div class="modal fade" id="modal_create" tabindex="-1" role="dialog" aria-labelledby="modal_createLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal_createLabel">Добавить профиль</h4>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('panel::profile.add') }}" method="post" id="form_create">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-12">

                                    <label>Название <span>*</span></label>
                                    <input type="text" required=""
                                           class="simple-field"
                                           name="name">
                                    <div class="clear"></div>

                                    <label>Имя контактного лица <span>*</span></label>
                                    <input type="text" required=""
                                           class="simple-field"
                                           name="person">
                                    <div class="clear"></div>

                                    <label>Телефон <span>*</span></label>
                                    <input type="text" required=""
                                           class="simple-field"
                                           name="phone">
                                    <div class="clear"></div>

                                    <label>Адрес</label>
                                    <textarea rows="2" class="simple-field" name="address" style="height: 70px"></textarea>


                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" id="submit_create">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function(){
            $('#submit_create').click(function(){
                submitCreateForm('{{ route('panel::profile.add') }}');
            });
        });
    </script>

@endsection