@extends('accounts::layouts.master')
@section('title', trans('accounts::payroll.payslip.index'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('accounts::payroll.payslip.filter-form')
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
                                                <h4 class="card-title">@lang('accounts::payroll.payslip.index')</h4>
                                                <a class="heading-elements-toggle"><i
                                                        class="la la-ellipsis-h font-medium-3"></i></a>

                                            </div>
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">
                                                    <table id="payslip_table"
                                                           class="table table-striped table-bordered ">
                                                        <thead>
                                                        <tr>
                                                            <th>@lang('labels.serial')</th>
                                                            <th>@lang('accounts::payroll.payslip.create_form_elements.payslip_name')</th>
                                                            <th>@lang('accounts::payroll.payslip.create_form_elements.employee')</th>
                                                            <th>@lang('accounts::payroll.payslip.create_form_elements.period_from')
                                                                -@lang('accounts::payroll.payslip.create_form_elements.period_to')</th>
                                                            <th>@lang('accounts::payroll.payslip.total')</th>
                                                            <th>@lang('labels.status')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($payslips as $payslip)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>
                                                                    <a href="{{ route('payslips.show', $payslip->id) }}">{{ $payslip->payslip_name }}</a>
                                                                </td>
                                                                <td>{{ $payslip->employee->getName() }}</td>
                                                                <td>{{ $payslip->period_from->format('j F, Y')}}
                                                                    - {{$payslip->period_to->format('j F, Y') }}</td>
                                                                <td>{{ $payslip->total_amount ?? '0' }}</td>
                                                                <td>{{ $payslip->status }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
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
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script type="text/javascript">
        @if(app()->isLocale('en'))
        let selectPlaceholder = 'All';
        @else
        let selectPlaceholder = 'সকল';
        @endif

        let table = $('#payslip_table').dataTable({});
        let myInterval;
        let genericErrorMessage = `{{trans('labels.generic_error_message')}}`;

        $(document).ready(function () {
            // select2 initialization
            $('.employee-select').select2({
                placeholder: selectPlaceholder,
            });

            $('.sector-select').select2().select2("val", "5");
            // datepicker-init
            $('input[name=period_from], input[name=period_to]').pickadate({
                format: 'mmmm,yyyy',
                selectYears: true,
                selectMonths: true,
            });
        });


        $("#search").click(function (e) {
            e.preventDefault();
            loadData();
        });

        function loadData() {
            let buttonRef = $('#search').text(`{{trans('accounts::payroll.payslip_report.form_elements.search')}}`);
            buttonRef.removeClass("btn-success").addClass("btn-warning");
            let testUrl = `{{route('payslips.filter')}}`;
            let data = $("#payslip-filter-form").serialize();
            loadingInfo();
            $.ajax({
                url: testUrl,
                data: data,
                type: "POST",
                success: function (data) {
                    table.DataTable().clear().draw();
                    populateDatatable(data);
                    resetSearchButton(buttonRef);
                    return true;
                },
                error: function (request, status, error) {
                    resetSearchButton(buttonRef);
                    alert(genericErrorMessage);
                    return false;
                }
            });
        }

        function resetSearchButton(buttonRef) {
            buttonRef.removeClass("btn-warning").addClass("btn-success");
            buttonRef.text(`{{trans('accounts::payroll.payslip_report.form_elements.search')}}`);
            clearInterval(myInterval);
        }

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

        function populateDatatable(data) {
            for (let row = 0; row < data.length; row++) {
                let obj = data[row];
                let url = `{!! route('payslips.show',":id")!!}`;
                url = url.replace(':id', obj.id);
                table.fnAddData([
                    row + 1,
                    '<a href="' + url + '">' + obj.payslip_name + '</a>',
                    obj.employee_name,
                    obj.period_from + ' - ' + obj.period_to,
                    obj.total_amount,
                    obj.status
                ]);
            }
        }
    </script>

@endpush
