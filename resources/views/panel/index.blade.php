@extends('main')

@section('headscripts')
    <link href="{{ url('https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ url('https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js') }}"></script>
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
                        </ul>
                    </div>
                    <div class="article-container">
                        <br/>Custom CMS block displayed below the one page account panel block. Put your own content here.
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection