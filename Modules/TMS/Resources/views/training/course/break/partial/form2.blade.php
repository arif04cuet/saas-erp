@php
    $timeFormat = 'h:i A';
@endphp
<div class="row">
    <div class="table-responsive">
        <table class="master table table-bordered recurring-schedules-repeater">
            <thead>
            <tr>
                <th width="35%">@lang('labels.title')</th>
                <th width="14%">@lang('tms::recurring_schedule.fields.start_time.label')</th>
                <th width="14%">@lang('tms::recurring_schedule.fields.end_time.label')</th>
                <th width="14%">@lang('tms::venue.venue')</th>
                <th width="1%">
                    <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer;"></i>
                </th>
            </tr>
            </thead>

            <tbody data-repeater-list="recurring_schedules">
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
                    @if ($errors->has('title'))

                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $errors->first('title') }}</strong>
                    @endif
                </td>
                @include('tms::training.course.break.partial.common_inputs2')
                <td>
                    <div class="form-group">
                        {{ Form::select('entity_id', $venueDropDowns,
                            null,
                            [
                                'class' => 'form-control repeater-select required',
                                'data-msg-required' => trans('labels.This field is required'),
                                'placeholder' => trans('labels.select')
                            ]
                        ) }}
                    </div>
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
