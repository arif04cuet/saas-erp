<div class="row">
    <div class="table-responsive">
        <table class="master table table-bordered course-grade-repeater">
            <thead>
            <tr>
                <th>@lang('tms::course_grade.grading_mark')</th>
                <th>@lang('tms::course_grade.grading')</th>
                <th width="1%">
                    <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer;"></i>
                </th>
            </tr>
            </thead>
            <tbody data-repeater-list="course_grade">
            <tr data-repeater-item>
                <td width="50%">
                    {{ Form::text(
                        'grading_mark',
                        null,
                        [
                            'class' => 'form-control form-control-sm grading-mark required',
                            'data-msg-required' => trans('labels.This field is required'),
                            'placeholder' => '80-100'
                        ]
                    ) }}
                </td>
                <td>
                    {{ Form::text(
                        'grade',
                        null,
                        [
                            'class' => 'form-control form-control-sm grade required',
                            'data-msg-required' => trans('labels.This field is required'),
                            'placeholder' => 'A+'
                        ]
                    ) }}
                </td>
                
                <td>
                    <i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                </td>
            </tr>
            @include('tms::training.course.grade.partial.table-tfoot-repeater')
            </tfoot>
        </table>
    </div>
</div>