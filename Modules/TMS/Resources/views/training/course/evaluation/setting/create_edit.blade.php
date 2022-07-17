@extends('tms::layouts.master')

@section('title', trans('tms::course_evaluation.settings.title') . ' - ' . trans('labels.edit'))

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @lang('tms::course_evaluation.settings.title') - @lang('labels.edit')
                    </h4>
                    <a href="" class="heading-elements-toggle">
                        <i class="la la-ellipsis-h font-medium-3"></i>
                    </a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0 list-circle">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content show collapse">
                    <div class="card-body">
                        {{ Form::open([
                            'route' => ['trainings.courses.evaluations.settings.update', $training, $course],
                            'method' => 'PUT',
                            'novalidate',
                            'class' => 'course-evaluation-setting-form',
                        ]) }}
                        @include(
                            'tms::training.course.evaluation.setting.partial.form'
                        )
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
@endpush

@push('page-js')
    <script type="text/javascript">
        $(document).ready(function() {
            let courseEvaluationSettingStatus = $('.course-evaluation-setting-status'),
                courseEvaluationSettingStartDate = $('.course-evaluation-setting-start-date'),
                courseEvaluationSettingEndDate = $('.course-evaluation-setting-end-date'),
                form = $('.course-evaluation-setting-form');

            courseEvaluationSettingStatus.iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });

            courseEvaluationSettingStartDate.daterangepicker({
                minDate: new Date(Date.parse("{{ $trainingStartDate }}")),
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            // courseEvaluationSettingEndDate.daterangepicker({
            //     minDate: new Date(Date.parse("{{ $courseStartDate }}")),
            //     singleDatePicker: true,
            //     showDropdowns: true,
            //     locale: {
            //         format: 'DD/MM/YYYY'
            //     }
            // });
            courseEvaluationSettingEndDate.daterangepicker({
                minDate: new Date(Date.parse("{{ $trainingEndDate }}")),
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            jQuery.validator.addMethod(
                'required-if',
                function(value, element, params) {
                    params = (params !== "") ? params : "status";
                    let target = $('input[name=' + params + ']');

                    if ((target).is(':checked')) {
                        return (value !== null && value !== "");
                    }

                    return true;

                },
                'This Field is Required!'
            );
            let validator = form.validate({
                ignore: 'input[type=hidden]',
                errorClass: 'danger',
                successClass: 'success',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function(error, element) {
                    if (element.attr('type') == 'radio') {
                        error.insertBefore(element.parents().siblings('.radio-error'));
                    } else if (element[0].tagName == "SELECT") {
                        error.insertAfter(element.siblings('.select2-container'));
                    } else if (element.attr('id') == 'ckeditor') {
                        error.insertAfter(element.siblings('#cke_ckeditor'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                rule: {},
                submitHandler: function(form, event) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
