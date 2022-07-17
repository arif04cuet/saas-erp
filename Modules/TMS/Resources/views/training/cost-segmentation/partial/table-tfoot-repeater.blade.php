<tfoot>
<tr>
    <td colspan="5"></td>
    <td width="10%">@lang('tms::cost_segmentation.total_cost')</td>
    <td width="12%">
        {{ Form::number(
            'total_cost',
            null,
            [
                'class' => 'form-control form-control-sm required total_cost',
                'data-msg-required' => trans('labels.This field is required'),
                'readonly' => 'true'
            ]
        ) }}
    </td>
    <td></td>
</tr>
<tr>
    <td colspan="8" style="border: none;">
        <button type="button" data-repeater-create class="master btn btn-primary btn-sm pull-right">
            <i  class="ft ft-plus-circle" style="cursor: pointer;"></i>
            @lang('labels.add')
        </button>
    </td>
</tr>
</tfoot>
