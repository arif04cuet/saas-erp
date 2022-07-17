<div class="card-body">
    @if($page == 'create')
        {!! Form::open(['route' =>  'pension-nominees.store', 'class' => 'form pension-nominee-form']) !!}
    @else
        {!! Form::open(['route' =>  ['pension-nominees.update', $nominee->id], 'class' => 'form pension-nominee-form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i
                class="la la-tag"></i>@lang('accounts::pension.nominee.employee_details')</h4>

        <!--  Employees -->
        <div class="row">
            <div class="col-6">
                @if($page == 'create')
                    <div class="form-group">
                        {!! Form::label('employee_id', trans('accounts::pension.lump_sum.form_elements.employee'),
    ['class' => 'form-label']) !!}
                        {!! Form::select('employee_id', $employees, old('employee_id'),
['class' => "form-control dropdown-select", "placeholder" => trans('labels.select')]) !!}
                        <div class="help-block"></div>
                        @if($errors->has('employee_id'))
                            <span class="help-block">{{$errors->first('employee_id')}}</span>
                        @endif
                    </div>
                @else
                    {!! Form::label('employee_id', trans('accounts::pension.lump_sum.form_elements.employee'),
    ['class' => 'form-label']) !!}
                    {!! Form::select('employee_id', [$nominee->employee_id => $nominee->employee->getName()],
$nominee->employee_id,  ['class' => "form-control", 'readonly']) !!}
                @endif
            </div>
        </div>
    @include('accounts::pension-nominee.detail-form')
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-success">
            <i class="la la-check-square-o"></i>
            @if($page == 'create')
                @lang('labels.save')
            @else
                @lang('labels.edit')
            @endif
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('pension-nominees.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
