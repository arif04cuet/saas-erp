<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> @lang('hrm::department.section_form') </h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">
                    {{ Form::label('name', trans('labels.name'), ['class' => 'required']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'maxlength'=>'100', 'placeholder' => 'Section Name', 'required' => 'required', 'data-validation-required-message'=> trans('labels.This field is required')]) }}
                    <div class="help-block"></div>
                    @if ($errors->has('name'))
                        <div class="help-block">  {{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('section_code') ? ' error' : '' }}">
                    {{ Form::label('name', trans('hrm::department.section_code') . " (". trans('labels.optional'). ") ") }}
                    {{ Form::text('section_code', null, ['class' => 'form-control', 'placeholder' => 'Section Code']) }}
                    <div class="help-block"></div>
                    @if ($errors->has('section_code'))
                        <div class="help-block">  {{ $errors->first('section_code') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="" class="required">@lang('hrm::department.department')</label>
                    <select class="select2 form-control required" name="department_id" required data-validation-required-message = "{{trans('validation.required', ['attribute'=> __('hrm::department.department')])}}">
                        <option value="">@lang('labels.select')</option>
                        @if(!is_null($departments))
                            @foreach($departments as $key=>$department)
                                <option value="{{$department->id}}"
                                        @if(isset($section) && $section->department_id == $department->id) selected @endif>{{$department->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="help-block"></div>
                    @if ($errors->has('department_id'))
                        <div class="help-block red">{{ $errors->first('department_id') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="share">@lang('hrm::department.section_head')</label>
                    <select class="select2 form-control required" name="section_head_employee_id">
                        <option value="">@lang('labels.select')</option>
                        @foreach($employees as $key=>$employee)
                            <option value="{{$key}}"
                                    @if(isset($section) && $section->section_head_employee_id == $key) selected @endif>{{$employee}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('section_head_employee_id'))
                        <div class="help-block red">{{ trans('labels.This field is required') }}</div>
                    @endif
                </div>

            </div>
            <div class="form-actions col-md-12 ">
                <div class="pull-right">
                    {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
                    <a href="{{ route('sections.index') }}">
                        <button type="button" class="btn btn-warning mr-1">
                            <i class="la la-times"></i> @lang('labels.cancel')
                        </button>
                    </a>

                </div>
            </div>
        </div>
    </div>

</div>