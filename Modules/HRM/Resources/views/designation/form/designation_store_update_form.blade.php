<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> @lang('hrm::designation.designation_form') </h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">
                    {{ Form::label('name', trans('labels.name'), ['class' => 'required']) }}
                    {{ Form::text('name', null, ['class' => ' form-control', 'maxlength'=> '50' , 'placeholder' => 'Senior HR Executive', 'required' => 'required', 'data-validation-required-message'=> Lang::get('labels.This field is required')]) }}
                    <div class="help-block"></div>
                    @if ($errors->has('name'))
                        <div class="help-block red">  {{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="form-group ">
                    {{ Form::label('bangla_name', trans('labels.name') . " ( বাংলা ) ", ['class' => 'form-label required'] ) }}
                    {{ Form::text('bangla_name', null, ['class' => 'form-control', 'maxlength' => '250',
'autocomplete' => 'off', 'placeholder' => 'সিনিয়র মানবসম্পদ নির্বাহি']) }}
                    @if ($errors->has('bangla_name'))
                        <div class="help-block red">  {{ $errors->first('bangla_name') }}</div>
                    @endif
                </div>
                <div class="form-group ">
                    {{ Form::label('short_name', trans('labels.short_name') . " ( ". trans('labels.optional'). " ) " ) }}
                    {{ Form::text('short_name', null, ['class' => 'form-control', 'maxlength' => '10', 'autocomplete' => 'off', 'placeholder' => 'SHR']) }}
                    @if ($errors->has('short_name'))
                        <div class="help-block red">  {{ $errors->first('short_name') }}</div>
                    @endif
                </div>
                <div class="form-group ">
                    {{ Form::label('hierarchy_level', trans('hrm::designation.hierarchy_level'), ['class' => 'form-label required'])}}
                    {{ Form::number('hierarchy_level', null, ['class' => 'form-control', 'min' => '1', 'autocomplete' => 'off',
'placeholder' => 'e.g: 1']) }}
                    @if ($errors->has('hierarchy_level'))
                        <div class="help-block red">  {{ $errors->first('hierarchy_level') }}</div>
                    @endif
                </div>

                {{ Form::hidden('id', null) }}
            </div>
            <div class="form-actions col-md-12 ">
                <div class="pull-right">
                    {{ Form::button('<i class="la la-check-square-o"></i> '. trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-success'] )  }}
                    <a href="{{ url('/hrm/designation') }}">
                        <button type="button" class="btn btn-warning mr-1">
                            <i class="la la-times"></i> @lang('labels.cancel')
                        </button>
                    </a>

                </div>
            </div>
        </div>
    </div>

</div>
