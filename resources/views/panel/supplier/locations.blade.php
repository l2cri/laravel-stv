@extends('panel.index')

@section('headscripts')

    @parent

    <script src="{{ url('js/jquery.bonsai.js') }}"></script>
    <script src="{{ url('js/jquery.qubit.js') }}"></script>
    <link rel="stylesheet" href="{{ url('css/jquery.bonsai.css') }}">

@endsection

@section('panel_content')

<div class="information-blocks">
    <h3 class="block-title main-heading">Зоны доставки</h3>

    <form method="post" action="{{ route('panel::location.zones.save') }}">

        {{ csrf_field() }}

        <?

        $traverse = function ($locations) use (&$traverse) {
            foreach ($locations as $location) {

            $checked = in_array( supplierId(), $location->suppliers()->lists('id')->all() ) ? " data-checked='1'" : "";
        ?>

            <li data-value='{{ $location->id }}'{{ $checked }}> {{ $location->name }} {{ $location->shortname }}

            <?
                $children = $location->children;
                if (count($children)) { ?>

                    <ol>
                        {{ $traverse($children) }}
                    </ol>

                <?}?>

            </li>

            <?}
        };

        ?>

        <ol id='locationTree' data-name='selectedLocations[]'>
            {{ $traverse($locationTree) }}
        </ol>

        <br>

        <div class="button style-10">Сохранить<input type="submit" value=""></div>

    </form>

    <script>
        $('#locationTree').bonsai({
            //expandAll: true,
            checkboxes: true, // depends on jquery.qubit plugin
            createInputs: 'checkbox' // takes values from data-name and data-value, and data-name is inherited
        });
    </script>

    <style>
        #locationTree li::before {content: none}
        #locationTree li label {display: inline-block; padding-left: 3px}
    </style>
</div>

@endsection