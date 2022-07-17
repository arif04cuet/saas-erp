{!! Form::open(['route' => [ 'project.update',$project], 'class' => 'project-submission-tab-steps wizard-circle']) !!}
@method('put')
<h4 class="form-section"><i
        class="la la-briefcase"></i> {{trans('pms::project_proposal.project_edit_form')}}
</h4>
<div class="form-group">
    <div class="col-md-8 offset-2">
        {{Form::label('title',trans('pms::project_proposal.project_name'),['class'=>''])}}
        {!! Form::text('title', $project->title,
            [
                'class' => 'form-control' .
                ($errors->has('title') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => Lang::get('pms::project_proposal.project_name'),
                'readonly'=>'readonly',
                'data-rule-maxlength' => 255, 'data-msg-maxlength'=> trans('labels.At most 255 characters')])
         !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-8 offset-2">
        <!-- Budget-->
        {{Form::label('budget',trans('pms::project_proposal.project_budget'),['class'=>''])}}

        {!! Form::number('budget', $project->budget ?? 0,
                    [
                        'class' => 'form-control required' . ($errors->has('budget') ? ' is-invalid' : ''),
                        'data-msg-required' => Lang::get('labels.This field is required'),
                        'placeholder' => Lang::get('pms::project_proposal.project_budget'),  'min="1"'
                    ])
        !!}
        @if ($errors->has('budget'))
            <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('budget') }}</strong>
                                </span>
        @endif
    </div>
</div>


<div class="form-group">
    <div class="col-md-8 offset-2">
        <!-- Fund Source -->
        {{Form::label('fund_source',trans('pms::project_proposal.fund_source'),['class'=>''])}}
        {!! Form::text('fund_source', $project->fund_source ?? null,
                    [
                        'class' => 'form-control ' . ($errors->has('fund_source') ? ' is-invalid' : ''),
                        'data-msg-required' => Lang::get('labels.This field is required'),
                        'placeholder' => Lang::get('pms::project_proposal.fund_source'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=>Lang::get('labels.At most 100 characters')]
       ) !!}

        @if ($errors->has('fund_source'))
            <span class="invalid-feedback" role="alert">
                       <strong>
                           {{ $errors->first('fund_source') }}
                       </strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group">
    <div class="col-md-8 offset-2">
        <!-- Duration-->
        {{Form::label('duration',trans('pms::project_proposal.project_duration'),['class'=>''])}}

        {!! Form::number('duration', $project->duration ?? 0,
                ['class' => 'form-control required' . ($errors->has('duration') ? ' is-invalid' : ''),
                 'data-msg-required' => Lang::get('labels.This field is required'),
                 'placeholder' => Lang::get('pms::project_proposal.project_duration'),
                  'min="1"',
                  'max="100"'
               ])

       !!}

        @if ($errors->has('duration'))
            <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('duration') }}</strong>
                                </span>
        @endif
    </div>
</div>

<!-- project assigned roles form -->
@include('pms::project.partials.project-assigned-role-form')

<div class="form-actions text-center">
    {!! Form::button('<i class="la la-check-square-o"></i> '.trans('labels.update') , ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}

    <a class="btn btn-warning mr-1" role="button" href="{{route('project.index')}}">
        <i class="ft-x"></i> {{trans('labels.cancel')}}
    </a>
</div>
{!! Form::close() !!}



