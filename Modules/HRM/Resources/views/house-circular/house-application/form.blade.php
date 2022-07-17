<div class="card-body">
    {!! Form::open(['route' => 'house-applications.store', 'class' => 'form house-application-form']) !!}
    <div id="invoice-items-details">
        <h4 class="form-section"><i
                class="ft-grid"></i>@lang('hrm::house-circular.application.title') @lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-6">
                {{Form::hidden('employee_id',optional(auth()->user()->employee)->id ?? null )}}

                <div class="form-group">
                {!! Form::label('name',  trans('labels.name'), ['class' => 'form-label required']) !!}
                {!! Form::text('name',  $employee->name ?? null,
                [
                    'class' => "form-control required",
                    'readonly',
                    'placeholder' => trans('labels.name'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                 ])!!}
                <!-- error message -->
                    @if ($errors->has('name'))
                        <div class="help-block text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('designation', trans('labels.designation'), ['class' => 'form-label required']) !!}
                {!! Form::text('designation',  $employee->designation ?? null,
                [
                    'class' => 'form-control required',
                     'readonly',
                    'placeholder' => trans('labels.designation'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                 ])!!}
                <!-- error message -->
                    @if ($errors->has('designation'))
                        <div class="help-block text-danger">
                            {{ $errors->first('designation') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('department', trans('labels.category'), ['class' => 'form-label required']) !!}
                {!! Form::text('department',  $employee->department ?? null,
                [
                    'class' => 'form-control required',
                     'readonly',
                    'placeholder' => trans('labels.category'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                 ])!!}
                <!-- error message -->
                    @if ($errors->has('department'))
                        <div class="help-block text-danger">
                            {{ $errors->first('department') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('salary_grade', trans('hrm::house-circular.application.salary_grade'), ['class' => 'form-label required']) !!}
                {!! Form::number('salary_grade',  $employee->salary_grade ?? null,
                [
                    'class' => 'form-control required',
                     'readonly',
                    'placeholder' => trans('hrm::house-circular.application.salary_grade'),
                    'data-msg-required'=> __('labels.This field is required'),
                 ])!!}
                <!-- error message -->
                    @if ($errors->has('salary_grade'))
                        <div class="help-block text-danger">
                            {{ $errors->first('salary_grade') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('salary_scale', trans('hrm::house-circular.application.salary_scale'), ['class' => 'form-label required']) !!}
                {!! Form::text('salary_scale',  $employee->salary_scale ?? null,
                [
                    'class' => 'form-control required',
                     'readonly',
                    'placeholder' => trans('hrm::house-circular.application.salary_scale'),
                    'data-msg-required'=> __('labels.This field is required'),
                 ])!!}
                <!-- error message -->
                    @if ($errors->has('salary_scale'))
                        <div class="help-block text-danger">
                            {{ $errors->first('salary_scale') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('salary', trans('hrm::house-circular.application.salary'), ['class' => 'form-label required']) !!}
                {!! Form::number('salary',  $employee->salary ?? null,
                [
                    'class' => 'form-control required',
                     'readonly',
                    'placeholder' => trans('hrm::house-circular.application.salary'),
                    'data-msg-required'=> __('labels.This field is required'),
                 ])!!}
                <!-- error message -->
                    @if ($errors->has('salary'))
                        <div class="help-block text-danger">
                            {{ $errors->first('salary') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('birth_date', trans('hrm::house-circular.application.birth_date'), ['class' => 'form-label required']) !!}
                {!! Form::text('birth_date',  $employee->birth_date ?? null,
                [
                    'class' => 'form-control required date',
                    'placeholder' => trans('hrm::house-circular.application.birth_date'),
                    'data-msg-required'=> __('labels.This field is required'),
                 ])!!}
                <!-- error message -->
                    @if ($errors->has('birth_date'))
                        <div class="help-block text-danger">
                            {{ $errors->first('birth_date') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('bard_joining_date', trans('hrm::house-circular.application.bard_join_date'), ['class' => 'form-label required']) !!}
                {!! Form::text('bard_joining_date',  $employee->bard_joining_date ?? null,
                [
                    'class' => 'form-control required date',
                    'placeholder' => trans('hrm::house-circular.application.bard_join_date'),
                    'data-msg-required'=> __('labels.This field is required'),
                 ])!!}
                <!-- error message -->
                    @if ($errors->has('bard_join_date'))
                        <div class="help-block text-danger">
                            {{ $errors->first('bard_join_date') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('current_position_date', trans('hrm::house-circular.application.current_position_date'), ['class' => 'form-label']) !!}
                {!! Form::text('current_position_date',  $employee->current_position_date ?? null,
                [
                    'class' => 'form-control date',
                     'readonly',
                    'placeholder' => trans('hrm::house-circular.application.current_position_date'),
                    'data-msg-required'=> __('labels.This field is required'),
                 ])!!}
                <!-- error message -->
                    @if ($errors->has('current_position_date'))
                        <div class="help-block text-danger">
                            {{ $errors->first('current_position_date') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('present_address', trans('hrm::house-circular.application.present_address'), ['class' => 'form-label required'])!!}
                {!! Form::textarea('present_address',  null,
                [
                    'rows' => 2,
                    'class' => 'form-control required',
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                    'placeholder' => trans('hrm::house-circular.application.present_address'),
                    'data-msg-required'=> __('labels.This field is required'),
                 ])!!}
                <!-- error message -->
                    @if ($errors->has('present_address'))
                        <div class="help-block text-danger">
                            {{ $errors->first('present_address') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('house_detail_id', trans('hrm::house-circular.application.house_no'), ['class' => 'form-label required'])!!}

                {!! Form::select('house_detail_id[]', $houseDetailDropdown->toArray(), null, [
                                               'class' => 'form-control select2 required',
                                               'multiple',
                                               'data-msg-required' => Lang::get('labels.This field is required'),
                       ])
               !!}
                <!-- error message -->
                    @if ($errors->has('house_details_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('house_details_id') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('dp_head_recommand', trans('hrm::house-circular.application.dp_head_recommand'), ['class' => 'form-label'])!!}
                {!! Form::textarea('dp_head_recommand',  null,
                [
                    'class' => 'form-control',
                    'rows' => 2,
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                    'placeholder' => trans('hrm::house-circular.application.dp_head_recommand'),
                 ])!!}
                <!-- error message -->
                    @if ($errors->has('dp_head_recommand'))
                        <div class="help-block text-danger">
                            {{ $errors->first('dp_head_recommand') }}
                        </div>
                    @endif
                </div>
                {{ Form::hidden('house_circular_id', $circularId) }}
            </div>
        </div>
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-primary">
            <i class="ft-check-square"></i>
            @lang('labels.save')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('house-categories.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
