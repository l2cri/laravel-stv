@extends('panel.index')

@section('panel_content')
    <div class="row information-blocks sections-panel article-container style-2">
        <div class="col-md-12">

            <h1>Вопрос № {{ $id }}</h1>

            <form action="{{ route('panel::faq.update',['id'=>$id]) }}" method="post">

                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-7">

                        <label class="checkbox-entry">
                            <input type="checkbox" <?=($faq->moderated == 1)?'checked':''?> name="moderated" value="1">
                            <span class="check"></span> Активный
                        </label>
                        <div class="clear"></div>
                    </div>
                </div>
                <label>Вопрос:</label>
                <div>{{$faq->question}}</div>

                <label>Ответ:</label>
                <textarea class="simple-field" name="answer">{{ @$faq->answer }}</textarea>

                <div class="button style-10">Ответить<input type="submit" value=""></div>

            </form>
        </div>
    </div>
@endsection