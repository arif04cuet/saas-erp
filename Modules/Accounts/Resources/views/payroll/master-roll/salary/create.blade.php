@extends('accounts::layouts.master')
@section('title', trans('accounts::payroll.master_roll.title'))
@section('content')
    <div class="container">
        <div class="alert bg-warning mb-2 custom-message">

        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('accounts::payroll.master-roll.salary.form')
                        </div>
                    </div>
                </div>
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">
                            <section id="payslip-list">
                                <div class="row">
                                    <div class="col-xl-12 ">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">@lang('accounts::payroll.master_roll.index')</h4>
                                                <a class="heading-elements-toggle"><i
                                                        class="la la-ellipsis-h font-medium-3"></i></a>
                                            </div>
                                            {!! Form::open(['route' =>  'master-roll.salary.store', 'class' => 'form',
                                                'novalidate','id'=>'master-roll-form']) !!}

                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">
                                                    <table id="master_roll_table"
                                                           class="table table-striped table-bordered ">
                                                        <thead>
                                                        <tr>
                                                            <th width="5%%">@lang('labels.serial')</th>
                                                            <th width="15%">@lang('accounts::payroll.payslip.create_form_elements.employee')</th>
                                                            <th width="45%">@lang('labels.id')</th>
                                                            <th width="5%%">@lang('accounts::payroll.master_roll.form_elements.number_of_days')</th>
                                                            <th width="10%">@lang('accounts::payroll.master_roll.form_elements.payment_per_day')</th>
                                                            <th width="20% ">@lang('accounts::payroll.payslip.total')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Save / Cancel -->
                                            <div class="form-actions text-center">
                                                <button type="submit" class="btn btn-success" id="submit">
                                                    <i class="la la-check-square-o"></i>
                                                    @lang('labels.save')
                                                </button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </section>

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

        // global variables
        let selectPlaceholder = '{!! trans('labels.select') !!}';
        let title = "";
        let table = $('#master_roll_table').dataTable();

        let year = new Date().getFullYear();
        let month = new Date().getMonth();

        let periodFrom = $('input[name=period_from]').pickadate({
            min: new Date(year, month, 1),
            format: "yyyy-mm-dd",
            onSet: function () {
                changePeriodToDate(this);
            },
        });

        let periodTo = $('input[name=period_to]').pickadate({
            min: new Date(year, month, 1),
            format: "yyyy-mm-dd",
        });


        function hideFlashMessage() {
            $('.custom-message').hide();
        }

        $(document).ready(function () {
            initDateField();    // Init Date Field
            hideFlashMessage();
        });

        function initDateField() {
            periodFrom.pickadate('picker').set('select', [year, month, 1]);
            periodTo.pickadate('picker').set('select', [year, month + 1, 0])
        }

        function changePeriodToDate(obj) {
            let selectedDate = new Date(obj.get('select', 'yyyy-mm-dd'));
            month = selectedDate.getMonth();
            year = selectedDate.getFullYear();
            periodTo.pickadate('picker')
                .set('min', [year, month, 1])
                .set('max', [year, month + 1, 0])
                .set('select', [year, month + 1, 0]);
        }


        $("#search").click(function (e) {
            e.preventDefault();
            loadData();
        });

        function loadData() {
            let buttonRef = $('#search').text(`{{trans('accounts::payroll.payslip_report.form_elements.search')}}`);
            buttonRef.removeClass("btn-success").addClass("btn-warning");
            let testUrl = `{{route('master-roll.json.employee')}}`;
            let data = $("#master-roll-salary-form").serialize();
            loadingInfo();
            $.post(testUrl, data, function (data) {
                table.DataTable().clear().draw();
                buttonRef.removeClass("btn-warning").addClass("btn-success");
                buttonRef.text(`{{trans('accounts::payroll.master_roll.form_elements.search_button')}}`);
                clearInterval(myInterval);
                if (data.length == 0) {
                    $('.custom-message').html('Already Disbursed').show().delay(1500).fadeOut(400);
                    return;
                }
                populateDatatable(data);
            });
        }

        function populateDatatable(data) {
            hideFlashMessage();
            for (let row = 0; row < data.length; row++) {
                let obj = data[row];
                let daysFieldId = "number_of_days_" + row;
                let paymentFieldId = "payment_per_day_" + row;
                let totalField = "total_amount_" + row;
                let employeeName = obj.first_name + " " + obj.last_name;
                table.fnAddData([
                    row + 1,
                    employeeName + ' - ' + obj.employee_id,
                    '<input name="designation[]"  value="' + obj.employee_id + '" type="text" class="form-control" readonly >',
                    '<input id="' + daysFieldId + '"  min= 0 name="number_of_days[]" value="22" min="0" type="number" class="form-control" onkeyup="updateData(' + row + ')">',
                    '<input id="' + paymentFieldId + '" name="payment_per_day[]" min="0"  value="' + obj.payment_per_day + '" type="number" class="form-control" readonly> ',
                    '<input id="' + totalField + '"   value="' + obj.payment_per_day * 22 + '" type="number" class="form-control" readonly >',
                ]);
            }
        }

        function updateData(row) {
            let totalAmount = '#total_amount_' + row;
            let numberOfDays = parseInt($('#number_of_days_' + row).val());
            let paymentPerDay = parseInt($('#payment_per_day_' + row).val());
            $(totalAmount).val(numberOfDays * paymentPerDay);
        }

        $('#master-roll-form').submit(function (eventObj) {
                if (confirm("Are you sure ?")) {
                    let periodFrom = $('input[name=period_from]').val();
                    let periodTo = $('input[name=period_to]').val();
                    $(this).append('<input type="hidden" name="period_from" value="' + periodFrom + '" /> ');
                    $(this).append('<input type="hidden" name="period_to" value="' + periodTo + '" /> ');
                    table.api().rows().nodes().page.len(-1).draw(false);
                    return true;
                } else {
                    return false;
                }
            }
        );

        function loadingInfo() {
            let placeholder = `{{trans('accounts::payroll.payslip_report.form_elements.searching')}}`;
            let buttonRef = $('#search').html(placeholder);
            let counter = 1;
            myInterval = setInterval(function () {
                if (counter > 0 && counter < 4) {
                    buttonRef.append('.')
                } else {
                    counter = 0;
                    buttonRef.html(placeholder);
                }
                counter++;
            }, 200);
        }
    </script>
@endpush
