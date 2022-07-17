{!! Form::open(['route' =>  ['job-circular.minimum-qualification.store', $jobCircular->id], 'class' => 'form job-circular-qualification-form', 'novalidate', 'method' => 'post']) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="min_ssc_year">
                @lang('hrm::circular.min_degree_passing_year', ['degree' => trans('hrm::circular.ssc')])
            </label>
            {{ Form::text('min_ssc_year', ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->min_ssc_year : null, [
                'class' => 'form-control' . ($errors->has('min_ssc_year') ? ' is-invalid' : ''),
                'data-rule-minlength' => 4,
                'data-msg-minlength'=> trans('labels.At least 4 characters'),
                'data-rule-maxlength' => 4,
                'data-msg-maxlength'=> trans('labels.At most 4 characters'),
                'data-rule-number' => 'true',
                'data-msg-number' => trans('labels.Please enter a valid number'),
                'min' => 1,
                'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'),
            ]) }}

            @if($errors->has('min_ssc_year'))
                <div class="help-block danger">{{ $errors->first('min_ssc_year') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="ssc_point">
                @lang('hrm::circular.min_degree_passing_point', ['degree' => trans('hrm::circular.ssc')])
            </label>
            {{ Form::number('ssc_point', ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->ssc_point : null, [
                'class' => 'form-control' . ($errors->has('ssc_point') ? ' is-invalid' : ''),
                'min' => 1,
                'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'),
                'max' => 5,
                'data-msg-max' => trans('labels.Please enter a value less than or equal to 5'),
                'data-msg-number' => trans('labels.Please enter a valid number'),
                'data-rule-maxlength' => 4,
                'data-msg-maxlength'=> trans('labels.At most 4 characters'),
            ]) }}

            @if($errors->has('ssc_point'))
                <div class="help-block danger">{{ $errors->first('ssc_point') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="min_hsc_year">
                @lang('hrm::circular.min_degree_passing_year', ['degree' => trans('hrm::circular.hsc')])
            </label>
            {{ Form::text('min_hsc_year', ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->min_hsc_year : null, [
                'class' => 'form-control' . ($errors->has('min_hsc_year') ? ' is-invalid' : ''),
                'data-rule-minlength' => 4,
                'data-msg-minlength'=> trans('labels.At least 4 characters'),
                'data-rule-maxlength' => 4,
                'data-msg-maxlength'=> trans('labels.At most 4 characters'),
                'data-rule-number' => 'true',
                'data-msg-number' => trans('labels.Please enter a valid number'),
                'min' => 1,
                'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'),
            ]) }}

            @if($errors->has('min_hsc_year'))
                <div class="help-block danger">{{ $errors->first('min_hsc_year') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="hsc_point">
                @lang('hrm::circular.min_degree_passing_point', ['degree' => trans('hrm::circular.hsc')])
            </label>
            {{ Form::number('hsc_point', ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->hsc_point : null, [
                'class' => 'form-control' . ($errors->has('hsc_point') ? ' is-invalid' : ''),
                'min' => 1,
                'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'),
                'max' => 5,
                'data-msg-max' => trans('labels.Please enter a value less than or equal to 5'),
                'data-msg-number' => trans('labels.Please enter a valid number'),
                'data-rule-maxlength' => 4,
                'data-msg-maxlength'=> trans('labels.At most 4 characters'),
            ]) }}

            @if($errors->has('hsc_point'))
                <div class="help-block danger">{{ $errors->first('hsc_point') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="min_grad_year">
                @lang('hrm::circular.min_degree_passing_year', ['degree' => trans('hrm::circular.grad')])
            </label>
            {{ Form::text('min_grad_year', ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->min_grad_year : null, [
                'class' => 'form-control' . ($errors->has('min_grad_year') ? ' is-invalid' : ''),
                'data-rule-minlength' => 4,
                'data-msg-minlength'=> trans('labels.At least 4 characters'),
                'data-rule-maxlength' => 4,
                'data-msg-maxlength'=> trans('labels.At most 4 characters'),
                'data-rule-number' => 'true',
                'data-msg-number' => trans('labels.Please enter a valid number'),
                'min' => 1,
                'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'),
            ]) }}

            @if($errors->has('min_grad_year'))
                <div class="help-block danger">{{ $errors->first('min_grad_year') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <label for="grad_point">
            @lang('hrm::circular.min_degree_passing_point', ['degree' => trans('hrm::circular.grad')])
        </label>
        {{ Form::number('grad_point', ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->grad_point : null, [
            'class' => 'form-control' . ($errors->has('grad_point') ? ' is-invalid' : ''),
            'min' => 1,
            'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'),
            'max' => 4,
            'data-msg-max' => trans('labels.Please enter a value less than or equal to 4'),
            'data-msg-number' => trans('labels.Please enter a valid number'),
            'data-rule-maxlength' => 4,
            'data-msg-maxlength'=> trans('labels.At most 4 characters'),
        ]) }}

        @if($errors->has('grad_point'))
            <div class="help-block danger">{{ $errors->first('grad_point') }}</div>
        @endif
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="">
                @lang('hrm::circular.min_degree_passing_year', ['degree' => trans('hrm::circular.post_grad')])
            </label>
            {{ Form::text('min_post_grad_year', ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->min_post_grad_year : null,
            [
                'class' => 'form-control' . ($errors->has('min_post_grad_year') ? ' is-invalid' : ''),
                'data-rule-minlength' => 4,
                'data-msg-minlength'=> trans('labels.At least 4 characters'),
                'data-rule-maxlength' => 4,
                'data-msg-maxlength'=> trans('labels.At most 4 characters'),
                'data-rule-number' => 'true',
                'data-msg-number' => trans('labels.Please enter a valid number'),
                'min' => 1,
                'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'),
            ]) }}

            @if($errors->has('min_post_grad_year'))
                <div class="help-block danger">{{ $errors->first('min_post_grad_year') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="">
                @lang('hrm::circular.min_degree_passing_point', ['degree' => trans('hrm::circular.post_grad')])
            </label>
            {{ Form::number('post_grad_point', ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->post_grad_point : null, [
                'class' => 'form-control' . ($errors->has('post_grad_point') ? ' is-invalid' : ''),
                'min' => 1,
                'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'),
                'max' => 4,
                'data-msg-max' => trans('labels.Please enter a value less than or equal to 4'),
                'data-msg-number' => trans('labels.Please enter a valid number'),
                'data-rule-maxlength' => 4,
                'data-msg-maxlength'=> trans('labels.At most 4 characters'),
            ]) }}

            @if($errors->has('post_grad_point'))
                <div class="help-block danger">{{ $errors->first('post_grad_point') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="upper_age_limit">
                @lang('hrm::job-circular.age_limit', ['range' => trans('hrm::job-circular.max')])
            </label>
            {{ Form::number('upper_age_limit', ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->upper_age_limit : null, [
                'class' => 'form-control' . ($errors->has('grad_point') ? ' is-invalid' : ''),
                'min' => 18,
                'data-msg-min' => trans('labels.Please enter a value greater than or equal to 18'),
                'data-msg-number' => trans('labels.Please enter a valid number'),
                'data-rule-maxlength' => 2,
                'data-msg-maxlength'=> trans('labels.At most 2 characters'),
            ]) }}

            @if($errors->has('upper_age_limit'))
                <div class="help-block danger">{{ $errors->first('upper_age_limit') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lower_age_limit">
                @lang('hrm::job-circular.age_limit', ['range' => trans('hrm::job-circular.min')])
            </label>
            {{ Form::number('lower_age_limit', ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->lower_age_limit : null, [
                'class' => 'form-control' . ($errors->has('grad_point') ? ' is-invalid' : ''),
                'min' => 18,
                'data-msg-min' => trans('labels.Please enter a value greater than or equal to 18'),
                'data-msg-number' => trans('labels.Please enter a valid number'),
                'data-rule-maxlength' => 2,
                'data-msg-maxlength'=> trans('labels.At most 2 characters'),
            ]) }}

            @if($errors->has('upper_age_limit'))
                <div class="help-block danger">{{ $errors->first('upper_age_limit') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="gender" class="form-label">@lang('labels.gender')</label>
            <div class="row">
                <div class="col-md-4">
                    <div class="skin skin-flat">
                        <fieldset>
                            {!! Form::radio('gender', 'male', ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->gender == 'male' : false) !!}
                            <label>@lang('labels.male')</label>
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="skin skin-flat">
                        <fieldset>
                            {!! Form::radio('gender', 'female', ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->gender == 'female' : false) !!}
                            <label>{{ trans('labels.female') }}</label>
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="skin skin-flat">
                        <fieldset>
                            {!! Form::radio('gender', 'others',  ($jobCircular->qualificationRule) ? $jobCircular->qualificationRule->gender == 'others' : false) !!}
                            <label>{{ trans('labels.others') }}</label>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="row radio-error"></div>
            @if ($errors->has('gender'))
                <div class="small danger">
                    <strong>{{ $errors->first('gender') }}</strong>
                </div>
            @endif

        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="form-actions col-md-12">
        <div class="pull-right">
            {{ Form::button('<i class="la la-check-square-o"></i>'. trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] ) }}
            <a href="{{ route('job-circular.edit', $jobCircular->id) }}">
                <button type="button" class="btn btn-warning mr-1">
                    <i class="la la-times"></i> @lang('labels.cancel')
                </button>
            </a>
        </div>
    </div>
</div>
{!! Form::close() !!}
