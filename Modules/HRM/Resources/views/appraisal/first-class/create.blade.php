@extends('hrm::layouts.master')

@section('title', trans('hrm::appraisal.title'). ' ' . trans('labels.form'))

@push('page-css')


@endpush

@section('content')
    <!-- Striped row layout section start -->
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="striped-row-layout-basic">@lang('hrm::appraisal.first_class') @lang('hrm::appraisal.title') @lang('labels.form')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                             {!! Form::open(['class' => 'wizard-circle appraisal-steps', 'enctype' => 'multipart/form-data']) !!}
                                    {{--Step 1 Reporting Officer Bio Data--}}
                                    @include('hrm::appraisal.first-class.partials.form.bio_data')
                                    {{-- Step 2 Reporting Officer Medical Report --}}
                                    @include('hrm::appraisal.first-class.partials.form.health_report')
                                    {{--Step 3 Reporting Officer Work Description--}}
                                    @include('hrm::appraisal.first-class.partials.form.work_description')
                                    {{--Step 4 Appraisal Standard Content--}}
                                    @include('hrm::appraisal.first-class.partials.form.standard')
                                    {{--Step 5 Officer Chart--}}
                                    @include('hrm::appraisal.first-class.partials.form.chart')
                                    {{--Step 6 Reporter Officer Advice--}}
                                    @include('hrm::appraisal.first-class.partials.form.advice')
                                    {{--Step 7 Signer Officer Comments--}}
                                    @include('hrm::appraisal.first-class.partials.form.signer_comments')
                                    {{--Step 8 DG Final Comment--}}
                                    @include('hrm::appraisal.first-class.partials.form.dg_comment')
                             {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photo-upload.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('theme/js/core/app.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/scripts/tables/components/table-components.js') }}"></script>
    <script>
        let appraisalForm = '.appraisal-steps';
        var form = $(appraisalForm).show();

        $(appraisalForm).steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: '{!! trans('labels.submit') !!}',
                next: '{!! trans('labels.next') !!}',
                previous: '{!! trans('labels.previous') !!}',
            },
            onStepChanging: function (event, currentIndex, newIndex)
            {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex)
                {
                    return true;
                }
                // Forbid next action on "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age-2").val()) < 18)
                {
                    return false;
                }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex)
                {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
                $('.appraisal-steps').submit();
            }
        });
    </script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    {{--<script>
        $( document ).ready(function() {
            $('.appraisal-steps').validate({
                ignore: 'input[type=hidden]', // ignore hidden fields
                errorClass: 'danger',
                successClass: 'success',
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function (error, element) {
                    if (element.attr('type') === 'radio') {
                        error.insertAfter(element.parents().siblings('.radio-error'));
                    } else if (element[0].tagName === "SELECT") {
                        error.insertAfter(element.siblings('.select2-container'));
                    } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {
                        error.insertAfter(element.parents('.input-group'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    end_date: {
                        greaterThanOrEqual: '#start_date'
                    },
                    first_name: {
                        maxlength: 50
                    },
                    // 'room-show': {
                    //     CheckRoomValidation: 0
                    // },
                    contact: {
                        minlength: 11,
                        maxlength: 11
                    },
                    address: {
                        maxlength: 300
                    },
                    nid: {
                        minlength: 10,
                        maxlength: 10
                    },
                },
            });
            // datepicker
            /*$('#start_date').pickadate({
                min: new Date()
            });

            $('#end_date').pickadate({
                min: +1,
            });*/

            $('#start_date, #end_date').pickadate();
        });
    </script>--}}

    <script src="{{ asset('theme/js/scripts/forms/select/form-select2.js') }}"></script>
@endpush