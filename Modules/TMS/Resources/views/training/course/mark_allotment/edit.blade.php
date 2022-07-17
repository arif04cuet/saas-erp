@component('tms::training.course.partial.layout.create_edit_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'edit'
])
    <div class="">

        {{ Form::open([
            'route' => ['trainings.courses.marks.allotments.update', $training, $course],
            'class' => 'form training-course-mark-allotment-form',
            'novalidate',
            'method' => 'PUT'
        ]) }}
        @include('tms::training.course.mark_allotment.partial.form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="ft ft-check-square"></i> @lang('labels.save')
            </button>
            <a href="{{ route('trainings.courses.marks.allotments.show', ['training' => $training, 'course' => $course]) }}"
               class="btn btn-warning">
                <i class="ft ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {{ Form::close() }}

    </div>
    @php
        $initialMarkAllotmentRepeaterData = [];
        if(old('mark_allotment')) {
            $initialMarkAllotmentRepeaterData = collect(old('mark_allotment'))->map(function ($oldData) {
               return [
                    'training_course_mark_allotment_type_id' => $oldData['training_course_mark_allotment_type_id'],
                    'mark' => $oldData['mark']
                ];
            });
        }elseif($markAllotments->count()) {
            $initialMarkAllotmentRepeaterData = $markAllotments->map(function ($markAllotment) {
                return [
                    'training_course_mark_allotment_type_id' => $markAllotment->training_course_mark_allotment_type_id,
                    'mark' => $markAllotment->mark
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
            let markAllotmentRepeaterContainer = $('.mark-allotment-repeater'),
                initialMarkAllotmentRepeaterData = @json($initialMarkAllotmentRepeaterData, JSON_UNESCAPED_UNICODE),
                markAllotmentTypes = @json($markAllotmentTypes, JSON_UNESCAPED_UNICODE),
                markAllotmentTypeValues = @json(array_keys($markAllotmentTypes->toArray()), JSON_UNESCAPED_UNICODE),
                isInitialized = false;

            $(document).ready(function () {
                $('input,select,textarea').not('[type=submit]').jqBootstrapValidation('destroy');

                let markAllotmentRepeater = markAllotmentRepeaterContainer.repeater({
                    initEmpty: true,
                    show: function () {
                        let difference = true;
                        if ($('.mark-allotment-repeater-select').length !== 0 && isInitialized === true) {
                            difference = dropdownSync('.mark-allotment-repeater-select', markAllotmentTypes, markAllotmentTypeValues);
                            removeItemFromDropdownAfterInitialization({
                                '.mark-allotment-repeater-select': selectedTypes('.mark-allotment-repeater-select')
                            });
                        }
                        
                        initiateTasks(this, difference);

                    },
                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);

                        addItemToOtherDropdownAfterDelete(
                            {
                                '.mark-allotment-repeater-select': selectedTypes(
                                    '.mark-allotment-repeater-select',
                                    $(this)
                                )
                            },
                            markAllotmentTypes,
                            markAllotmentTypeValues,
                        );
                    }
                });

                if (initialMarkAllotmentRepeaterData.length) {
                    markAllotmentRepeater.setList(initialMarkAllotmentRepeaterData);
                }

                isInitialized = true;

                removeItemFromDropdownAfterInitialization({
                    '.mark-allotment-repeater-select': initialMarkAllotmentRepeaterData
                });

                let validator = $('.training-course-mark-allotment-form').validate({
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
                    if ($(this).hasClass('mark-allotment-repeater-select')) {
                        addItemToOtherDropdownAfterDelete(
                            {
                                '.mark-allotment-repeater-select': selectedTypes(
                                    '.mark-allotment-repeater-select',
                                    $(this)
                                )
                            },
                            markAllotmentTypes,
                            markAllotmentTypeValues
                        );
                    }
                });
            }

            function removeItemFromDropdownAfterInitialization(elementsItemsMap) {

                for (var key in elementsItemsMap) {

                    let usedItems = elementsItemsMap[key].map(({training_course_mark_allotment_type_id}) => training_course_mark_allotment_type_id);

                    $(key).each(function (iterator, element) {
                        let itemsToRemove = usedItems.filter(training_course_mark_allotment_type_id => training_course_mark_allotment_type_id !== parseInt($(element).val()));

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
                                'training_course_mark_allotment_type_id': parseInt($(el).val())
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

                    allSelectedValues = elementsItemsMap[key].map(({training_course_mark_allotment_type_id}) => training_course_mark_allotment_type_id);

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
