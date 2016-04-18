@extends('main')

@section('content')

    <div class="breadcrumb-box">
        <a href="#">Главная</a>
        <a href="#">Каталог компаний</a>
    </div>

    <div class="information-blocks">
        <div class="row">

            <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4" id="catalogSuppliers">

                @include('suppliers.suppliers')

            </div>

            <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 blog-sidebar">
                <div class="information-blocks categories-border-wrapper">
                    <div class="block-title size-3">
                        Потребительские товары
                    </div>

                    @if (isset($currentSectionPotreb))
                        @include('common.saccordion', ['sections' => $sectionsPotreb, 'currentSection' => $currentSectionPotreb])
                    @else
                        @include('common.saccordion', ['sections' => $sectionsPotreb])
                    @endif


                    <div class="block-title size-3">
                        Промышленные товары
                    </div>

                    @if (isset($currentSectionProm))
                        @include('common.saccordion', ['sections' => $sectionsProm, 'currentSection' => $currentSectionProm])
                    @else
                        @include('common.saccordion', ['sections' => $sectionsProm])
                    @endif

                </div>

                <form id="filterForm" method="post">

                    {{ csrf_field() }}

                    {{--start serialize div--}}
                    <div id="srlz">
                        <input type="hidden" value="{{ @$currentSectionCopy->id }}" name="sectionId">

                        <div class="information-blocks">
                            <div class="block-title size-3">По зоне доставки</div>
                            <div>

                                @include('common.geo')


                            </div>
                            <a class="button style-14" id="submitFilterForm">Фильтр</a>
                        </div>

                    </div>
                    {{--end serialize div--}}
                </form>

                <script>
                    $(function() {

                        if(window.location.search.indexOf("filterByLocation=") > -1){
                            setParamsFromLocation('a.addFilterParams', 'filterByLocation=1');
                        }

                        /*
                         кнопка фильтра
                         */
                        var filterButton = $("#submitFilterForm");
                        filterButton.on("click", function() {

                            submitFormByAjax( '{{ route('suppliers.ajax') }}',
                                            $( "#filterForm" ).serialize()).done(function(data){
                                $("#catalogSuppliers").html(data);
                                setParamsFromLocation('a.addFilterParams', 'filterByLocation=1');

                            }).fail(function(jqXHR) {
                                alert("Ошибка: "+jqXHR.responseText);
                            });
                        });
                    });
                </script>

            </div>
        </div>
    </div>

@endsection