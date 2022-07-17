<h4 class="form-section"><i class="la la-tag"></i> @lang('labels.new') @lang('ims::inventory.inventory_request')</h4>
<div class="row">
    <div class="col-md-12">
        @if ($errors->has('new-category'))
            <span class="invalid-feedback" style="display: block">{{ $errors->first('new-category') }}</span>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered repeater-new-category-request">
                <thead>
                <tr>
                    <th>@lang('ims::product.title') @lang('labels.name')</th>
                    <th>@lang('ims::inventory.unit')</th>
                    <th width="20%">@lang('ims::inventory.type')</th>
                    <th>@lang('labels.quantity')</th>
                    <th width="1%"><i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer"></i></th>
                </tr>
                </thead>
                <tbody data-repeater-list="new-category">
                <tr data-repeater-item>
                    <td>
                        {{ Form::text('name',
                                null,
                                [
                                    'class' => 'form-control category-unique-check required',
                                    'data-msg-required' => trans('labels.This field is required'),
                                    'data-rule-remote' => route('inventory-item-category.unique-check'),
                                    'data-msg-remote' => trans('validation.unique', ['attribute' => trans('ims::inventory.category')]),
                                ]
                            )
                        }}
                    </td>
                    <td>
                        {{ Form::text('unit',
                                null,
                                [
                                    'class' => 'form-control required',
                                    'data-msg-required' => trans('labels.This field is required'),
                                ]
                            )
                        }}
                    </td>
                    <td>
                        {!! Form::select('type',
                                [
                                    config('constants.inventory_asset_types.fixed asset') => trans('ims::inventory.fixed_asset'),
                                    config('constants.inventory_asset_types.temporary asset') => trans('ims::inventory.temporary_asset'),
                                ],
                                null,
                                [
                                    'class' => 'form-control repeater-select required',
                                    'data-msg-required' => trans('labels.This field is required'),
                                ]
                            )
                        !!}
                    </td>
                    <td>
                        {{ Form::number('quantity',
                                null,
                                [
                                    'class' => 'form-control required',
                                    'data-msg-required' => trans('labels.This field is required'),
                                    'data-rule-min' => 1,
                                    'data-msg-min'=> trans('validation.min.numeric', ['attribute' => trans('labels.quantity'), 'min' => 1]),
                                    'data-rule-number' => 'true',
                                    'data-msg-number' => trans('labels.Please enter a valid number'),
                                ]
                            )
                        }}
                    </td>
                    <td><i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
