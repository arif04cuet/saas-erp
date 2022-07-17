<div class="row">
    <div class="table-responsive">
        <table class="master table table-bordered cost-segmentation-repeater">
            <thead>
            <tr>
                <th>@lang('tms::cost_segmentation.expense_type')</th>
                <th>@lang('tms::cost_segmentation.expense_details')</th>
                <th>@lang('tms::cost_segmentation.unit_number')</th>
                <th>@lang('tms::cost_segmentation.unit_price')</th>
                <th>@lang('tms::cost_segmentation.vat')</th>
                <th>@lang('tms::cost_segmentation.tax')</th>
                <th>@lang('tms::cost_segmentation.total_amount')</th>
                <th width="1%">
                    <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer;"></i>
                </th>
            </tr>
            </thead>
            <tbody data-repeater-list="cost_segmentation">
            <tr data-repeater-item>
                <td width="10%">
                    {{ Form::select(
                        'cost_type_id',
                        $costTypes,
                        null,
                        [
                            'class' => 'form-control form-control-sm repeater-select cost-segmentation-repeater-select required',
                            'data-msg-required' => trans('labels.This field is required')
                        ]
                    ) }}
                </td>
                <td>
                    {{ Form::text(
                        'cost_detail',
                        null,
                        [
                            'class' => 'form-control form-control-sm required',
                            'data-msg-required' => trans('labels.This field is required'),
                        ]
                    ) }}
                </td>
                <td>
                    {{ Form::number(
                        'unit_number',
                        null,
                        [
                            'class' => 'form-control form-control-sm required unit_number',
                            'data-msg-required' => trans('labels.This field is required'),
                            'id' => 'unit_number',
                        ]
                    ) }}
                </td>
                <td>
                    {{ Form::number(
                        'unit_price',
                        null,
                        [
                            'class' => 'form-control form-control-sm required unit_price',
                            'data-msg-required' => trans('labels.This field is required'),
                        ]
                    ) }}
                </td>
                <td>
                    {{ Form::number(
                        'vat',
                        null,
                        [
                            'class' => 'form-control form-control-sm required vat',
                            'data-msg-required' => trans('labels.This field is required'),
                        ]
                    ) }}
                </td>
                <td>
                    {{ Form::number(
                        'tax',
                        null,
                        [
                            'class' => 'form-control form-control-sm required tax',
                            'data-msg-required' => trans('labels.This field is required'),
                        ]
                    ) }}
                </td>
                <td>
                    {{ Form::number(
                        'total_amount',
                        null,
                        [
                            'class' => 'form-control form-control-sm required total_amount',
                            'data-msg-required' => trans('labels.This field is required'),
                            'readonly' => 'true',
                            'id' => 'total_amount'
                    ]
                    ) }}
                </td>
                <td>
                    <i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                </td>
            </tr>
            @include('tms::training.cost-segmentation.partial.table-tfoot-repeater')
            </tfoot>
        </table>
    </div>
</div>