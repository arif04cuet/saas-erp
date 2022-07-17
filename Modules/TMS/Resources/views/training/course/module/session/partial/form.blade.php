<div class="row">
    <div class="table-responsive">
        <table class="table table-bordered module-session-repeater">
            <thead>
            <tr>
                <th class="table-th-top" width="25%">@lang('labels.title')</th>
                <th class="table-th-top" width="30%">@lang('labels.description')</th>
                <th class="table-th-top" width="10%">@lang('labels.number')</th>
                <th class="table-th-top" width="10%">@lang('tms::session.length')</th>
                <th class="table-th-top" width="10%">@lang('tms::session.expire_time')</th>
                <th class="table-th-top" width="25%">@lang('tms::speaker.title')</th>
                <th class="table-th-top" width="1%">
                    <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer;"></i>
                </th>
            </tr>
            </thead>
            <tbody data-repeater-list="sessions">
            <tr data-repeater-item>
                {{ Form::hidden('id', null) }}
                <td>
                    {{ Form::text(
                        'title',
                        null,
                        [
                            'class' => 'form-control required',
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
                            'class' => 'form-control',
                            'rows' => 1,
                            'data-rule-maxlength' => 500,
                            'data-msg-maxlength' => trans('labels.At most 500 characters')
                        ]
                    ) }}
                </td>
                <td>
                    {{ Form::text(
                        'mark',
                        null,
                        [
                            'class' => 'form-control',
                            'data-rule-regex-number' => '^(' . trans('tms::trainee.registration.validations.experience') . ')+$',
                            'data-rule-max-number' => "",
                        ]
                    ) }}
                </td>
                <td>
                    {{Form::text('session_length', null, [
                    'class' => 'form-control',
                    'maxlength' => '3',
                    'required',
                    'data-msg-required' => trans('labels.This field is required')
                    ]
                    )}}
                </td>
                <td>
                    {{ Form::number(
                        'speaker_expire_timeline',
                        null,
                        [
                            'class' => 'form-control',
                            'min' => '5',
                            'data-rule-min' => '5',
                            'data-msg-min' => trans('labels.Must be greater than or equal to', ['attribute' => trans('labels.digits.5')]),
                            'data-rule-max' => '720',
                            'data-msg-max' => trans('labels.Must be less than or equal to', ['attribute' => \App\Utilities\EnToBnNumberConverter::en2bn(720)]),
                        ]
                    ) }}
                </td>
                <td>
                    {{ Form::select(
                        'training_course_resource_id',
                        $resources,
                        null,
                        [
                            'class' => 'form-control repeater-select',
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
