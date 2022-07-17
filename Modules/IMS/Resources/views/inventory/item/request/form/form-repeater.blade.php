@if(old('inventory-items'))
    @include('ims::inventory.item.request.form.old-form-repeater')
@else
    <div class="table-responsive">
        <table class="table table-bordered repeater-inventory-items">
            <thead>
            <tr class="text-center">
                <th width="50%">@lang('ims::product.title')</th>
                <th width="40%">@lang('labels.quantity')</th>
                <th width="10%"><i data-repeater-create class="la la-plus-circle text-info" id="add-repeater-row"
                                  style="cursor: pointer"></i></th>
            </tr>
            </thead>
            <tbody data-repeater-list="inventory-items">
            <tr data-repeater-item>
                <td>
                    {!! Form::select('inventory_item_category_id',
                    $items ?? [],
                    null,
                    [
                    'class' => 'form-control item-category-select required',
                    'data-msg-required' => trans('labels.This field is required'),
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
                <td><i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i></td>
            </tr>
            </tbody>
        </table>
    </div>
@endif
