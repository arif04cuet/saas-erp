    @component('tms::training.course.partial.layout.create_edit_layout', [
        'training' => $training,
        'course' => $course,
        'action' => 'edit'
    ])
    <div class="">

        {{ Form::open(['route' => ['trainings.courses.grade.update', $training->id, $course->id],
            'class' => 'form training-courses.grade-form',
            'method' => 'PUT'
        ]) }}
        @include('tms::training.course.grade.partial.form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="ft ft-check-square"></i> @lang('labels.save')
            </button>
            <a href="{{ route('trainings.courses.grade.show', [$training->id, $course->id]) }}"
               class="btn btn-warning">
                <i class="ft ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {{ Form::close() }}

    </div>
    @php
        $initialCourseGradeRepeaterData = [];
        if(old('course_grade')) {
            $initialCourseGradeRepeaterData = collect(old('course_grade'))->map(function ($oldData) {
               return [
                    'grading_mark' => $oldData['grading_mark'],
                    'grade' => $oldData['grade']
                ];
            });
        }elseif($courseGrades->count()) {
            $initialCourseGradeRepeaterData = $courseGrades->map(function ($courseGrade) {
                return [
                    'grading_mark' => $courseGrade->grading_mark,
                    'grade' => $courseGrade->grade
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
            let courseGradeRepeaterContainer = $('.course-grade-repeater'),
                initialCourseGradeRepeaterData = @json($initialCourseGradeRepeaterData, JSON_UNESCAPED_UNICODE),
                costTypes = @json($costTypes, JSON_UNESCAPED_UNICODE),
                costTypeValues = @json(array_keys($costTypes->toArray()), JSON_UNESCAPED_UNICODE),
                isInitialized = false;


            $(document).ready(function () {

                $('input,select,textarea').not('[type=submit]').jqBootstrapValidation('destroy');

                let courseGradeRepeater = courseGradeRepeaterContainer.repeater({
                    initEmpty: true,
                    show: function () {
                        let difference = true;
                        if ($('.course-grade-repeater-select').length !== 0 && isInitialized === true) {
                            difference = dropdownSync('.course-grade-repeater-select', costTypes, costTypeValues);
                            removeItemFromDropdownAfterInitialization({
                                '.course-grade-repeater-select': selectedTypes('.course-grade-repeater-select')
                            });
                        }
                        
                        initiateTasks(this, difference);

                    },
                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);

                        addItemToOtherDropdownAfterDelete(
                            {
                                '.course-grade-repeater-select': selectedTypes(
                                    '.course-grade-repeater-select',
                                    $(this)
                                )
                            },
                            costTypes,
                            costTypeValues,
                        );
                    }
                });

                if (initialCourseGradeRepeaterData.length) {
                    courseGradeRepeater.setList(initialCourseGradeRepeaterData);
                }

                isInitialized = true;

                removeItemFromDropdownAfterInitialization({
                    '.course-grade-repeater-select': initialCourseGradeRepeaterData
                });

                let validator = $('.training-cost-segmentation-form').validate({
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
                    rules: {},
                    submitHandler: function (form, event) {
                        form.submit();
                    }
                });
            });

            function dropdownSync(element, allItems, allValues) {

                let allSelectedValues = [];
                let difference = [];

                $(element).not(':last').each(function (e) {
                    //this returns only the selected value
                    let selectedValue = $(this).val();
                    if (selectedValue)
                        allSelectedValues.push(parseInt(selectedValue));
                });

                //get the difference between the two array
                difference = allValues.filter(x => !allSelectedValues.includes(x));

                let lastSelectElement = $(element).last();
                lastSelectElement.empty();

                difference.forEach(element => {
                    lastSelectElement.append('<option value="' + element + '">' + allItems[element] + '</option>')
                });

                return difference.length > 0;
            }

            function initiateTasks(instance, check=true) {
                if(check === true) {
                    $(instance).slideDown();
                }

                $(instance).find('.repeater-select').select2().on('change', function () {
                    if ($(this).hasClass('course-grade-repeater-select')) {
                        addItemToOtherDropdownAfterDelete(
                            {
                                '.course-grade-repeater-select': selectedTypes(
                                    '.course-grade-repeater-select',
                                    $(this)
                                )
                            },
                            costTypes,
                            costTypeValues
                        );
                    }
                });
            }

            function removeItemFromDropdownAfterInitialization(elementsItemsMap) {

                for (var key in elementsItemsMap) {

                    let usedItems = elementsItemsMap[key].map(({cost_type_id}) => cost_type_id);

                    $(key).each(function (iterator, element) {
                        let itemsToRemove = usedItems.filter(cost_type_id => cost_type_id !== parseInt($(element).val()));

                        itemsToRemove.forEach(function (item) {
                            $('option[value="' + item + '"]', element).remove();
                        });

                    })
                }

            }

            function selectedTypes(element, deleteElement) {

                let escape = -1;

                if (deleteElement !== undefined) {
                    escape = parseInt(deleteElement.find(element).val());
                }

                let selectedTypes = [];

                $(element).each(function (iterator, el) {
                    if (parseInt($(el).val()) !== parseInt(escape)) {
                        selectedTypes.push(
                            {
                                'cost_type_id': parseInt($(el).val())
                            }
                        );
                    }
                });

                return selectedTypes;
            }

            function addItemToOtherDropdownAfterDelete(elementsItemsMap, allItems, allValues, deleteElement) {

                let allSelectedValues = [];
                let difference = [];

                for (var key in elementsItemsMap) {

                    if (deleteElement !== undefined) {
                        deleteElement.remove();
                    }

                    allSelectedValues = elementsItemsMap[key].map(({cost_type_id}) => cost_type_id);

                    $(key).each(function (iterator, element) {

                        let currentSelectedValue = parseInt($(element).val());

                        let tempAllSelectedValues = allSelectedValues.filter(x => parseInt(x) !== currentSelectedValue);

                        difference = allValues.filter(x => !tempAllSelectedValues.includes(x));

                        $(element).empty();

                        difference.forEach(el => {
                            let option = document.createElement('option');
                            option.innerText = allItems[el];
                            option.setAttribute('value', el);
                            if (parseInt(el) === currentSelectedValue) {
                                option.setAttribute('selected', true);
                            }
                            $(element).append(option);
                        });
                    });

                }


            }
            
        </script>
    @endpush
@endcomponent

