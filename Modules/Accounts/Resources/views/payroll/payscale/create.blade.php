@extends('accounts::layouts.master')
@section('title', trans('accounts::payscale.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('accounts::payscale.title')
                            @if($page == 'create')
                                @lang('labels.create')
                            @else
                                @lang('labels.edit')
                            @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('accounts::payroll.payscale.form', ['page' => $page])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">

@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>

    <script>
        $('input[name=active_from]').pickadate({
            format: 'd mmmm yyyy',
            selectYears: true,
            selectMonths: true,
        });

        function getDecimal(elementId) {
            $element = $("#"+ elementId);
            $element.val($element.val().replace(/\D/g,''));
        }
    </script>
@endpush
