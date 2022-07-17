@extends('tms::layouts.master')
@section('title', trans('tms::tms_code_setting.title'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="la la-tag"></i> @lang('tms::tms_code_setting.form_elements.repeater_title')
                    </h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' =>  'tms.code-setting.store',
                                 'class' => 'form tms-code-setting-form']) !!}
                            @include('tms::accounts.code-setting.form.form')
                            {!! Form::close() !!}
                        </div>
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

    <!-- pickadate -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
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
    <!-- custom -->
    <script src="{{ asset('js/tms-accounts/journal-entry.js') }}"></script>
    <script>
        const placeholder = @json(trans('labels.select'));
        $(document).ready(function () {
            initAllRepeater('.tms-code-setting-repeater');
            reInitSelect2();
            validateForm('.tms-code-setting-form');
        });

        function reInitSelect2() {
            $('.select2').next('.select2-container').remove();
            $('.select2').select2({
                placeholder: placeholder
            })
        }

        function initAllRepeater(className) {
            $(className).repeater({
                initEmpty: false,
                show: function () {
                    reInitSelect2();
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                defaultValues: {},
                isFirstItemUndeletable: true,
            });
        }

    </script>
@endpush
