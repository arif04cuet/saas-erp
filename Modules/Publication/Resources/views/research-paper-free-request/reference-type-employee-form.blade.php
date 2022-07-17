<!-- Reference Type -->
<div class="col-md-6 reference-type-employee">
    <div class="form-group">
        {!! Form::label('employee_id', trans('publication::research-paper-free-request.employee_name'), ['class' => 'form-label']) !!}
        {!! Form::select('reference_id', $employees, old('reference_id'), ['class' => 'form-control select2 required reference_employee']) !!}
        <div class="help-block"></div>
        @if ($errors->has('reference_id'))
            <span class="help-block danger">{{ $errors->first('reference_id') }}</span>
        @endif
    </div>
</div>
