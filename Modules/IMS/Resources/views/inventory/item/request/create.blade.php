@extends('ims::layouts.master')
@section('title', trans('ims::inventory.item.title') . ' ' . trans('labels.create'))

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <h4 class="card-title">
                        @lang('ims::inventory.item.request') @lang('labels.create')
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
                        {!! Form::open(['route' =>  ['inventory-item-request.store'], 'class' => 'form inventory-item-request-form']) !!}
                                @include('ims::inventory.item.request.form.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection



@push('page-css')

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <!-- checkbox css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

@endpush

@push('page-js')
    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script>
        let purposes = @json($purposes);
        let inventoryItemsByLocation = @json($inventoryItemsByLocation);
        changeElement('training', false);
        $(document).ready(function () {
            validateForm('.inventory-item-request-form')
        });

        let inventoryItemsRepeater = $(`.repeater-inventory-items`).repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('{{__('labels.confirm_delete')}}')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // making the first item not deletable
            isFirstItemUndeletable: true
        });

        $('.item-request-type').on('ifChecked', function () {
            let val = $(this).val();
            changeDropdown(val);
        });

        $('.inventory-location').on('change', function () {
            $('.item-category-select').empty();
            let locationId = $(this).val();
            let items = inventoryItemsByLocation[locationId];
            $.each(items, function (key, value) {
                let option = '<option>'
                $('.item-category-select').append(new Option(value, key));
            });
        });

        function changeDropdown(name) {
            if (name == purposes['training']) {
                // training
                changeElement('training', true);
            } else {
                changeElement('training', false);
            }
        }

        function changeElement(name, shouldShow = false) {
            if (shouldShow) {
                $('.' + name).show();
            } else {
                $('.' + name).hide();
            }
        }


    </script>

@endpush
