<div class="form-body">
    <h4 class="form-section">
        <i class="ft-grid"></i>
        @lang('hrm::employee.religion.form.heading.title')
    </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('bengali_title') ? 'error' : '' }}">
                {{ Form::label(
                    'bengali_title',
                    trans('hrm::employee.religion.form.labels.bengali_title'),
                    [
                        'class' => 'required'
                    ]
                ) }}
                {{ Form::text(
                    'bengali_title',
                    (isset($religion) ? optional($religion)->bengali_title : null),
                    [
                        'class' => 'form-control required ' . ($errors->has('bengali_title') ? 'is-invalid' : ''),
                        'placeholder' => trans('hrm::employee.religion.form.labels.bengali_title'),
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength' => trans('labels.At most 255 characters'),
                        'data-msg-required' => trans('labels.This field is required'),
                    ]
                ) }}
                <div class="help-block"></div>
                @if($errors->has('bengali_title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('bengali_title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('english_title') ? 'error' : '' }}">
                {{ Form::label(
                    'english_title',
                    trans('hrm::employee.religion.form.labels.english_title'),
                    [
                        'class' => 'required'
                    ]
                ) }}
                {{ Form::text(
                    'english_title',
                    (isset($religion) ? optional($religion)->english_title : null),
                    [
                        'class' => 'form-control required ' . ($errors->has('english_title') ? 'is-invalid' : ''),
                        'placeholder' => trans('hrm::employee.religion.form.labels.english_title'),
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength' => trans('labels.At most 255 characters'),
                        'data-msg-required' => trans('labels.This field is required'),
                    ]
                ) }}
                <div class="help-block"></div>
                @if($errors->has('english_title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('english_title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('description') ? 'error' : '' }}">
                {{ Form::label(
                    'description',
                    trans('hrm::employee.religion.form.labels.description'),
                    [
                        'class' => ''
                    ]
                ) }}
                {{ Form::textarea(
                    'description',
                    (isset($religion) ? optional($religion)->description : null),
                    [
                        'class' => 'form-control ' . ($errors->has('description') ? 'is-invalid' : ''),
                        'placeholder' => trans('hrm::employee.religion.form.labels.description'),
                        'data-rule-maxlength' => 500,
                        'data-msg-maxlength' => trans('labels.At most 500 characters'),
                    ]
                ) }}
                <div class="help-block"></div>
                @if($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-actions col-md-12">
            <div class="pull-right">
                {{ Form::button(
                    '<i class="la la-check-square-o"></i>'.trans('labels.save'),
                    [
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    ]
                )}}
                <a href="{{ route('employees.religions.index') }}">
                    <button type="button" class="btn btn-warning mr-1">
                        <i class="la la-times"></i> @lang('labels.cancel')
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
