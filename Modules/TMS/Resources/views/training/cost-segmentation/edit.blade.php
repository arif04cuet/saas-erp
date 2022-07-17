@component('tms::training.partials.components.edit_layout', [
    'training' => $training
])
    <div class="">
        {{ Form::open(['route' => ['trainings.cost-segmentation.update', $training->id],
            'class' => 'form training-cost-segmentation-form',
            'method' => 'PUT'
        ]) }}
        @include('tms::training.cost-segmentation.partial.form')
        <div class="form-actions">
            <button type="submit" class="master btn btn-primary">
                <i class="ft ft-check-square"></i> @lang('labels.save')
            </button>
            <a href="{{ route('trainings.cost-segmentation.show', ['training' => $training]) }}"
               class="master btn btn-warning">
                <i class="ft ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {{ Form::close() }}

    </div>
    @php
        $initialCostSegmentationRepeaterData = [];
        if(old('cost_segmentation')) {
            $initialCostSegmentationRepeaterData = collect(old('cost_segmentation'))->map(function ($oldData) {
               return [
                    'cost_type_id' => $oldData['cost_type_id'],
                    'cost_detail' => $oldData['cost_detail'],
                    'unit_number' => $oldData['unit_number'],
                    'unit_price' => $oldData['unit_price'],
                    'vat' => $oldData['vat'],
                    'tax' => $oldData['tax'],
                    'total_amount' => $oldData['total_amount'],
                    'total_cost' => $oldData['total_cost']
                ];
            });
        }elseif($costSegmentations->count()) {
            $initialCostSegmentationRepeaterData = $costSegmentations->map(function ($costSegmentation) {
                return [
                    'cost_type_id' => $costSegmentation->type->id,
                    'cost_detail' => $costSegmentation->cost_detail,
                    'unit_number' => $costSegmentation->unit_number,
                    'unit_price' => $costSegmentation->unit_price,
                    'vat' => $costSegmentation->vat,
                    'tax' => $costSegmentation->tax,
                    'total_amount' => $costSegmentation->total_amount,
                    'total_cost' => $costSegmentation->total_cost
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
            let markAllotmentRepeaterContainer = $('.cost-segmentation-repeater'),
                initialCostSegmentationRepeaterData = @json($initialCostSegmentationRepeaterData, JSON_UNESCAPED_UNICODE),
                costTypes = @json($costTypes, JSON_UNESCAPED_UNICODE),
                costTypeValues = @json(array_keys($costTypes->toArray()), JSON_UNESCAPED_UNICODE),
                isInitialized = false;

            $(document.body).on('input', '.unit_number,.unit_price,.vat,.tax', function ()
            {
                var unit_number = parseFloat( $(this).closest('tr').find('.unit_number').val());
                var unit_price = parseFloat( $(this).closest('tr').find('.unit_price').val());
                var vat = parseFloat( $(this).closest('tr').find('.vat').val());
                var tax = parseFloat( $(this).closest('tr').find('.tax').val());
                var totalAmt = ((unit_number * unit_price) + vat + tax);
                $(this).closest('tr').find('.total_amount').val(totalAmt);
                grandTotal();
            });

            function grandTotal(){
                var total = 0;
                $('.total_amount').each(function(row, element){
                    total += +(element.value);
                });
                $(".total_cost").val(total);
            }

            $(document).ready(function () {

                $('input,select,textarea').not('[type=submit]').jqBootstrapValidation('destroy');

                let markAllotmentRepeater = markAllotmentRepeaterContainer.repeater({
                    initEmpty: true,
                    show: function () {
                        let difference = true;
                        if ($('.cost-segmentation-repeater-select').length !== 0 && isInitialized === true) {
                            difference = dropdownSync('.cost-segmentation-repeater-select', costTypes, costTypeValues);
                            removeItemFromDropdownAfterInitialization({
                                '.cost-segmentation-repeater-select': selectedTypes('.cost-segmentation-repeater-select')
                            });
                        }
                        
                        initiateTasks(this, difference);

                    },
                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);

                        addItemToOtherDropdownAfterDelete(
                            {
                                '.cost-segmentation-repeater-select': selectedTypes(
                                    '.cost-segmentation-repeater-select',
                                    $(this)
                                )
                            },
                            costTypes,
                            costTypeValues,
                        );
                    }
                });

                if (initialCostSegmentationRepeaterData.length) {
                    markAllotmentRepeater.setList(initialCostSegmentationRepeaterData);
                }

                isInitialized = true;

                removeItemFromDropdownAfterInitialization({
                    '.cost-segmentation-repeater-select': initialCostSegmentationRepeaterData
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
                    if ($(this).hasClass('cost-segmentation-repeater-select')) {
                        addItemToOtherDropdownAfterDelete(
                            {
                                '.cost-segmentation-repeater-select': selectedTypes(
                                    '.cost-segmentation-repeater-select',
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
