@extends('tms::layouts.master')
@section('title', trans('tms::training_type.edit'))

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form"><i class="ft-user black"></i> @lang('tms::budget.edit')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0 list-circle">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' =>  ['tms-budgets.update', $budget], 'class' => 'form wizard-circle budget-name-form', 'novalidate', 'method' => 'post']) !!}
                            @method('put')
                            @include('tms::budget.edit_form')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photo-upload.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/editors/tinymce/tinymce.min.css') }} "/>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
    <script src="{{asset('theme/vendors/js/editors/tinymce/tinymce.js')}}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/core/app.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            // validateForm('.budget-name-form');
        });
    </script>
@endpush

