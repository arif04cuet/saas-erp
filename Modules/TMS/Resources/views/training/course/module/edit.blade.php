@component('tms::training.course.partial.layout.create_edit_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'edit'
])
    <div class="">
        {{ Form::open([
            'route' => ['trainings.courses.modules.update', $training, $course],
            'class' => 'form training-course-module-form',
            'novalidate',
            'method' => 'PUT'
        ]) }}
        @include('tms::training.course.module.partial.form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="ft ft-check-square"></i> @lang('labels.save')
            </button>
            <a href="{{ route('trainings.courses.modules.show', ['training' => $training, 'course' => $course]) }}"
               class="btn btn-warning">
                <i class="ft ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {{ Form::close() }}
    </div>
    @php
        $initialModuleRepeaterData = [];
        if(old('modules')) {
            $initialModuleRepeaterData = collect(old('modules'))->map(function ($module) {
                return [
                    'title' => $module['title'],
                    'description' => $module['description'],
                    'mark' => $module['mark'],
                    'id' => $module['id']
                ];
            });
        }else if($modules->count()) {
            $initialModuleRepeaterData = $modules->map(function ($module) {
                return [
                    'title' => $module->title,
                    'description' => $module->description,
                    'mark' => $module->mark,
                    'id' => $module->id,
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
            let moduleRepeaterContainer = $('.module-repeater'),
                initialModuleRepeaterData = @json($initialModuleRepeaterData, JSON_UNESCAPED_UNICODE);

            $(document).ready(function () {
                $('input,select,textarea').not('[type=submit]').jqBootstrapValidation('destroy');

                let moduleRepeater = moduleRepeaterContainer.repeater({
                    initEmpty: true,
                    show: function () {
                        $(this).slideDown();
                    },
                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                });

                if(initialModuleRepeaterData.length) {
                    moduleRepeater.setList(initialModuleRepeaterData);
                }

                let validator = $('.training-course-module-form').validate({
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
            });
        </script>
    @endpush
@endcomponent
