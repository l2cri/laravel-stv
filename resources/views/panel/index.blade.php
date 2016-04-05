@extends('main')

@section('headscripts')
    <link href="{{ url('https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/css/jquery.periodpicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/css/jquery.timepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ url('/js/moment.min.js') }}"></script>
    <script src="{{ url('/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ url('/js/jquery.periodpicker.full.min.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
@endsection

@section('content')

    <div class="information-blocks">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">
                @yield('panel_content')
            </div>
            <div class="col-sm-3 col-sm-pull-9 blog-sidebar padding-right-40">
                <div class="information-blocks">
                    <div class="categories-list account-links">
                        <ul>
                            @can('supplier_panel')
                                @include('panel.menu.supplier')
                            @endcan

                            @can('user_panel')
                                @include('panel.menu.user')
                            @endcan
                        </ul>
                    </div>
                    <div class="article-container">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection