@extends('hm::layouts.master')
@section('title', __('hm::checkin.search_approved_booking'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="repeat-form">
                            @lang('hm::checkin.training.title')
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
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('js/check-in/checkin.js') }}"></script>
    <script>
        $(document).ready(function () {
            let roomTypes = @json($roomTypes,JSON_UNESCAPED_UNICODE);
            let allTraineesForDropdown = @json($trainees,JSON_UNESCAPED_UNICODE);
            $('.room-assign-repeater').repeater({
                initEmpty: true,
                show: function () {
                    makeAllDropdownSelect2();
                    showAllRoomSelection();
                    deletDuplicateFromRepeater('.room-type-select', roomTypes);
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                defaultValues: {},
                repeaters: [{
                    // (Required)
                    initEmpty: true,
                    selector: '.inner-repeater',
                    show: function () {
                        makeAllDropdownSelect2();
                        hideAlreadyCheckedRooms();
                        deletDuplicateFromRepeater('.trainee-select', allTraineesForDropdown, true);
                        $(this).slideDown();
                    },
                    defaultValues: {},
                }]
            });
            // on change event of room-type-select
            $(document).on('change', '.room-type-select', function () {
                modifyRoomSelectionView($(this));
            });
        });
    </script>


@endpush
