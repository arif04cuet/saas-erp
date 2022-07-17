@component('tms::training.course.partial.layout.create_edit_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'edit'
])
    <div class="col-md-12">
        {{ Form::open([
            'route' => ['trainings.courses.batches.update', $training, $course],
            'class' => 'form training-course-batch-form needs-validation',
            'novalidate',
            'method' => 'PUT',
        ]) }}

        @include('tms::training.course.batch.partial.form')

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="ft ft-check-square"></i> @lang('labels.save')
            </button>
            <a class="btn btn-warning"
               href="{{ route('trainings.courses.batches.show', ['training' => $training, 'course' => $course]) }}">
                <i class="ft ft-x"></i> @lang('labels.cancel')
            </a>
        </div>

        {{ Form::close() }}
    </div>
    @push('page-css')
        <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
        <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
        <style type="text/css">
            .picker {
                top: 30%;
                margin-top: 10px;
            }
        </style>
    @endpush
    @push('page-js')
        <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
        <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
        <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
        <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
        <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("input,select,textarea").not('[type=submit]').jqBootstrapValidation("destroy");

                {{--let dateFields = $('.training-course-batch-start-date, .training-course-batch-end-date');--}}
                {{--dateFields.pickadate({--}}
                    {{--selectYears: true,--}}
                    {{--selectMonths: true,--}}
                    {{--min: new Date("{{ Carbon\Carbon::parse($training->start_date)->format('j F, Y') }}"),--}}
                    {{--max: new Date("{{ Carbon\Carbon::parse($training->end_date)->format('j F, Y') }}"),--}}

                {{--});--}}


                let from_$input = $('.training-course-batch-start-date').pickadate
                    ({
                        selectYears: 2,
                        selectMonths: true
                    }),
                    from_picker = from_$input.pickadate('picker')

                let to_$input = $('.training-course-batch-end-date').pickadate
                    ({
                        selectYears: 2,
                        selectMonths: true
                    }),
                    to_picker = to_$input.pickadate('picker')

                if ( from_picker.get('value') ) {
                    to_picker.set('min', from_picker.get('select'))
                }
                if ( to_picker.get('value') ) {
                    from_picker.set('max', to_picker.get('select'))
                }

                from_picker.on('set', function(event) {
                    if ( event.select ) {
                        to_picker.set('min', from_picker.get('select'))
                    }
                    else if ( 'clear' in event ) {
                        to_picker.set('min', false)
                    }
                })
                to_picker.on('set', function(event) {
                    if ( event.select ) {
                        from_picker.set('max', to_picker.get('select'))
                    }
                    else if ( 'clear' in event ) {
                        from_picker.set('max', false)
                    }
                })

                let trainingCourseBatchForm = $('.training-course-batch-form'),
                    getType = function (item) {
                        switch (item) {
                            case 'title':
                                return 'text';
                            case 'start_date':
                                return 'text';
                            case 'end_date':
                                return 'text';
                            case 'no_of_trainees':
                                return 'number';
                            default:
                                return 'text';
                        }
                    };

                jQuery.validator.addMethod(
                    "if-exists",
                    function (value, element, params) {
                        let dependencies = params.split(","),
                            index = $(element).attr('data-index'),
                            type = $(element).attr('data-type'),
                            isValid = true;
                        dependencies.forEach(function (item) {
                            let titleField = $("input[type=" + getType(item) + "][name='" + item + "[" + type + "][" + index + "]']");
                            isValid *= !(titleField.val() && !(value));
                        });
                        return isValid;
                    },
                    "{{ trans('labels.This field is required') }}"
                );

                trainingCourseBatchForm.validate({
                    ignore: 'input[type=hidden]',
                    errorClass: 'danger',
                    successClass: 'success',
                    highlight: function (element, errorClass) {
                        $(element).removeClass(errorClass);
                    },
                    unhighlight: function (element, errorClass) {
                        $(element).removeClass(errorClass);
                    },
                    errorPlacement: function (error, element) {
                        error.insertAfter(element);
                    },
                    rules: {},
                    submitHandler: function (form, event) {
                        form.submit();
                    }
                });



            });

        </script>
    @endpush
@endcomponent

