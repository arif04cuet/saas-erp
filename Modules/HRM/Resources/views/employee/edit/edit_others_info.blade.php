<div class="row"></div>
<div class="col-md-6">
    <div class="form-group {{ $errors->PersonalInfo->has('interest') ? ' error' : '' }}">
        {{ Form::label('interest', trans('hrm::others_info.interest_area')) }}
        {{ Form::select('interests[]', $areaOfInterests, $employee->employeeInterestInfo->pluck('area_of_interest_id'),
        [
            'class' => 'form-control form-control-sm interest-select2 required',
            'data-msg-required'=>trans('labels.This field is required'),
            'multiple'
        ]) }}
        @if ($errors->PersonalInfo->has('interest'))
            <div class="help-block">  {{ $errors->PersonalInfo->first('interest') }}</div>
        @endif
    </div>
</div>

@if(isset($employee->id))
    {{ Form::hidden('employee_id', isset($employee->id) ? $employee->id : null)   }}
@else
    {{ Form::hidden('employee_id', isset($employee_id) ? $employee_id : null) }}
@endif

<div class="form-actions col-md-12 ">
    <div class="pull-right">
        {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'master btn btn-primary'] )  }}
        <a href="{{ route('employee.index') }}">
            <button type="button" class="master btn btn-warning mr-1">
                <i class="la la-times"></i> @lang('labels.cancel')
            </button>
        </a>

    </div>

</div>
</div>

@push('page-js')
    <script>
        $(document).ready(function () {
            $('.interest-select2').select2({
                multiple: true,
                tags: true
            });
            validateForm('.hrm-employee-create-form-others')
        })
    </script>
@endpush
