{!! Form::open(['route' =>  ['store-re-initiate', $researchProposal->id], 'class' => 'research-submission-tab-steps wizard-circle', 'enctype' => 'multipart/form-data']) !!}
<div class="form-body">
    <h4 class="form-section"><i
                class="la la-briefcase"></i> {{trans('rms::research_proposal.research_proposal_creation_form')}}</h4>

    <div class="row">
        <div class="col-md-8 offset-2">
            <fieldset>
                <div class="form row">
                    {!! Form::hidden('auth_user_id', $auth_user_id) !!}
                    {!! Form::hidden('research_request_id', $researchProposal->research_request_id) !!}
                    {!! Form::hidden('id', $researchProposal->id) !!}
                    <div class="form-group mb-1 col-sm-12 col-md-12">
                        <label class="required">{{ trans('labels.title') }}</label>
                        <br>
                        {!! Form::text('title', $page == 'create' ? old('title') : $researchProposal->title, ['class' => 'form-control required' . ($errors->has('title') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'Title', 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters')]) !!}

                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group mb-1 col-sm-12 col-md-12">
                        <label class="required">{{trans('rms::research_proposal.attachment')}}</label>
                        {!! Form::file('attachments[]', ['class' => 'form-control required' . ($errors->has('attachments') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf', 'multiple' => 'multiple']) !!}

                        @if ($errors->has('attachments'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('attachments') }}</strong>
                                </span>
                        @endif
                    </div>
                    <input type="hidden" name="type" id="type">
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-8 offset-2">
            <fieldset>
                <div class="form row">

                        <div class="form-group mb-1 col-sm-12 col-md-12">
                            <label class="">{{ trans('labels.message_to_receiver') }}</label>
                            <br>
                            {!! Form::textarea('message', null, ['class' => 'form-control',  'placeholder' => 'Message','rows'=>3]) !!}
                        </div>

                </div>
            </fieldset>
        </div>
        <div class="pull-right">
            {!! Form::button('<i class="la la-check-square-o"></i> '.trans('labels.save') , ['type' => 'submit', 'class' => 'btn btn-primary', 'name' => 'type', 'value' => 'publish'] ) !!}

            <a class="btn btn-warning mr-1" role="button" href="{{route('rms.index')}}">
                <i class="ft-x"></i> {{trans('labels.cancel')}}
            </a>
        </div>
    </div>


</div>
{!! Form::close() !!}



