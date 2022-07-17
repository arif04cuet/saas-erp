@component('tms::training.course.partial.layout.create_edit_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'edit'
])
    <div class="col-md-12">
        {{ Form::open(['route' => ['trainings.courses.breaks.update', $training->id, $course->id], 'method' => 'PUT', 'class' => 'training-course-recurring-schedules-form']) }}

        @include('tms::training.course.break.partial.form2')

        <div class="form-actions">
            <button type="submit" class="master btn btn-primary">
                <i class="ft-check-square"></i> {{ trans('labels.save') }}
            </button>
            <a href="{{ route('trainings.courses.breaks.show', [$training->id, $course->id]) }}"
               class="master btn btn-warning">
                <i class="ft-x"></i> {{ trans('labels.cancel') }}
            </a>
        </div>
        {{ Form::close() }}
    </div>
    @php
        $initialRecurringScheduleRepeaterData = [];
        if(old('recurring_schedules')) {
            $initialRecurringScheduleRepeaterData = collect(old('recurring_schedules'))->map(function ($recurringSchedule) {
                return [
                    'title' => $recurringSchedule['title'],
                    'start_time' => $recurringSchedule['start_time'],
                    'end_time' => $recurringSchedule['end_time'],
                    'entity_id' => $recurringSchedule['entity_id'],
                    'id' => $recurringSchedule['id']
                ];
            });
        }else if($recurringSchedules->count()) {
            $initialRecurringScheduleRepeaterData = $recurringSchedules->map(function ($recurringSchedule) {
                $entity_id = $recurringSchedule->entity_type == \Modules\TMS\Entities\TrainingCafeteria::class ? 'cafeteria_id_' . $recurringSchedule->entity_id : 'venue_id_' . $recurringSchedule->entity_id;
                return [
                    'title' => $recurringSchedule->title,
                    'start_time' => \Carbon\Carbon::parse($recurringSchedule->start_time)->format('h:i A'),
                    'end_time' => \Carbon\Carbon::parse($recurringSchedule->end_time)->format('h:i A'),
                    'entity_id' => $entity_id,
                    'id' => $recurringSchedule->id,
                ];
            });
        }
        if($errors->any())
        {
            Session::flash('error',implode('', $errors->all('<div>:message</div>')));
        }
    @endphp
    @push('page-css')
        <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.min.css') }}">
    @endpush
    @push('page-js')
        <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
        <script type="text/javascript"
                src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
        <script type="text/javascript"
                src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>
        <script type="text/javascript">
            let recurringScheduleRepeaterContainer = $('.recurring-schedules-repeater'),
                initialRecurringScheduleRepeaterData = @json($initialRecurringScheduleRepeaterData, JSON_UNESCAPED_UNICODE);

            $(document).ready(function () {
                $('input,select,textarea').not('[type=submit]').jqBootstrapValidation('destroy');

                let recurringScheduleRepeater = recurringScheduleRepeaterContainer.repeater({
                    initEmpty: true,
                    show: function () {
                        $(this).slideDown();
                        $(this).find('.repeater-select').select2();
                        console.log($(this).find('.start-time'));

                        $(this).find('.start-time,.end-time').timepicker({
                            timeFormat: 'hh:mm p',
                            interval: 15,
                            minTime: '05:00',
                            maxTime: '09:00pm',
                            startTime: '05:00am',
                            dynamic: false,
                            dropdown: true,
                            scrollbar: true
                        });

                    },
                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                });

                if (initialRecurringScheduleRepeaterData.length) {
                    recurringScheduleRepeater.setList(initialRecurringScheduleRepeaterData);
                }

                let validator = $('.training-course-recurring-schedules-form').validate({
                    ignore: ['input[type=hidden]'],
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
            });
        </script>
    @endpush
@endcomponent
