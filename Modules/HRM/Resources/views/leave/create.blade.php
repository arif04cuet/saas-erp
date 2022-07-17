@extends('hrm::layouts.master')
@section('title', trans('hrm::leave.leave_application'))

@section('content')
    <section id="leave">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="repeat-form">@lang('hrm::leave.leave_application')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
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
                            @include('hrm::leave.form.leave-application', ['page' => 'create'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <script src="{{ asset('js/utility/NumberConverter.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
        let restAndRecreationalLeave = @json($restAndRecreationalLeave);
        let leavePurposeMaxDays = [];
        let availableLeaveDays;
        let maxAllowed = null;

        /* leave type drop down js codes */
        $(document).ready(function() {
            validateForm('.leave-application-form');
            initiateDatePickers();
            let purposeLabel = '{!! trans('hrm::leave.purpose') !!}';
            let leaveTypeOptions = @json($leaveTypeOptions);
            let preCalculatedLeaves = @json($preCalculatedLeaves, JSON_UNESCAPED_UNICODE);
            let leaveTypeDropdownSelector = 'select[name=leave_type_id]';
            let durationField = 'input[name=duration]';
            let selectedLeave = $('input[name=leave_type_id]').val();

            if (selectedLeave !== undefined && selectedLeave === null) {
                let leaveTypeId = selectedLeave;

                let leaveTypeOption = leaveTypeOptions.find(leaveOption => {
                    return leaveOption.id === leaveTypeId;
                });

                let preCalculatedOption = preCalculatedLeaves.find(option => {
                    return option.id === leaveTypeId;
                });

                if (preCalculatedOption.pre_calculated === true) {
                    $(durationField).attr('readOnly', true);
                    $(durationField).val(preCalculatedOption.pre_calculated_leaves);
                    dateDifference();
                } else {
                    $(durationField).attr('readOnly', false);
                }
            }


            $(leaveTypeDropdownSelector).select2({
                placeholder: '{!! trans('labels.select') !!}'
            });

            $(leaveTypeDropdownSelector).on('change', function() {

                let leaveTypeId = Number($(this).val());

                // Checking balance of the selected leave type
                if (leaveTypeId > 0) {
                    var url = leaveTypeId + "/balance";
                    $.get(url, function(data) {
                        leavePurposeMaxDays = data[3];
                        availableLeaveDays = data[1];
                        var minLeaveCount = Math.min(data[1], data[2]);
                        let maxAllowedNumber = (data[2] != null) ? minLeaveCount : data[1];
                        if (data[4]) {
                            maxAllowed = maxAllowedNumber = Math.min(maxAllowedNumber, data[4]);
                        }
                        $html = "<table class='table table-bordered table-striped'><tr>" +
                            "<th>@lang('hrm::leave.available_leave_days')</th>" +
                            "<th>@lang('hrm::leave.spent_leave_count')</th>" +
                            "<th '>@lang('hrm::leave.max_allowed_days')</th>" +
                            "<th '>@lang('hrm::leave.available_leave_days_by_earned_type')</th></tr>" +
                            "<tr><th  class='th-available-leave-days'>" + data[1] + "</th>" +
                            "<th>" + data[0] + "</th>" +
                            "<th class ='th-max-allowed-days'>" + ((data[2] != null) ?
                                data[2] :
                                'N/A') + "</th>" +
                            "<th class ='mother-type-amount'>" + ((data[4] != null) ?
                                data[4] :
                                'N/A') + "</th>" +
                            "</tr></table>";

                        $('#balance_info').html($html);
                        // modify duration validation number
                        modifyDurationValidation(
                            maxAllowedNumber
                        ); // for some reason, the numbers are coming in converted
                    });
                } else {
                    $('#balance_info').html('');
                }

                let oldPurposeId = '{!! old('leave_type_purpose_id') !!}';

                let oldDuration = '{!! old('duration') !!}';

                let leaveTypeOption = leaveTypeOptions.find(leaveOption => {
                    return leaveOption.id === leaveTypeId;
                });

                let preCalculatedOption = preCalculatedLeaves.find(option => {
                    return option.id === leaveTypeId;
                });

                if (preCalculatedOption.pre_calculated === true) {
                    $(durationField).attr('readOnly', true);
                    $(durationField).val(preCalculatedOption.pre_calculated_leaves);
                    dateDifference();
                } else {
                    $(durationField).attr('readOnly', false);
                }

                let purposeDivSelector = '#purpose-div';
                if (typeof leaveTypeOption !== undefined) {
                    if (leaveTypeOption.purposes.length > 0) {
                        $(purposeDivSelector).children().remove();
                        $(purposeDivSelector).append(
                            `<div class="col-md-12"><label class="required">${purposeLabel}</label></div>`
                        );

                        let gridValue = parseInt(12 / leaveTypeOption.purposes.length);

                        leaveTypeOption.purposes.forEach(purpose => {
                            $(purposeDivSelector).append(`<div class="col-md-${gridValue}">
                                <div class="radio">
                                    <label>
                                        <input type="radio"
                                            name="leave_type_purpose_id"
                                            value="${purpose.id}"
                                            class = "required leave-type-purpose-id"
                                            ${oldPurposeId == purpose.id ? 'checked' : ''}
                                        /> ${purpose.name}

                                    </label>
                                </div>
                            </div>`);
                        });
                    } else {
                        $(purposeDivSelector).children().remove();
                    }
                }

                checkForRestAndRecreationLeave(leaveTypeId);
            });

            let oldLeaveTypeId = '{!! old('leave_type_id') !!}';
            if (oldLeaveTypeId) {
                $(leaveTypeDropdownSelector).trigger('change');
            }
        });


        function initiateDatePickers() {
            $('#leave_start_date, #leave_end_date').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD-MM-YYYY'
                }
            });
        }

        function modifyDurationValidation(max) {
            message = '{{ trans('labels.max_validate_equal_or_less', ['max' => ':id']) }}'
            $('#duration').rules("add", {
                max: max,
                messages: {
                    max: jQuery.validator.format(message.replace(":id", '{0}'))
                }
            });
        }

        function dateDifference() {
            let startDateValue = $('#leave_start_date').val();
            let duration = parseInt($('#duration').val());

            let endDateValue = moment(startDateValue, 'DD-MM-YYYY')
                .add(duration - 1, 'days')
                .format('DD-MM-YYYY');

            $('#leave_end_date').val(endDateValue);
        }

        // for rest and recreational leave
        function checkForRestAndRecreationLeave(selectedLeave) {
            let durationField = 'input[name=duration]';
            if (selectedLeave !== undefined && restAndRecreationalLeave !== null) {
                let recreationalLeaveTypeId = restAndRecreationalLeave.id;
                if (selectedLeave === recreationalLeaveTypeId) {
                    $(durationField).attr('readOnly', true);
                    $(durationField).val(15);
                    dateDifference();
                }
            }
        }

        // if purpose is changed
        $(document).on("change", 'input[name=leave_type_purpose_id]', function() {
            let amount = leavePurposeMaxDays[$(this).val()].amount;
            let maxAllowedDays = leavePurposeMaxDays[$(this).val()].maximum_allowed_days;
            $('.th-available-leave-days').html(Math.min(amount, availableLeaveDays));
            $('.th-max-allowed-days').html(maxAllowedDays);
            if (maxAllowed)
                maxAllowedDays = Math.min(maxAllowedDays, maxAllowed);
            var minLeaveCount = Math.min(amount, maxAllowedDays);
            modifyDurationValidation(minLeaveCount);
        });
    </script>
@endpush
