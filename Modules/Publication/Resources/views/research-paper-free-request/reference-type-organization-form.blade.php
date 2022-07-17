<!-- Reference Type Organization -->
<div class="col-md-6 reference-type-organization">
    <div class="form-group">
        {!! Form::label('id', trans('publication::research-paper-free-request.organization_name'), ['class' => 'form-label']) !!}
        {!! Form::select('reference_id', $organizations, old('reference_id'), ['class' => 'form-control select2 required reference_organization']) !!}
        <div class="help-block"></div>
        @if ($errors->has('reference_id'))
            <span class="help-block danger">{{ $errors->first('reference_id') }}</span>
        @endif
    </div>
</div>
