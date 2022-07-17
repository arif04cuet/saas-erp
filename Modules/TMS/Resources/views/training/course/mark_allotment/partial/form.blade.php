<div class="row">
    <div class="table-responsive">
        <table class="master table table-bordered mark-allotment-repeater">
            <thead>
            <tr>
                <th width="65%">Title</th>
                <th width="34%">Mark</th>
                <th width="1%">
                    <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer;"></i>
                </th>
            </tr>
            </thead>
            <tbody data-repeater-list="mark_allotment">
            <tr data-repeater-item>
                <td>
                    {{ Form::select(
                        'training_course_mark_allotment_type_id',
                        $markAllotmentTypes,
                        null,
                        [
                            'class' => 'form-control repeater-select mark-allotment-repeater-select required',
                            'data-msg-required' => trans('labels.This field is required')
                        ]
                    ) }}
                </td>
                <td>
                    {{ Form::number(
                        'mark',
                        null,
                        [
                            'class' => 'form-control required',
                            'data-msg-required' => trans('labels.This field is required'),
                            'data-rule-number' => true,
                            'data-msg-number' => trans('labels.Please enter a valid number'),
                            'data-rule-min' => 1,
                            'data-msg-min' => trans('labels.Must be greater than or equal to', ['attribute' => trans('labels.digits.1')]),
                            'data-rule-max' => 1000,
                            'data-msg-max' => trans('labels.Must be less than or equal to 1000')
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
