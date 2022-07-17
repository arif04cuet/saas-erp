<h4 class="form-section"><i class="la la-tag"></i>@lang('ims::inventory.inventory_request')</h4>
<div class="row">
    <div class="col-md-12">

        @if ($errors->has('category'))
            <div class="alert alert-danger" style="display: block">{{ $errors->first('category') }}</div>
        @endif
        @if (!$errors->isEmpty())
            @foreach($errors->all() as $e)
                <div class="alert bg-danger white" style="display: block">{{ $e }}</div>
            @endforeach
        @endif
        <div class="table-responsive">
            <table class="table table-bordered repeater-category-request">
                <thead>
                <tr class="text-center">
                    <th width="45%">@lang('ims::product.title')</th>
                    <th width="10%">@lang('labels.quantity')</th>
                    <th width="40%">
                        @lang('ims::inventory.item.select_item')
                        (@lang('ims::inventory.item.for_fixed_assets'))
                    </th>
                    <th width="1%"><i data-repeater-create class="la la-plus-circle text-info" id="add-repeater-row"
                                      style="cursor: pointer"></i></th>
                </tr>
                </thead>
                <tbody data-repeater-list="category">
                <tr data-repeater-item>
                    <td>
                        {!! Form::select('category_id',
                                $categories['items'],
                                null,
                                [
                                    'class' => 'form-control repeater-select item-category-select required',
                                    'data-msg-required' => trans('labels.This field is required'),
                                    'onchange' => 'loadItems(this)',
                                ]
                            )
                        !!}
                    </td>
                    <td>
                        {!! Form::number('quantity', null, [
                                'class' => 'form-control required',
                                'data-msg-required' => trans('labels.This field is required'),
                                'data-rule-min' => 1,
                                'data-msg-min'=> trans('validation.min.numeric', ['attribute' => trans('labels.quantity'), 'min' => 1]),
                                'data-rule-number' => 'true',
                                'data-msg-number' => trans('labels.Please enter a valid number'),
                            ])
                        !!}
                    </td>
                    <td>
                        {!! Form::select('items', [], null, [
                                'class' => 'form-control unique-item-selector select2',
                                'multiple', 'onchange' => 'itemCount(this)'
                            ])
                        !!}
                    </td>
                    <td><i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('page-js')
    <script>
        let inventoryItems = @json($categories['inventory_items']);

        function loadItems(categoryObject) {
            let categoryId = categoryObject.options[categoryObject.selectedIndex].value;
            let objectName = categoryObject.name;
            let categorySelector = $('select[name="' + objectName + '"]');
            let repeaterIndex = objectName.match(/\d+/).toString();

            if (categorySelector.val() !== "") {
                $('.item-category-select').each(function () {
                    if (!isNaN($(this).val()) && objectName != $(this).attr('name') && categorySelector.val() == $(this).val()) {
                        alert("{{__('ims::inventory.duplicate_select_error')}}");
                        categorySelector.val('');
                        categorySelector.focus();
                        categoryId = "";
                    }
                });
            }

            var itemSelectorName = 'category[' + repeaterIndex + '][items][]';
            var quantityName = 'category[' + repeaterIndex + '][quantity]';
            let quantityObject = $('input[name="' + quantityName + '"]');
            let itemSelectorObject = $('select[name="' + itemSelectorName + '"]');
            let itemData = [];

            $.each(inventoryItems[categoryId], function (index, value) {
                itemData.push({
                    id: value['id'],
                    text: value['title_id']
                });
            });

            if (itemData.length) {
                itemSelectorObject.empty().select2({
                    data: itemData,
                    placeholder: "{{__('ims::inventory.item.select_item')}}",
                    disabled: false
                });
                quantityObject.attr('readonly', 'readonly');
            } else {
                itemSelectorObject.empty().select2({
                    disabled: true,
                });
                quantityObject.removeAttr('readonly');
            }
        }

        function itemCount(itemSelector) {
            let repeaterIndex = itemSelector.name.match(/\d+/).toString();
            var quantityName = 'category[' + repeaterIndex + '][quantity]';
            let quantityObject = $('input[name="' + quantityName + '"]');
            var itemSelectorName = 'category[' + repeaterIndex + '][items][]';
            let itemSelectorObject = $('select[name="' + itemSelectorName + '"]');

            quantityObject.val(itemSelectorObject.select2('data').length);

        }
    </script>
@endpush

