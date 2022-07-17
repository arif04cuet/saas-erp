@extends('hm::layouts.master')
@section('title', trans('hm::hostel_budget.section'))

@section("content")

    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ trans('hm::hostel_budget.section_edit_form_title') }}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>

            </div>
            <div class="card-content collapse show" style="">
                <div class="card-body">
                    {!! Form::model($section, ['url' =>  ['/hm/hostel-budget-section', $section->id], 'method'=>'PUT', 'class' => 'form',' novalidate']) !!}
                    @include('hm::hostel-budget-section.form.section_form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/validation/jqBootstrapValidation.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/validation/form-validation.js') }}" type="text/javascript"></script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <!-- validation -->
    <script type="text/javascript"
            src="<?php echo e(asset('theme/vendors/js/forms/validation/jquery.validate.min.js')); ?>"></script>

    <script type="text/javascript">
        let showInReport = @json($section->show_in_report);
        $(document).ready(function () {
            if (showInReport) {
                showReportDiv(true);
            } else {
                showReportDiv(false);
            }
            validateForm('.hostel-budget-section-form');
            $('input[name=show_in_report]').on('ifChanged', function () {
                console.log("Changed");
                if ($(this).is(":checked")) {
                    showReportDiv(true);
                } else {
                    showReportDiv(false);
                }
            });
        });

        function showReportDiv(toggle) {
            if (toggle) {
                $('.div-report-option').show();
            } else {
                $('.div-report-option').hide();
            }
        }

    </script>
@endpush
