@extends('hm::layouts.master')
@section('title', __('hm::checkin.search_approved_booking'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="repeat-form">
                            @lang('hm::checkin.training.form')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('hm::check-in.approved-training.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
    <!-- checkbox Related -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>
    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <!-- custom js -->
    <script src="{{ asset('js/check-in/checkin.js') }}"></script>
    <script src="{{ asset('js/check-in/approved-training.js') }}"></script>
    <script>
        let allTraineesForDropdown = [];
        let roomTypes = @json($roomTypes, JSON_UNESCAPED_UNICODE);
        let placeholder = '{!! trans('labels.select') !!}';
        let traineeSelectClassName = '.trainee-select';
        $(document).ready(function() {
            $('.information-section').hide();
            makeAllDropdownSelect2(traineeSelectClassName);
            validateForm('.trainee-hostel-checkin-form');
        });


        function initAllRepeater() {
            $('.room-assign-repeater').repeater({
                initEmpty: false,
                show: function() {
                    resetValidation(getFormElement());
                    makeAllDropdownSelect2(traineeSelectClassName);
                    reInitIcheckBox();
                    deleteDuplicateFromRepeater(
                        '.room-type-select',
                        roomTypes, false, true,
                        `{!! trans('labels.select') !!}`
                    );
                    if (!isSelectOptionsEmpty('.room-type-select')) {
                        return;
                    }
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    resetValidation(getFormElement());
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                defaultValues: {},
                isFirstItemUndeletable: true,
                repeaters: [{
                    initEmpty: false,
                    isFirstItemUndeletable: true,
                    // (Required)
                    selector: '.inner-repeater',
                    show: function() {
                        resetValidation(getFormElement());
                        makeAllDropdownSelect2(traineeSelectClassName);
                        //hideAlreadyCheckedRooms();
                        reInitIcheckBox();
                        deleteDuplicateFromRepeater(
                            '.trainee-select',
                            allTraineesForDropdown,
                            true,
                            false
                        );
                        $(this).slideDown();
                    },
                    defaultValues: {
                        'is_trainee_registered': 1
                    },
                }]
            });
        }

        function changeInformationDiv(data) {
            allTraineesForDropdown = data.traineesForDropdown;
            deleteDuplicateFromRepeater(
                '.trainee-select',
                allTraineesForDropdown,
                true,
                false
            );
            initAllRepeater();
            $('.information-section').show();
            $('input[name="room_booking_id"]').val(parseInt(data.roomBookingId));
            $('input[name="training_id"]').val(parseInt(data.trainingId));
        }

        function changeDynamicContent(element) {
            var trainingId = $(element).val();
            url = '{{ route('check-in.approved-training.json', ':id') }}';
            url = url.replace(":id", trainingId);
            $.get(url, function(data) {
                $('.dynamic-content').html(data.html);
                changeInformationDiv(data);
                reInitIcheckBox();
            });
        }
    </script>
@endpush
