@extends('hrm::layouts.master')
@section('title', trans('hrm::leave.leave_update'))

@section("content")
    <section id="leave">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="repeat-form">@lang('hrm::leave.leave_update')</h4>
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
                            @include('hrm::leave.balance.form', ['page' => 'create'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-js')
    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <script src="{{asset('js/utility/NumberConverter.js')}}" type="text/javascript"></script>


    <script type="text/javascript">
        let leavePurposeMaxDays = [];
        let balance = [];

        /* leave type drop down js codes */
        $(document).ready(function () {
            validateForm('.leave-application-form');
            let purposeLabel = '{!! trans('hrm::leave.purpose') !!}';
            let leaveTypeOptions = @json($leaveTypeOptions);
            let leaveTypeDropdownSelector = 'select[name=leave_type_id]';

            $(leaveTypeDropdownSelector).select2({
                placeholder: '{!! trans('labels.select') !!}'
            });

            $(leaveTypeDropdownSelector).on('change', function () {

                let leaveTypeId = Number($(this).val());
                let actionType = $('input[name="status"]:checked').val();

                // Checking balance of the selected leave type

                if (leaveTypeId > 0) {
                    let url = '{{ route('leaves.balance',":id")}}';
                    url = url.replace(":id", leaveTypeId);
                    $.get(url, function (data) {
                        leavePurposeMaxDays = data[3];
                        balance = data;
                        let maxAmount = data[1];
                        // modify duration validation number
                        if(actionType === 'approved') {
                            modifyDurationValidation(maxAmount); // for some reason, the numbers are coming in converted
                        }
                    });
                }

                let oldPurposeId = '{!! old('leave_type_purpose_id') !!}';

                let leaveTypeOption = leaveTypeOptions.find(leaveOption => {
                    return leaveOption.id === leaveTypeId;
                });

                let purposeDivSelector = '#purpose-div';
                if (typeof leaveTypeOption !== undefined) {
                    if (leaveTypeOption.purposes.length > 0) {
                        $(purposeDivSelector).children().remove();
                        $(purposeDivSelector).append(`<div class="col-md-12"><label class="required">${purposeLabel}</label></div>`);

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
            });

            let oldLeaveTypeId = '{!! old('leave_type_id') !!}';
            if (oldLeaveTypeId) {
                $(leaveTypeDropdownSelector).trigger('change');
            }
        });

        function modifyDurationValidation(max) {
            message = '{{trans('labels.max_validate_equal_or_less',['max'=>':id'])}}'
            $('#duration').rules("add", {
                max: max,
                messages: {
                    max: jQuery.validator.format(message.replace(":id", '{0}'))
                }
            });
        }

        $(document).on("change", 'input[name=leave_type_purpose_id]', function () {
            let amount = leavePurposeMaxDays[$(this).val()].amount;
            let actionType = $('input[name="status"]:checked').val();
            if (actionType === 'approved') {
                modifyDurationValidation(amount);
            }
        });

        $(document).on("change", 'input[name=status]', function () {
            let purpose = $('input[name=leave_type_purpose_id]:checked').val();
            let actionType = $('input[name="status"]:checked').val();
            if (actionType === 'approved') {
                if (purpose !== undefined ) {
                    let amount = leavePurposeMaxDays[$(this).val()].amount;
                    modifyDurationValidation(amount);
                } else {
                    let maxAmount = balance[1];
                    modifyDurationValidation(maxAmount);
                }
            } else {
                $('#duration').rules("remove", "max")
            }
        });
    </script>
@endpush
