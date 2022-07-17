{!! Form::open(['route' => ['appraisal.invitation.store'], 'class' => 'form appraisal-invitation-form',' novalidate']) !!}
<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> @lang('hrm::appraisal.invitation.create')  @lang('labels.form')</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('memorandum_no', trans('hrm::appraisal.invitation.memorandum_no'), ['class' => 'form-label required'] ) }}
                {{ Form::text('memorandum_no',
                    $memorandum_no,
                    [
                        'class' => 'form-control',
                        'readonly' => 'readonly',
                        'autofocus'
                    ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('memorandum_no'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('memorandum_no') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('date', trans('labels.date'), ['class' => 'required']) }}
                {{ Form::text('date',
                    date('j F, Y', strtotime(now())),
                    [
                        'required' => 'required',
                        'class' => 'form-control required' . ($errors->has('date') ? ' is-invalid' : ''),
                        'readonly' => 'readonly',
                        'data-msg-required' => trans('labels.This field is required')
                    ])
                }}
                @if ($errors->has('date'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('date') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('title', trans('labels.title'), ['class' => 'form-label required'] ) }}
                {{ Form::text('title',
                    null,
                    [
                        'class' => 'form-control',
                        'placeholder' => '',
                        'required' => 'required',
                        'data-msg-required' => trans('labels.This field is required'),
                        'data-rule-minlength' => 10,
                        'data-msg-minlength'=> trans('labels.At least 10 characters'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                    ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="reporter_id" class="required">@lang('hrm::appraisal.reporter_officer')</label>
                {{ Form::select('appraisal_setting_id', $reporters, null,
                    [
                        'placeholder' => trans('labels.select'),
                        'class' => 'form-control select2 required'.($errors->has('appraisal_setting_id') ? ' is-invalid' : ''),
                        'id' => 'reporter',
                        'data-msg-required' => trans('labels.This field is required'),
                    ])
                }}

                @if ($errors->has('appraisal_setting_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('appraisal_setting_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('signer_id', trans('hrm::appraisal.signer_officer'), ['class' => 'form-label required'] ) }}
                {{ Form::text('signer_id',
                    null,
                    [
                        'class' => 'form-control',
                        'id' => 'signer',
                        'readonly' => 'readonly',
                        'autofocus'
                    ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('signer_id'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('signer_id') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('final_commenter_id', trans('hrm::appraisal.final_commenter_officer'), ['class' => 'form-label required'] ) }}
                {{ Form::text('final_commenter_id',
                    null,
                    [
                        'class' => 'form-control',
                        'id' => 'commenter',
                        'readonly' => 'readonly',
                        'autofocus'
                    ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('final_commenter_id'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('final_commenter_id') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('deadline_for_signer', trans('hrm::appraisal.invitation.deadline_for_signer'), ['class' => 'required']) }}
                {{ Form::text('deadline_to_signer',
                    null,
                    [
                        'id' => 'deadline_for_signer',
                        'required' => 'required',
                        'class' => 'form-control required' . ($errors->has('deadline_to_signer') ? ' is-invalid' : ''),
                        'data-msg-required' => trans('labels.This field is required'),
                        'placeholder' => date('j F, Y', strtotime(now()))
                    ])
                }}
                @if ($errors->has('deadline_to_signer'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('deadline_to_signer') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('deadline_for_final_commenter', trans('hrm::appraisal.invitation.deadline_for_final_commenter'), ['class' => 'required']) }}
                {{ Form::text('deadline_to_final_commenter',
                    null,
                    [
                        'id' => 'deadline_for_final_commenter',
                        'required' => 'required',
                        'class' => 'form-control required' . ($errors->has('deadline_to_final_commenter') ? ' is-invalid' : ''),
                        'data-msg-required' => trans('labels.This field is required'),
                        'placeholder' => date('j F, Y', strtotime(now())),
                    ])
                }}
                @if ($errors->has('deadline_to_final_commenter'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('deadline_to_final_commenter') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('deadline_for_final_commenter_sign', trans('hrm::appraisal.invitation.deadline_for_final_commenter_sign'), ['class' => 'required']) }}
                {{ Form::text('deadline_final_commenter_sign',
                    null,
                    [
                        'id' => 'deadline_for_final_commenter_sign',
                        'required' => 'required',
                        'class' => 'form-control required' . ($errors->has('deadline_final_commenter_sign') ? ' is-invalid' : ''),
                        'data-msg-required' => trans('labels.This field is required'),
                        'placeholder' => date('j F, Y', strtotime(now()))
                    ])
                }}
                @if ($errors->has('deadline_final_commenter_sign'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('deadline_final_commenter_sign') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-actions col-md-12">
            <div class="pull-right">
                {{ Form::button('<i class="la la-check-square-o"></i>'. trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] ) }}
                <a href="">
                    <button type="button" class="btn btn-warning mr-1">
                        <i class="la la-times"></i> @lang('labels.cancel')
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}



