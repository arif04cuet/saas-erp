<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('pms::report.indicator.form')
</h4>

<div class="col">
    <div class="row form-group">
        <!-- project name -->
        <div class="col-6">
            {{Form::label('title',trans('pms::project_proposal.project_name'),['class'=>''])}}
            {!! Form::text('title', $project->title,
                [
                    'class' => 'form-control' .
                    ($errors->has('title') ? ' is-invalid' : ''),
                    'data-msg-required' => Lang::get('labels.This field is required'),
                    'placeholder' => Lang::get('pms::project_proposal.project_name'),
                    'readonly'=>'readonly',
                    'data-rule-maxlength' => 100, 'data-msg-maxlength'=> trans('labels.At most 100 characters')])
             !!}
        </div>
        <!-- Organization -->
        <div class="col-6">
            <div class="form-group">
            {!! Form::label('organization_id', trans('pms::report.indicator.form_elements.organization_id'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('organization_id', $organizations ?? [], $organization->id ?? null, [
                        'class' => 'form-control required select2',
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('organization_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('organization_id') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row form-group">

        <!-- From Date  -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('from', trans('labels.start'), ['class' => 'form-label']) !!}
                {{
                       Form::text('from', isset($fromDate) ? $fromDate->format('Y-m-d') : date('Y-m-d'), [
                            'class' => 'form-control required month',
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('from'))
                <div class="help-block text-danger">
                    {{ $errors->first('from') }}
                </div>
            @endif
        </div>

        <!-- To Date  -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('to', trans('labels.end'), ['class' => 'form-label']) !!}
                {{
                       Form::text('to', isset($toDate) ? $toDate->format('Y-m-d') : date('Y-m-d'), [
                            'class' => 'form-control required month',
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('to'))
                <div class="help-block text-danger">
                    {{ $errors->first('to') }}
                </div>
            @endif
        </div>
    </div>
</div>
<!--/General Information -->

<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-search"></i>@lang('labels.search')
    </button>
    <a href="{{route('project.show',$project)}}" class="btn btn-warning">
        <i class="la la-backward"></i>@lang('labels.back_page')
    </a>
</div>

