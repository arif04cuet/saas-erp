@if ($page === 'create')
    {!! Form::open(['route' => ['research-budget.store', $research->id], 'class' => 'form research-budget-form']) !!}
@else
    {!! Form::open(['route' => ['research-budget.update', $research->id], 'class' => 'form research-budget-form']) !!}
    @method('put')
@endif

<h4 class="form-section"><i class="la la-tag"></i>@lang('rms::research_budget.title')</h4>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="4%"># SL</th>
                    <th>Activities</th>
                    <th width="20%">Estimated Cost (Tk.)</th>

                </tr>
            </thead>
            <tbody>
                @if ($page === 'create')
                    @foreach (config('default-values.budget') as $budget)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <th>
                                {{ $budget }}
                                <input type="hidden" name="activity[]" value="{{ $budget }}">
                            </th>
                            <td>
                                {!! Form::number('estimated_cost[' . ($loop->iteration - 1) . ']', 0, [
    'class' => 'form-control required',
    'placeholder' => 'e.g. 100',
    'data-msg-required' => trans('labels.This field is required'),
    'min' => 0,
    'data-msg-min' => trans('labels.Must be greater than or equal to', ['attribute' => '0']),
    'data-rule-maxlength' => 14,
    'data-msg-maxlength' => trans('labels.At most 14 characters'),
    'data-rule-number' => 'true',
    'data-msg-number' => trans('labels.Please enter a valid number'),
]) !!}
                            </td>
                        </tr>
                    @endforeach
                @elseif($page === 'edit')
                    @foreach ($research->budgets as $budget)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <th>
                                {{ $budget->activity }}
                                <input type="hidden" name="activity[]" value="{{ $budget->activity }}">
                            </th>
                            <td>
                                {!! Form::number('estimated_cost[' . ($loop->iteration - 1) . ']', $budget->estimated_cost, [
    'class' => 'form-control required',
    'placeholder' => 'e.g. 100',
    'data-msg-required' => trans('labels.This field is required'),
    'min' => '0',
    'data-msg-min' => trans('labels.Must be greater than or equal to', ['attribute' => '0']),
    'data-rule-maxlength' => '14',
    'data-msg-maxlength' => trans('labels.At most 14 characters'),
    'data-rule-number' => 'true',
    'data-msg-number' => trans('labels.Please enter a valid number'),
]) !!}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{ url(route('research-budget.index', $research->id)) }}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
