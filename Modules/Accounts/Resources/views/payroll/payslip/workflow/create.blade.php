@extends('accounts::layouts.master')
@section('title', trans('accounts::payroll.payslip_batch.title'))
@section('content')

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
                        @include('accounts::payroll.payslip.workflow.form')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <script>

        // let year = new Date().getFullYear();
        // let month = new Date().getMonth();
        //
        // let periodFrom = $('input[name=period_from]').pickadate({
        //     min: new Date(year, month, 1),
        //     // max: new Date(year, month + 1, 0),
        //     format: "yyyy-mm-dd",
        //     onSet: function () {
        //         changePeriodToDate(this);
        //     },
        // });
        //
        // let periodTo = $('input[name=period_to]').pickadate({
        //     // min: new Date(year, month, 1),
        //     max: new Date(year, month + 1, 0),
        //     format: "yyyy-mm-dd",
        // });
        //
        // $(document).ready(function () {
        //     // Init Date Field
        //     initField();
        //
        //     // custom logic
        //     $('.employee-select').on('change', function () {
        //         let title = $(this).find('option:selected').val().trim();
        //         let month = new Date().toLocaleString("en-us", {month: "long"});
        //         let year = new Date().getFullYear();
        //         let payslipName = `Salary Slip For ${title}, ${month}-${year}`;
        //         $('input[name=payslip_name]').val(payslipName);
        //     });
        // });
        //
        // function initField() {
        //     let [month, year] = getDateMetadata();
        //     setPayslipName(month, year);
        //     setReferenceField(month, year);
        // }
        //
        // function getDateMetadata() {
        //     let selectedDate = new Date(periodTo.pickadate('picker').get('select', 'yyyy-mm-dd'));
        //     let month = selectedDate.toLocaleString("en-us", {month: "long"});
        //     let year = selectedDate.getFullYear();
        //     return [month, year];
        // }
        //
        // function setPayslipName(month, year) {
        //     let payslipName = `Salary Slip for ${month.toLocaleString("en-us", {month: "long"})},${year}`;
        //     $('input[name=name]').val(payslipName);
        // }
        //
        // function setReferenceField(month, year) {
        //     let payslipName = `PAYSLIP-BATCH/BARD/${month.toLocaleString("en-us", {month: "long"})}/${year}`;
        //     $('input[name=reference]').val(payslipName);
        // }
        //
        // function changePeriodToDate(obj) {
        //     let selectedDate = new Date(obj.get('select', 'yyyy-mm-dd'));
        //     month = selectedDate.getMonth();
        //     year = selectedDate.getFullYear();
        //     periodTo.pickadate('picker')
        //         .set('min', [year, month, 1])
        //         .set('max', [year, month + 1, 0])
        //         .set('select', [year, month + 1, 0]);
        //     initField();
        // }
    </script>
@endpush
