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
                            {!! Form::open(['url'=>route('appraisals.store'), 'class' => 'wizard-circle appraisal-steps', 'enctype' => 'multipart/form-data']) !!}
                            {{--Step 1 Reporting Officer Bio Data--}}
                            @include('hrm::appraisal.partials.form.class.first.step-1')

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
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
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
                finish: '{!! trans('labels.save') !!}',
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
    <script>
        $( document ).ready(function() {
            $('.significant-trainings-local-repeater').repeater({
                initEmpty: true,
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            $('.significant-trainings-international-repeater').repeater({
                initEmpty: true,
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            $('select').select2();

            jQuery.validator.addMethod(
                "greaterThan",
                function(value, elements, params) {
                    let comparingDate = params === '#jobDurationStartDate' ? $(params).val() : params;
                    return (Date.parse(value) - Date.parse(comparingDate)) > (30000*24*60*60);
                },
                '{{ trans('labels.greaterThan', ['name' => trans('hrm::appraisal.start_date')]) }}'
            );

            jQuery.validator.addMethod(
                "year-length",
                function (value, element, params) {

                    let validLength = parseInt(params);

                    if(value.length === 0) {
                        return true;
                    }

                    return value.length === validLength && parseInt(value) > 0;
                },
                'Year should be a 4 digit number'
            );

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
                        if((element.hasClass('reporting_officer_marital_status')) || (element.hasClass('reporting_officer_no_of_children'))) {
                            error.insertAfter(element.parents().siblings('.radio-error'));
                        }else {
                            error.insertBefore($('div').find("[data-radio-field-name='" + element.attr('name') + "']"));
                        }

                    } else if (element[0].tagName === "SELECT") {

                        error.insertAfter(element.siblings('.select2-container'));

                    } else if (element.attr('id') === 'jobDurationStartDate' || element.attr('id') === 'jobDurationEndDate') {

                        error.insertAfter(element.parents('.input-group'));

                    }else if(element.attr('type') === 'text') {
                        if(element.hasClass('educational_qualifications')) {
                            console.log(element);
                            error.insertAfter(element);
                        }else {
                            error.insertAfter(element);
                        }
                    }else {

                        error.insertAfter(element);
                    }
                },
                rules: {},
            });


            $('#jobDurationStartDate').pickadate({
                max: new Date(),
                selectYears: 70,
                selectMonths: true
            });

            $('#jobDurationEndDate').pickadate({
                max: new Date(),
                selectYears: 70,
                selectMonths: true
            });
        });

        $(document).ready(function() {
            let publicationTotal = $('input[name*=reporting_officer_publications_qualification]');
            publicationTotal.on('keyup', function () {
                let counter = [1, 2, 3, 4, 5],
                    total = 0,
                    totalThisYear = 0;

                counter.forEach(function (item) {
                    let totalTarget = 'input[name="reporting_officer_publications_qualification[' + item + '][total]"]',
                        totalThisYearTarget = 'input[name="reporting_officer_publications_qualification[' + item + '][total_this_year]"]';

                    if(!isNaN(parseInt($(totalTarget).val()))) {
                        total += parseInt($(totalTarget).val());
                    }

                    if($(totalThisYearTarget).val() !== undefined && $(totalThisYearTarget).val() !== "") {

                        let totalThisYearSplit = $(totalThisYearTarget).val().split(",");
                        totalThisYearSplit = totalThisYearSplit.filter(function(entry) { return entry.trim() !== ''; });
                        totalThisYear += parseInt(totalThisYearSplit.length);
                    }
                });

                $('input[name="reporting_officer_publications_qualification[grand][total]"]').val(total);
                $('input[name="reporting_officer_publications_qualification[grand][total_this_year]"]').val(totalThisYear);

            });
        });
    </script>
    <script src="{{ asset('theme/js/scripts/forms/select/form-select2.js') }}"></script>
@endpush
