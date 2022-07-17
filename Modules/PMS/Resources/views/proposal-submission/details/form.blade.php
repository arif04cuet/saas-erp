{!! Form::open(['route' => 'project-details-proposal-submission.store', 'class' => 'form project-submission-tab-steps', 'enctype' => 'multipart/form-data']) !!}
@csrf
<div class="form-body">
    <h4 class="form-section"><i class="la la-briefcase"></i>@lang('pms::project_proposal.project_details_submit_form')</h4>
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="row">
                {!! Form::hidden('auth_user_id', Auth::user()->id) !!}
                {!! Form::hidden('project_request_id', $projectRequestId) !!}
                <div class="form-group mb-1 col-sm-12 col-md-12">
                    <label class="required">{{ trans('labels.title') }}</label>
                    <br>
                    {!! Form::text('title', old('title'), ['class' => 'form-control required' . ($errors->has('title') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'Title', 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters')]) !!}
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group mb-1 col-sm-12 col-md-12">
                    <label class="required">{{trans('pms::project_proposal.attachment')}}</label>
                    {!! Form::file('attachments[]', ['class' => 'form-control required' . ($errors->has('attachments') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf', 'multiple' => 'multiple', 'required']) !!}

                    @if ($errors->has('attachments'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('attachments') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions text-center">
        <div class="col-md-8 offset-2">
            <div class="form-group">
                <label for="message">@lang('labels.message_to_receiver')</label>
                <textarea class="form-control" name="message" id="message"></textarea>
            </div>
        </div>
        <button type="submit" name="to_budget" value="1" class="btn btn-outline-success">
            <i class="la la-check-square-o"></i> @lang('labels.save') @lang('labels.and') @lang('labels.provide') @lang('pms::project_proposal.project_budget')
        </button>
        <button type="submit" name="to_budget" value="0" class="btn btn-primary">
            <i class="la la-check-square-o"></i> @lang('labels.save')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('project-request.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
</div>
{!! Form::close() !!}