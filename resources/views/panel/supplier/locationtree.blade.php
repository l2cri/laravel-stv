@extends('panel.index')

@section('headscripts')

    @parent

    <script src="{{ url('js/tree.js') }}"></script>
    <link rel="stylesheet" href="{{ url('css/tree.css') }}">

@endsection

@section('panel_content')

    <div class="information-blocks">
        <h3 class="block-title main-heading">Зоны доставки</h3>

        <strong>Выбранные</strong><br><br>

        @foreach( $supplierLocations as $sLoc)
            <p class="text-success">{{ treeSymbol($sLoc->depth*2, '&nbsp;') }} {{ $sLoc->path }}</p>
        @endforeach

        <br><br>
        <strong>Назначить зоны доставки</strong><br><br>

        <form method="post" action="{{ route('panel::location.zones.save') }}">

            {{ csrf_field() }}


            <ul class="Container" id="tree">

                @foreach( $locationTree as $location )

                    <? $checked = in_array( supplierId(), $location->suppliers()->lists('id')->all() ) ? "checked" : ""; ?>

                    <li class="Node IsRoot IsLast ExpandClosed" id="{{ $location->id }}">
                        <div class="Expand"></div>
                        <div class="Content">
                            <input type="checkbox" name="selectedLocations[]" value="{{ $location->id }}" {{ $checked }}>
                            {{ $location->name }} {{ $location->shortname }}
                        </div>
                        <ul class="Container">
                        </ul>
                    </li>

                @endforeach
            </ul>


            <br>

            <div class="button style-10">Сохранить<input type="submit" value=""></div>

        </form>

        <script>
            onload = function() { tree("tree", '{{ route('panel::location.zones.ajax') }}' ) }
        </script>

        <style>

        </style>
    </div>

@endsection