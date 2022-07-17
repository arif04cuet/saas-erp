<div class="row">
    <div class="table-responsive">
        <table class="master table table-bordered module-repeater">
            <thead>
            <tr>
                <th width="35%">@lang('tms::module.module_heading')</th>
                <th width="50%">@lang('labels.description')</th>
                <th width="14%">@lang('labels.number')</th>
                <th width="1%">
                    <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer;"></i>
                </th>
            </tr>
            </thead>
            <tbody data-repeater-list="modules">
            <tr data-repeater-item>
                {{ Form::hidden('id', null) }}
                <td>
                    {{ Form::text(
                        'title',
                        null,
                        [
                            'class' => 'form-control form-control-sm required',
                            'data-msg-required' => trans('labels.This field is required'),
                            'data-rule-maxlength' => 500,
                            'data-msg-maxlength' => trans('labels.At most 500 characters')
                        ]
                    ) }}
                </td>
                <td>
                    {{ Form::textarea(
                        'description',
                        null,
                        [
                            'class' => 'form-control form-control-sm',
                            'rows' => 1,
                            'data-rule-maxlength' => 500,
                            'data-msg-maxlength' => trans('labels.At most 500 characters')
                        ]
                    ) }}
                </td>
                <td>
                    {{ Form::number(
                        'mark',
                        null,
                        [
                            'class' => 'form-control form-control-sm',
                        ]
                    ) }}
                </td>
                <td>
                    <i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                </td>
            </tr>
            </tbody>
            @include('tms::training.course.partial.table-tfoot-repeater')
        </table>
    </div>
</div>
