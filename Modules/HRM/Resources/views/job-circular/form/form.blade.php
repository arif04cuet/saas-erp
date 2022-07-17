@if($page == 'create')
    {!! Form::open(['route' =>  ['job-circular.store'], 'class' => 'form job-circular-form', 'method' => 'post']) !!}
@else
    {!! Form::open(['route' =>  ['job-circular.update', $jobCircular->id], 'class' => 'form job-circular-form', 'method' => 'put']) !!}
@endif
{{ old('system_shortlist') }}
<!-- title and unique id -->
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('unique_id', trans('hrm::circular.unique_id'), ['class' => 'form-label required'] ) }}
            {{ Form::text('unique_id',
                $page == 'create' ? $jobCircularId : $jobCircular->unique_id,
                [
                    'class' => 'form-control readonly',
                    'autofocus'
                ])
            }}
            <div class="help-block"></div>
            @if ($errors->has('unique_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('unique_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('title') ? ' error' : '' }}">
            {{ Form::label('title', trans('labels.title'), ['class' => 'required'] ) }}
            {{ Form::text('title',
                $page == 'create' ? null : $jobCircular->title,
                [
                    'class' => 'form-control required',
                    'placeholder' => '',
                    'data-msg-required' => trans('labels.This field is required'),
                    'data-rule-minlength' => 10,
                    'data-msg-minlength'=> trans('labels.At least 10 characters'),
                    'data-rule-maxlength' => 100,
                    'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                ])
            }}
            <div class="help-block"></div>
            @if ($errors->has('title'))
                <div class="help-block">  {{ $errors->first('title') }}</div>
            @endif
        </div>
    </div>
</div>
<!-- Job nature and Location -->
<div class="row">
    <!-- Job nature -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('job_nature') ? ' error' : '' }}">
            {{ Form::label('job_nature', trans('hrm::circular.job_nature'), ['class' => 'required']) }}
            {{ Form::select('job_nature',
                $jobNatures ?? [],
                $page == 'create' ? null : $jobCircular->job_nature,
                [
                    'placeholder' => trans('labels.select'),
                    'class' => 'form-control select2 required job_nature',
                    'data-msg-required' => trans('labels.This field is required')
                ])
            }}
            <div class="help-block"></div>
            @if ($errors->has('job_nature'))
                <div class="help-block">  {{ $errors->first('job_nature') }}</div>
            @endif
        </div>
    </div>

    <!-- Job location -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('job_location') ? ' error' : '' }}">
            {{ Form::label('job_location', trans('hrm::circular.job_location'), ['class' => 'required']) }}
            {{ Form::text('job_location', empty($jobCircular) ? null : $jobCircular->job_location, [
                'class' => 'form-control required' . ($errors->has('job_location') ? ' is-invalid' : ''),
                'data-msg-required' => trans('labels.This field is required'),
                'data-rule-minlength' => 1,
                'data-msg-minlength'=> trans('labels.At least 1 characters'),
                'data-rule-maxlength' => 50,
                'data-msg-maxlength'=> trans('labels.At most 50 characters'),
            ]) }}
            <div class="help-block"></div>
            @if ($errors->has('job_nature'))
                <div class="help-block">  {{ $errors->first('job_nature') }}</div>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <!-- reference number -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('reference_number',
                trans('hrm::circular.reference_number'),
                ['class' => 'form-label requried']) !!}
            {!! Form::text('reference_number', $page == "create" ? null : $jobCircular->reference_number, [
                'class' => 'form-control required',
                'placeholder' => trans('hrm::circular.reference_number'),
                'data-rule-maxlength' => 50,
                'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                'data-msg-required' => trans('labels.This field is required')
            ]) !!}
        </div>
    </div>
    <!-- Application deadline -->
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('application_deadline', trans('hrm::circular.application_deadline'), ['class' => 'required']) }}
            {{ Form::text('application_deadline',
                $page == 'create' ? date('j F, Y', strtotime(now())) : date('j F, Y', strtotime($jobCircular->application_deadline)),
                [
                    'id' => 'deadline_date',
                    'class' => 'form-control required' . ($errors->has('application_deadline') ? ' is-invalid' : ''),
                    'data-msg-required' => trans('labels.This field is required')
                ])
            }}
            @if ($errors->has('application_deadline'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('application_deadline') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!-- shortlist checkbox -->
    <div class="form-group col-md-4">
        <label for="system_shortlist">
            {{trans('hrm::job-circular.system_shortlist')}}
        </label>
        <div class="skin skin-flat">
            {{ Form::checkbox(
                'system_shortlist',
                true,
                $page == 'create' ? old('system_shortlist') : $jobCircular->system_shortlist
            ) }}
            <label>@lang('labels.yes',[],'en')</label>
        </div>
        <div class="row col-md-12 radio-error">
            @if($errors->has('system_shortlist'))
                <span class="small text-danger">
                    <strong>{{ $errors->first('system_shortlist') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @if($page == 'edit' && $jobCircular->system_shortlist == 1)
        <div class="col-md-3">
            <a href="{{ route('job-circular.minimum-qualification.create', $jobCircular->id) }}"
               class="btn btn-primary btn-sm">
                <i class="ft-plus white"></i> @lang('hrm::job-circular.add_min_qualification')
            </a>
        </div>
    @endif
</div>
<!-- other requirements -->
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('other_requirements') ? ' error' : '' }}">
            {{ Form::label('other_requirements', trans('hrm::circular.other_requirements'), ['class' => 'required']) }}
            {{ Form::textarea('other_requirements',
                $page == 'create' ? null : $jobCircular->other_requirements,
                [
                    'class' => 'form-control required',
                    'data-msg-required'=>trans('labels.This field is required'),
                    'data-rule-maxlength' => 1000,
                    'data-msg-maxlength'=> trans('labels.At most 1000 characters'),
                ])
             }}
            <div class="help-block"></div>
            @if ($errors->has('other_requirements'))
                <div class="help-block">{{ $errors->first('other_requirements') }}</div>
            @endif
        </div>

    </div>
</div>

<h4 class="form-section"><i
        class="la la-tag"></i>@lang('labels.details')</h4>

@if($page == 'edit')
    @include('hrm::job-circular.form.old-form-repeater')
@else
    @include('hrm::job-circular.form.form-repeater')
@endif

<hr>
<div class="row">
    <div class="form-actions col-md-12">
        <div class="pull-right">
            {{ Form::button('<i class="la la-check-square-o"></i>'. trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] ) }}
            <a href="{{ route('job-circular.index') }}">
                <button type="button" class="btn btn-warning mr-1">
                    <i class="la la-times"></i> @lang('labels.cancel')
                </button>
            </a>
        </div>
    </div>
</div>
{!! Form::close() !!}
