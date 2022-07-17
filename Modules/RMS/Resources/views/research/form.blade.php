{!! Form::open(['route' =>  'research.store', 'class' => 'research-submission-tab-steps wizard-circle']) !!}

<div class="form-body">
    <h4 class="form-section"><i
                class="la la-briefcase"></i> {{trans('rms::research_proposal.research_create_form')}}</h4>

    <div class="row">
        <div class="col-md-8 offset-2">
            <fieldset>
                <div class="form row">
                    {!! Form::hidden('submitted_by', $auth_user_id) !!}
                    <div class="form-group mb-1 col-sm-12 col-md-12">
                        <label class="required">@lang('rms::research_proposal.research_name')</label>
                        <br>
                        {!! Form::text('title', old('title'), ['class' => 'form-control required' . ($errors->has('title') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'Title', 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters')]) !!}

                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group mb-1 col-sm-12 col-md-12">
                        <label class="required">@lang('rms::research.select_detail_proposal')</label>
                        <br>
                        {{ Form::select('research_detail_submission_id', $proposals, null, ['class' => 'select2 form-control required'.($errors->has('research_detail_submission_id') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required')]) }}
                        @if ($errors->has('research_detail_submission_id'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('research_detail_submission_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="form-actions text-center">
    {!! Form::button('<i class="la la-check-square-o"></i> '.trans('labels.save') , ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}

    <a class="btn btn-warning mr-1" role="button" href="{{route('research.index')}}">
        <i class="ft-x"></i> {{trans('labels.cancel')}}
    </a>
</div>
{!! Form::close() !!}



