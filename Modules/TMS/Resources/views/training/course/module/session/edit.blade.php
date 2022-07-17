@component('tms::training.course.module.session.partial.layout.create_edit_layout', [
    'training' => $training,
    'course' => $course,
    'module' => $module
])
    <div class="col-md-12">
        {{ Form::open([
            'route' => ['trainings.courses.modules.sessions.update', $training, $course, $module],
            'class' => 'form training-course-module-session-form',
            'novalidate',
            'method' => 'PUT'
        ]) }}
        @include('tms::training.course.module.session.partial.form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="ft ft-check-square"></i> @lang('labels.save')
            </button>
            <a href="{{ route('trainings.courses.modules.sessions.show', ['training' => $training, 'course' => $course, 'module' => $module]) }}"
               class="btn btn-warning">
                <i class="ft ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {{ Form::close() }}
    </div>

    @php
        $initialSessionRepeaterData = [];
        if(old('sessions')) {
            $initialSessionRepeaterData = collect(old('sessions'))->map(function ($session) {
                return [
                    'title' => $session['title'],
                    'description' => $session['description'],
                    'session_length' => $session['session_length'],
                    'mark' => $session['mark'],
                    'speaker_expire_timeline' => $session['speaker_expire_timeline'],
                    'training_course_resource_id' => $session['training_course_resource_id'] ?? null,
                    'id' => $session['id']
                ];
            });
        }else if($sessions->count()) {
            $initialSessionRepeaterData = $sessions->map(function ($session) {
                return [
                    'title' => $session->title,
                    'description' => $session->description,
                    'session_length' => $session->session_length,
                    'mark' => $session->mark,
                    'speaker_expire_timeline' =>
                        $session->training_course_resource_id == null ? : $session->speaker_expire_timeline,
                    'training_course_resource_id' => $session->training_course_resource_id ?? null,
                    'id' => $session->id
                ];
            });
        }
    @endphp


    @push('page-js')
        <script type="text/javascript"
                src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
        <script type="text/javascript"
                src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

        <script type="text/javascript">
            let sessionRepeaterContainer = $('.module-session-repeater'),
                initialSessionRepeaterData = @json($initialSessionRepeaterData, JSON_UNESCAPED_UNICODE);

            $(document).ready(function () {
                $('input,select,textarea').not('[type=submit]').jqBootstrapValidation('destroy');

                let moduleRepeater = sessionRepeaterContainer.repeater({
                    initEmpty: true,
                    show: function () {
                        $(this).slideDown();
                        $(this).find('.repeater-select').select2();
                    },
                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                });

                if(initialSessionRepeaterData.length) {
                    moduleRepeater.setList(initialSessionRepeaterData);
                }

                let validator = $('.training-course-module-session-form').validate({
                    ignore: [],
                    errorClass: 'danger',
                    successClass: 'success',
                    highlight: function (element, errorClass) {
                        $(element).removeClass(errorClass);
                    },
                    unhighlight: function (element, errorClass) {
                        $(element).removeClass(errorClass);
                    },
                    errorPlacement: function (error, element) {
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
                    submitHandler: function (form, event) {
                        form.submit();
                    }
                });

                jQuery.validator.addMethod(
                    'max-number',
                    function (value, element, params) {
                        let numbers = {
                            '0' : 0,
                            '1' : 1,
                            '2' : 2,
                            '3' : 3,
                            '4' : 4,
                            '5' : 5,
                            '6' : 6,
                            '7' : 7,
                            '8' : 8,
                            '9' : 9,
                            '\u09E6' : 0,
                            '\u09E7' : 1,
                            '\u09E8' : 2,
                            '\u09E9' : 3,
                            '\u09EA' : 4,
                            '\u09EB' : 5,
                            '\u09EC' : 6,
                            '\u09ED' : 7,
                            '\u09EE' : 8,
                            '\u09EF' : 9,
                        };

                        let maxNumber = '';
                        if(value.length > 0) {
                            for(var i=0; i< value.length; i++) {
                                if(value[i] !== '.') {
                                    maxNumber += numbers[value[i]];
                                }else {
                                    maxNumber += value[i];
                                }
                            }

                            if(isNaN(Number(maxNumber))) {
                                return false;
                            }
                            if(maxNumber[maxNumber.length-1] === '.') {
                                return false;
                            }

                            maxNumber = parseFloat(maxNumber);
                            return (maxNumber <= 1000.00);
                        }

                        return true;
                    },
                    "{{ trans('labels.session number') }}"
                );
            });
        </script>
    @endpush
@endcomponent
