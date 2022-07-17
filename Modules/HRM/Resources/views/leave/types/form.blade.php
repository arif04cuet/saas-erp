{!! Form::open(['route' =>  ['leave-types.update', $type->id], 'class' => 'form leave-type-form', 'novalidate', 'method' => 'put']) !!}

<h4 class="form-section">
    <i class="ft-grid"></i>
    @lang('hrm::leave.leave_type') @lang('labels.form')
</h4>

<div class="row">
    <!-- Leave Type Information -->
    <div class="col-md-12">
        <table class="table table-borderless table-striped">
            <tr style="width: 30%">
                <th>@lang('labels.name')</th>
                <td>{{__('hrm::leave.' . $type->name)}}</td>
            </tr>
            <tr>
                <th>@lang('labels.description')</th>
                <td>{{__('hrm::leave.' . $type->description)}}</td>
            </tr>
        </table>
    </div>
</div>

@if($type->purposes->count())
    <!-- Leave Type Amount and Max Days -->
    <h4 class="form-section"><i class="ft ft-list"></i>@lang('hrm::leave.purpose')</h4>
    @foreach($type->purposes as $leavePurpose)
        @php
            $amountName = 'purpose_data['.$leavePurpose->id.'][amount]';
            $maxAmountName = 'purpose_data['.$leavePurpose->id.'][maximum_allowed_days]';
        @endphp
        <div class="row">
            <div class="col-md">
                {{ trans("hrm::leave.$leavePurpose->name") }}
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label class="form-label">@lang('labels.total') @lang('labels.days')</label>
                    {!! Form::number($amountName, $page == 'create' ? old('amount') : $leavePurpose->amount ,
                                [
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'data-rule-min' => 0,
                                    'data-msg-min' => __('validation.gte.numeric',
                                    ['attribute' => __('hrm::job-circular.recruitment_exam.total'), 'value' => 0]),
                                    'data-rule-maxlength' => 3,
                                    'data-msg-maxlength'=> trans('labels.At most 3 characters'),
                                ])
                            !!}
                </div>
            </div>

            <div class="col-md">
                <div class="form-group">
                    <label class="form-label">@lang('hrm::leave.max_allowed_days')</label>

                    {!! Form::number($maxAmountName, $page == 'create' ? old('maximum_allowed_days') : $leavePurpose->maximum_allowed_days ,
                           [
                               'class' => 'form-control',
                               'autocomplete' => 'off',
                               'data-rule-min' => 0,
                               'data-msg-min' => __('validation.gte.numeric',
                               ['attribute' => __('hrm::job-circular.recruitment_exam.total'), 'value' => 0]),
                               'data-rule-maxlength' => 3,
                               'data-msg-maxlength'=> trans('labels.At most 3 characters'),
                           ])
                       !!}
                </div>
            </div>
        </div>
    @endforeach
@else
    <!-- Leave Type Amount and Max Days -->
    <h4 class="form-section"><i class="ft ft-list"></i>@lang('hrm::leave.leave_type') @lang('labels.info')</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">@lang('labels.total') @lang('labels.days')</label>
                {!! Form::number('amount', $page == 'create' ? old('amount') : $type->amount ,
                            [
                                'class' => 'form-control',
                                'autocomplete' => 'off',
                                'data-rule-min' => 0,
                                'data-msg-min' => __('validation.gte.numeric',
                                ['attribute' => __('hrm::job-circular.recruitment_exam.total'), 'value' => 0]),
                                'data-rule-maxlength' => 3,
                                'data-msg-maxlength'=> trans('labels.At most 3 characters'),
                            ])
                        !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">@lang('hrm::leave.max_allowed_days')</label>
                {!! Form::number('maximum_allowed_days', $page == 'create' ? old('maximum_allowed_days') : $type->maximum_allowed_days ,
                       [
                           'class' => 'form-control',
                           'autocomplete' => 'off',
                           'data-rule-min' => 0,
                           'data-msg-min' => __('validation.gte.numeric',
                           ['attribute' => __('hrm::job-circular.recruitment_exam.total'), 'value' => 0]),
                           'data-rule-maxlength' => 3,
                           'data-msg-maxlength'=> trans('labels.At most 3 characters'),
                       ])
                   !!}
            </div>
        </div>
    </div>

@endif

<div class="form-actions">
    <div class="center">
        {{ Form::button('<i class="la la-check-square-o"></i>'. trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] ) }}
        <a href="{{ route('leave-types.index') }}">
            <button type="button" class="btn btn-warning mr-1">
                <i class="la la-times"></i> @lang('labels.cancel')
            </button>
        </a>
    </div>
</div>

{!! Form::close() !!}
