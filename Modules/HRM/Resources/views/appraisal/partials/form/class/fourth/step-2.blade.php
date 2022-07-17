<h6>@lang('hrm::appraisal.employee') @lang('hrm::appraisal.selection')</h6>
<fieldset>
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="form-group">
                <label for="emaployee" class="required">@lang('hrm::appraisal.employee')</label>
                {{ Form::select('reporting_employee_id', $employees, null,
                    [
                        'placeholder' => trans('labels.select'),
                        'class' => 'form-control required'.($errors->has('reporting_employee_id') ? ' is-invalid' : ''),
                        'id' => 'employee',
                        'data-msg-required' => trans('labels.This field is required'),
                    ])
                }}

                @if ($errors->has('employee_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('reporting_employee_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</fieldset>


<script type="text/javascript">

</script>

