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

    <div class="row information-blocks sections-panel">
        <div class="col-md-12">
            <h3 class="block-title">Мои профили</h3>
            <div class="row">
                <div class="col-md-12">
                    @foreach ($profiles as $profile)
                        <div class="row padding-bottom-10">
                            <div class="col-md-8"><a href="">
                                    {{ $profile->name }} ({{$profile->person}})
                                </a></div>
                            <div class="col-md-4">
                                <a href=""><i class="fa fa-edit"></i></a>
                                <a href=""><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection