{!! Form::open(['route' => 'project.store', 'class' => 'project-submission-tab-steps wizard-circle']) !!}

<div class="form-body">
    <h4 class="form-section"><i class="la la-briefcase"></i> {{ trans('pms::project_proposal.project_create_form') }}
    </h4>

    <div class="row">
        <div class="col-md-8 offset-2">
            <fieldset>
                <div class="form row">
                    {!! Form::hidden('submitted_by', $auth_user_id) !!}
                    <div class="form-group mb-1 col-sm-12 col-md-12">
                        <!-- Title -->
                        <label class="required">@lang('pms::project_proposal.project_name')</label>
                        <br>
                        {!! Form::text('title', old('title'), ['class' => 'form-control required' . ($errors->has('title') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => Lang::get('pms::project_proposal.project_name'), 'data-rule-maxlength' => 255, 'data-msg-maxlength' => Lang::get('labels.At most 255 characters')]) !!}

                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif

                        <!-- Fund Source -->
                        <br>
                        <label class="required">@lang('pms::project_proposal.fund_source')</label>
                        {!! Form::text('fund_source', old('fund_source') ?? null, ['class' => 'form-control' . ($errors->has('fund_source') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => Lang::get('pms::project_proposal.fund_source'), 'data-rule-maxlength' => 255, 'data-msg-maxlength' => Lang::get('labels.At most 255 characters')]) !!}

                        @if ($errors->has('fund_source'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('fund_source') }}</strong>
                            </span>
                        @endif

                        <!-- detail proposal -->
                        <div class="detail-proposal-div">
                            <br>
                            <label class="required">@lang('pms::project.select_detail_proposal')</label>
                            <br>
                            {{ Form::select('project_detail_proposal_id', $proposals, null, ['class' => 'select2 form-control required' . ($errors->has('project_detail_proposal_id') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required')]) }}
                            @if ($errors->has('project_detail_proposal_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('project_detail_proposal_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <br>
                        <!-- Budget-->
                        <label class="required">@lang('pms::project_proposal.project_budget')</label>
                        <br>
                        {!! Form::number('budget', old('budget'), ['class' => 'form-control required' . ($errors->has('budget') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => Lang::get('pms::project_proposal.project_budget'), 'min="1"']) !!}

                        @if ($errors->has('budget'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('budget') }}</strong>
                            </span>
                        @endif
                        <br>

                        <!-- Duration-->
                        <label class="required">@lang('pms::project_proposal.project_duration')</label>
                        <br>
                        {!! Form::number('duration', old('duration'), [
    'class' => 'form-control required' . ($errors->has('duration') ? ' is-invalid' : ''),
    'placeholder' => Lang::get('pms::project_proposal.project_duration'),
    'data-msg-required' => trans('labels.This field is required'),
    'min' => 0,
    'data-msg-min' => trans('labels.min_validate_equal_or_greater', ['min' => 0]),
    'max' => 100,
    'data-msg-max' => trans('labels.max_validate_equal_or_less', ['max' => 100]),
    'data-rule-number' => 'true',
    'data-msg-number' => trans('labels.Please enter a valid number'),
]) !!}

                        @if ($errors->has('duration'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('duration') }}</strong>
                            </span>
                        @endif
                        <br>
                        <!-- Checkbox ( Without Workflow ) -->
                        <div class="form-group">
                            <div class="skin skin-flat">
                                {{ Form::checkbox('ignore_workflow', 1, false) }}
                                <label class="">@lang('pms::project_proposal.ignore_workflow')
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('purpose', trans('labels.purposes'), ['class' => 'form-label']) !!}
                            {!! Form::textarea('purpose', null, ['class' => 'form-control', 'rows' => 2, 'data-rule-maxlength' => 1000, 'data-msg-maxlength' => trans('labels.At most 1000 characters')]) !!}
                            <div class="help-block"></div>
                            @if ($errors->has('purpose'))
                                <span class="invalid-feedback">{{ $errors->first('purpose') }}</span>
                            @endif
                        </div>

                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <!-- project assigned roles form -->
    @include('pms::project.partials.project-assigned-role-form')
</div>
<div class="form-actions text-center">
    {!! Form::button('<i class="la la-check-square-o"></i> ' . trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary']) !!}

    <a class="btn btn-warning mr-1" role="button" href="{{ route('project.index') }}">
        <i class="ft-x"></i> {{ trans('labels.cancel') }}
    </a>
</div>
{!! Form::close() !!}
