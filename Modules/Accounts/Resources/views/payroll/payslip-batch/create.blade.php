@extends('accounts::layouts.master')
@section('title', trans('accounts::payroll.payslip_batch.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('accounts::payroll.payslip_batch.create')</h4>
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
                            @include('accounts::payroll.payslip-batch.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <!-- checkbox related -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <!-- repeater -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>
    <!-- custom -->
    <script type="text/javascript" src="{{ asset('js/payslip/payslip-batch.js')}}"></script>

    <script>

        let year = new Date().getFullYear();
        let month = new Date().getMonth();
        let bonus = @json($bonus,JSON_UNESCAPED_UNICODE);
        let periodFrom = $('input[name=period_from]').pickadate({
            min: new Date(year, month, 1),
            // max: new Date(year, month + 1, 0),
            format: "yyyy-mm-dd",
            onSet: function () {
                changePeriodToDate(this);
            },
        });

        let periodTo = $('input[name=period_to]').pickadate({
            // min: new Date(year, month, 1),
            max: new Date(year, month + 1, 0),
            format: "yyyy-mm-dd",
        });

        $(document).ready(function () {
            // Init Date Field
            if (bonus) {
                toggleBonusContractDiv(true);
                initField(true);
            } else {
                toggleBonusContractDiv(false);
                initField();
            }
        });


    </script>
@endpush
