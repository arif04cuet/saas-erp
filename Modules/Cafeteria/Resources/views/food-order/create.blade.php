@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::food-order.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('cafeteria::food-order.title')
                            @if ($page == 'create')
                                @lang('labels.create')
                            @else
                                @lang('labels.edit')
                            @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('cafeteria::food-order.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <!-- date-picker css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
    <!-- checkbox css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <!-- pickadate -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <!-- daterange picker -->
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>

    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>

    <script>
        $(document).ready(function() {
            @if ($page == 'edit')
                let value = $('input[name=reference_type]:checked').val();
                getBillToData(value);
            
                $('.raw-material-edit').each(function(index){
                setTimeout(function () {
                getUnitByMaterial('food-order-entries[' + index + '][raw_material_id]');
                }, index*1000);
                })
            @endif
            showGrandTotal();
            InitAllDropDown();
            validateForm('.food-order-form');
        });

        $(`.food-order-items`).repeater({
            show: function() {
                $(this).slideDown();
                InitAllDropDown();
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                    setTimeout(function() {
                        showGrandTotal();
                    }, 1000);
                }
            },
            /** making the first item not deletable */
            isFirstItemUndeletable: true
        });

        /**dropdown select*/
        function makeDropdownsSelect2() {
            $('.bill-to-dropdown, .material-dropdown-select, .unit-dropdown-select').select2({
                selectOnClose: true,
            });
        }

        function InitAllDropDown() {
            $('.select2-container').remove();
            makeDropdownsSelect2();
        }

        /**date picker init*/
        $('input[name=order_date]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            startDate: moment().startOf('hour'),
            timePicker: true,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
            }
        });
    </script>
@endpush
