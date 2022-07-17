@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::deliver-material.title'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <h4 class="card-title">
                        @lang('labels.approve')
                    </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    @include('cafeteria::deliver-material.approval.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-css')
<!-- checkbox css -->
<link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
<link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
<!-- date-picker css -->
<link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
<link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
<link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
<!-- repeater -->
<script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

<!-- pickadate -->
<script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

<!-- Icheck and Checkbox -->
<script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
<script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

<!-- validation -->
<script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
</script>

<script>
    $(document).ready(function () {
            InitAllDropDown();
            validateForm('.deliver-approval-form');
            $('.approveBtn').prop("disabled", true);
        });

        $(`.deliver-material-items`).repeater({
            show: function () {
                $(this).slideDown();
                InitAllDropDown();

                /** added delete button in new element  */
                $(this).find('.support-td').css('display', 'none');
                $(this).find('.delBtn').css('display', '');

                /** unit all select option remove in new element  */
                $(this).find('.unit').find('option').remove();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
        });

        function InitAllDropDown() {
            $('.select2-container').remove();
            makeDropdownsSelect2();
        }

        function makeDropdownsSelect2() {
            //material and unit dropdown in purchase list
            $('.material-dropdown-select, .unit-dropdown-select').select2({
                selectOnClose: true,
            });
        }

        //date picker init
        $('input[name=deliver_date]').pickadate({
            format: 'yyyy-mm-dd',
            drops: 'up',
        });


</script>
@endpush
