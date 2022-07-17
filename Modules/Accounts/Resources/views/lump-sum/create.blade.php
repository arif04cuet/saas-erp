@extends('accounts::layouts.master')
@section('title', trans('accounts::pension.lump_sum.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('accounts::pension.lump_sum.form')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('accounts::lump-sum.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush


@push('page-js')
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <script>
        // global variables
        let selectPlaceholder = '{!! trans('labels.select') !!}';
        $(document).ready(function () {
            makeSelect2();
            $('.employee-select').on('change', function () {
                let employeeId = $(this).find('option:selected').val().trim();
                setEmployeeData(employeeId);
                fetchNominees();
            });
            let pensionRuleForm = $('.deduction-repeater');
            let pensionRuleFormRepeater = pensionRuleForm.repeater({
                show: function () {
                    $(this).slideDown();
                    pensionRuleForm.find('select').next('.select2-container').remove();
                    pensionRuleForm.find('select').select2({
                        placeholder: selectPlaceholder,
                    });
                },
                defaultValues: {
                    'amount': '0',
                },
                initEmpty: true,
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        let removedAmount = parseInt($(this).repeaterVal().deduction[0].amount);
                        if (isNaN(removedAmount)) {
                            let removedAmount = 0;
                        }
                        let totalAmount = getTotalAmount();
                        $('.lump-sum-amount').val(totalAmount + removedAmount);
                    }
                }
            });
        });

        function makeSelect2() {
            // employee dropdown
            $('.employee-select').val('select').select2({  // select2 initialization
                placeholder: selectPlaceholder,
            });

            //economy code
            $('.code-select').val('select').select2({  // select2 initialization
                placeholder: selectPlaceholder,
            });
        }

        function setEmployeeData(employeeId) {
            let url = '{{route('lump-sum.json.show',":id")}}';
            url = url.replace(":id", employeeId);
            $.get(url, function (data) {
                setSalaryField(data.basic_salary);
                setEligiblePensionField(data.pensionConfiguration.percentage);
                setMonthlyPensionField(data.pensionConfiguration.lump_sum_percentage);
                setLumpSumField(data.pensionConfiguration.lump_sum_number);
            });
        }

        function setSalaryField(salary) {
            let basicSalaryField = $('#basic_salary');
            basicSalaryField.val(salary);
        }

        function setEligiblePensionField(percentage) {
            let eligibleMonthField = $('#eligible_pension');
            let val = Math.round((getBasicSalary() * percentage) / 100);
            eligibleMonthField.val(val);
        }

        function setMonthlyPensionField(lumpSumPercentage) {
            let monthlyPensionField = $('#monthly_pension');
            let eligibleForPension = parseInt($('#eligible_pension').val());
            let val = Math.round((eligibleForPension * lumpSumPercentage) / 100);
            monthlyPensionField.val(val);
        }

        function setLumpSumField(lumpSumNUmber) {
            let lumpSumField = $('#lump_sum_amount');
            let totalLumpSumField = $('#total_pension');
            let monthlyPension = parseInt($('#monthly_pension').val());
            let val = (monthlyPension * lumpSumNUmber);
            totalLumpSumField.val(val);
            lumpSumField.val(val);
        }

        function getBasicSalary() {
            let val = parseInt($('#basic_salary').val());
            return val;
        }

        // // value change
        $(document).on('change', '.deduction-amount', function () {
            let value = parseInt($(this).val());
            if (isNaN(value)) {
                value = 0;
            }
            let totalAmount = $('#total_pension').val();
            if (totalAmount == 0) {
                $(this).val(0);
                return;
            }
            $('.lump-sum-amount').val(totalAmount - value);
        });

        function getTotalAmount() {
            return parseInt($('.lump-sum-amount').val());
        }

        $('#receiver').change(function () {
            $receiver = $(this).val();
            if ($receiver == '{{array_keys(config('constants.pension.contract.receiver_type'))[1]}}') {
                $('#nominee_dropdown').show();
                fetchNominees();
            } else {
                $('#nominee_dropdown').hide();
            }
        });

        $('#receiver').trigger('change');

        function fetchNominees() {
            $employeeId = $('#employee_id').val();
            if ($('#receiver').val() == 'nominee' && $employeeId) {
                $.ajax({
                    url: '{{url('accounts/pension/fetch-nominees')}}/' + $employeeId,
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        $("#nominee_id").empty();
                        $.each(data, function (index, value) {
                            $("#nominee_id").append("<option value='" + index + "'>" + value + "</option>");
                        })
                    }
                });
            }
        }

    </script>
@endpush
