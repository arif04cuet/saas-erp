@if ($page === 'create')
    {!! Form::open(['route' => ['project-budget.store', $project->id], 'class' => 'form project-budget-form']) !!}
@else
    {!! Form::open(['route' => ['project-budget.update', $project->id], 'class' => 'form project-budget-form']) !!}
    @method('put')
@endif
{{-- Common Fiscal Year --}}
{{-- <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fiscal year', trans('accounts::fiscal-year.title'), ['class' => 'form-label required']) !!}
            @if ($page == 'create')
                {!! Form::select('fiscal_year_id', $fiscalYear, null, ['class' => 'form-control fiscal-year-dropdown-select required', 'data-msg-required' => __('labels.This field is required')]) !!}
            @else
                {!! Form::select('fiscal_year_id', $fiscalYear, $projectBudget[0]['fiscal_year_id'], ['class' => 'form-control fiscal-year-dropdown-select required', 'data-msg-required' => __('labels.This field is required')]) !!}
            @endif
        </div>
    </div>
</div> --}}
@include('pms::project.budget.repeater-form')

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{ url(route('project-budget.index', $project->id)) }}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
