@extends('pms::layouts.master')
@section('title', trans('pms::budget.sector.title'))

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <h4 class="card-title">
                        @lang('pms::budget.sector.title')
                        @if($page == 'create')
                            @lang('labels.create')
                        @else
                            @lang('labels.edit')
                        @endif
                    </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    @include('pms::budget.sector.form')
                </div>
            </div>
        </div>

    </div>

@endsection


@push('page-js')

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>


    <script>


        let sectorItemsRepeater = $(`.repeater-sector-items`).repeater({
            show: function () {
                $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");
                $(this).slideDown(function () {

                    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
                });
            },
            hide: function (deleteElement) {
                if (confirm('@lang('labels.confirm_delete')')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // making the first item not deletable
            @if($page == 'create')
            isFirstItemUndeletable: true
            @endif
        });
    </script>

@endpush
