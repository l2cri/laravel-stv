@extends('panel.index')

@section('panel_content')

    @include('panel.modalshow')

    <div class="information-blocks sections-panel">

        <button data-toggle="modal" data-target="#modal_create" class="button style-2">Добавить акцию</button>

        <!-- Modal Add -->
        <div class="modal fade" id="modal_create" tabindex="-1" role="dialog" aria-labelledby="modal_createLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal_createLabel">Добавить акцию</h4>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('panel::actions.add') }}" method="post" id="form_create">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-3">
                                    <label>Начало</label>
                                    <input type="text" required="" id="start"
                                           class="simple-field"
                                           name="start">
                                </div>
                                <div class="col-md-9">
                                    <label>Окончание</label>
                                    <input type="text" required=""
                                           class="simple-field"
                                           name="end" id="end">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <label class="checkbox-entry">
                                        <input type="checkbox" checked name="active"> <span class="check"></span> Активна
                                    </label>
                                    <div class="clear"></div>

                                    <label>Название <span>*</span></label>
                                    <input type="text" required=""
                                           class="simple-field"
                                           name="name">
                                    <div class="clear"></div>

                                    <label>Процент</label>
                                    <input type="text"
                                           class="simple-field"
                                           name="percent">
                                    <div class="clear"></div>

                                    <label>Статическая скидка</label>
                                    <input type="text"
                                           class="simple-field"
                                           name="static">
                                    <div class="clear"></div>

                                    <label>Описание</label>
                                    <textarea rows="2" class="simple-field" name="description" style="height: 70px"></textarea>

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

            $( document ).on( "click", "#submit_update", function() {
                submitUpdateForm('{{ route('panel::actions.update') }}');
            });

            $('#submit_create').click(function(){
                submitCreateForm('{{ route('panel::actions.add') }}');
            });

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
        });
    </script>

    <div class="row information-blocks sections-panel">
        <div class="col-md-12">
            <h3 class="block-title">Мои акции</h3>
            <div class="row">
                <div class="col-md-12">
                    @foreach ($actions as $action)
                        <div class="row padding-bottom-10">
                            <div class="col-md-8">
                                <a data-toggle="modal" data-target="#modal_show"
                                   href="{{ route('panel::actions.show', $action->id) }}">
                                    {{ $action->name }}
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a data-toggle="modal" data-target="#modal_show"
                                   href="{{ route('panel::actions.show.update', $action->id) }}">
                                    <i class="fa fa-edit"></i></a>
                                <a href="{{ route('panel::profile.delete', $action->id) }}"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection