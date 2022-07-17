@if($page == 'create')
    {!! Form::open(['route' => 'project-request-details.store', 'class' => 'project-request-tab-steps form', 'enctype' => 'multipart/form-data']) !!}
@else
    {!! Form::open(['route' =>  ['project-request-details.update', $projectRequestDetail->id], 'class' => 'project-request-tab-steps wizard-circle', 'enctype' => 'multipart/form-data']) !!}
    @method('PUT')
@endif

<div class="form-body">
    <h4 class="form-section"><i
                class="la la-briefcase"></i>@if($page == 'create') @lang('pms::project-request-detail.create.form.create.title') @else @lang('pms::project-request-detail.create.form.update.title')@endif</h4>
    <div class="row">
        <div class="col-md-8 offset-2">
            <fieldset>
                <div class="form row">
                    @if($page == 'create')
                        {{ Form::hidden('project_proposal_id', $projectProposal->id) }}
                    @endif
                    <div class="form-group mb-1 col-sm-12 col-md-12">
                        <label class="required">{{ trans('labels.title') }}</label>
                        <br>
                        {!! Form::text('title', $page == 'create' ? old('title') : $projectRequestDetail->title, ['class' => 'form-control required' . ($errors->has('designation') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'Title', 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters')]) !!}

                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group mb-1 col-sm-12 col-md-12">
                        <label class="required">{{ trans('rms::research_proposal.last_sub_date') }}</label>
                        {{ Form::text('end_date', $page == 'create' ? date('j F, Y') : date('j F, Y', strtotime($projectRequestDetail->end_date)), ['id' => 'end_date', 'class' => 'form-control required' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'Pick end date', 'data-msg-required' => Lang::get('labels.This field is required')]) }}
                        @if ($errors->has('end_date'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group mb-1 col-sm-12 col-md-12">
                        <label for="remarks" class="form-label">{{trans('labels.remarks')}}</label>
                        {!! Form::textarea('remarks', $page == 'create' ? old('remarks') : $projectRequestDetail->remarks, ['class' => 'form-control' . ($errors->has('remarks') ? ' is-invalid' : ''), 'placeholder' => 'Write here...', 'cols' => 30, 'rows' => 5, 'data-rule-maxlength' => 5000, 'data-msg-maxlength'=>Lang::get('labels.At most 5000 characters')]) !!}

                        @if ($errors->has('remarks'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('remarks') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mb-1 col-sm-12 col-md-12">
                        <label class="required">{{trans('rms::research_proposal.attachment')}}</label>
                        {!! Form::file('attachments[]', ['class' => 'form-control required' . ($errors->has('attachments.*') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf', 'multiple' => 'multiple']) !!}

                        @if ($errors->has('attachments.*'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('attachments.*') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="form-actions text-center">
    @if(auth()->user()->employee->employeeDepartment->department_code == "PMS")
        {!! Form::button('<i class="la la-check-square-o"></i> '.trans('labels.save') , ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}
    @endif

    <a class="btn btn-warning mr-1" role="button" href="{{route('project-request.index')}}">
        <i class="ft-x"></i> {{trans('labels.cancel')}}
    </a>
</div>
{!! Form::close() !!}
