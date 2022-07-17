<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('first_name') ? ' error' : '' }}">
                    {{ Form::label('first_name', trans('labels.first_name'), ['class' => 'required'] ) }}
                    {{ Form::text(
                            'first_name',
                            null,
                            [
                                'class' => 'form-control form-control-sm',
                                'placeholder' => 'Jon',
                                'required' => 'required',
                                'data-msg-required'=>trans('labels.This field is required')
                            ]
                        )
                    }}
                    <div class="help-block"></div>
                    @if ($errors->has('first_name'))
                        <div class="help-block">  {{ $errors->first('first_name') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('first_name_bn') ? ' error' : '' }}">
                    {{ Form::label('first_name_bn', trans('labels.first_name_bn'), ['class' => 'required'] ) }}
                    {{ Form::text('first_name_bn', null, [
                        'class' => 'form-control form-control-sm required' . ($errors->has('first_name_bn') ? ' is-invalid' : ''),
                        'data-msg-required'=>trans('labels.This field is required'),
                        'placeholder' => 'জন',
                        'required' => 'required',
                        'data-rule-regex-bn' => config('regex.bn'),
                        'data-rule-maxlength' => 50,
                        'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                        'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                    ]) }}
                    <div class="help-block"></div>
                    @if ($errors->has('first_name_bn'))
                        <div class="help-block">  {{ $errors->first('first_name_bn') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('last_name') ? ' error' : '' }}">
                    {{ Form::label('last_name', trans('labels.last_name'), ['class' => 'required']) }}
                    {{ Form::text(
                            'last_name',
                            null,
                            [
                                'class' => 'form-control form-control-sm',
                                'placeholder' => 'Doe',
                                'required' => 'required',
                                'data-msg-required'=>trans('labels.This field is required')
                            ]
                        )
                    }}
                    <div class="help-block"></div>
                    @if ($errors->has('last_name'))
                        <div class="help-block">  {{ $errors->first('last_name') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('last_name_bn') ? ' error' : '' }}">
                    {{ Form::label('last_name_bn', trans('labels.last_name_bn'), ['class' => 'required']) }}
                    {{ Form::text('last_name_bn', null, [
                        'class' => 'form-control form-control-sm required' . ($errors->has('last_name_bn') ? ' is-invalid' : ''),
                        'data-msg-required'=>trans('labels.This field is required'),
                        'placeholder' => 'দো',
                        'required' => 'required',
                        'data-rule-regex-bn' => config('regex.bn'),
                        'data-rule-maxlength' => 50,
                        'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                        'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                    ]) }}
                    <div class="help-block"></div>
                    @if ($errors->has('last_name_bn'))
                        <div class="help-block">  {{ $errors->first('last_name_bn') }}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group {{ $errors->has('employee_id') ? ' error' : '' }}">
            {{ Form::label('employee_id', trans('hrm::employee_general_info.employee_id'), ['class' => 'required']) }}
            {{ Form::text(
                'employee_id',
                null,
                [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => '',
                    'required' => 'required',
                    'data-msg-required'=>trans('labels.This field is required')
                ]
               )
            }}
            <div class="help-block"></div>
            @if ($errors->has('employee_id'))
                <div class="help-block">  {{ $errors->first('employee_id') }}</div>
            @endif
        </div>
        <div class="form-group {{ $errors->has('department_id') ? ' error' : '' }}">
            {{ Form::label('department', trans('hrm::department.department'), ['class' => 'required']) }}
            {{ Form::select(
                'department_id',
                $employeeDepartments,
                null,
                [
                    'id'=> 'department_id',
                    'placeholder' => trans('labels.select'),
                    'class' => 'form-control form-control-sm select2',
                    'required' => 'required',
                    'data-msg-required'=>trans('labels.This field is required')
                ]
              )
            }}
            <div class="help-block"></div>
            @if ($errors->has('department_id'))
                <div class="help-block">  {{ $errors->first('department_id') }}</div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('section_id') ? ' error' : '' }}">
            {{ Form::label('section', trans('hrm::department.section_title'), []) }}
            {{ Form::select(
                'section_id',
                $sections,
                null,
                [
                    'id' => 'section_id',
                    'placeholder' => trans('labels.select'),
                    'class' => 'form-control form-control-sm select2'
                ]
                )
            }}
            <div class="help-block"></div>
        </div>

        <div class="form-group {{ $errors->has('designation_id') ? ' error' : '' }}">
            {{ Form::label('designation_id', trans('hrm::designation.designation'), ['class' => 'required']) }}
            {{ Form::select(
                'designation_id',
                $employeeDesignations,
                null,
                [
                    'placeholder' => trans('labels.select'),
                    'class' => 'form-control form-control-sm select2',
                    'required' => 'required',
                    'data-msg-required'=>trans('labels.This field is required')
                ]
              )
            }}
            <div class="help-block"></div>
            @if ($errors->has('designation_id'))
                <div class="help-block">  {{ $errors->first('designation_id') }}</div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('other_duties') ? ' error' : '' }}">
            {{ Form::label('other_duties', trans('hrm::employee_general_info.employee_other_duties')) }}
            {{Form::text(
                'other_duties',
                null,
                [
                    'class' => 'form-control form-control-sm'
                ]
              )
            }}
            <div class="help-block"></div>
            @if ($errors->has('status'))
                <div class="help-block">  {{ $errors->first('status') }}</div>
            @endif
        </div>


        <div class="form-group {{ $errors->has('gender') ? ' error' : '' }}">
            {{ Form::label('gender', trans('labels.gender'), ['class' => 'required']) }}
            {{ Form::select(
                'gender',
                Config::get('constants.gender'),
                null,
                [
                    'placeholder' => trans('labels.select'),
                    'class' => 'form-control form-control-sm select2',
                    'required' => 'required',
                    'data-msg-required'=>trans('labels.This field is required')
                ]
              )
            }}
            <div class="help-block"></div>
            @if ($errors->has('gender'))
                <div class="help-block">  {{ $errors->first('gender') }}</div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
            {{ Form::label('status', trans('hrm::employee_general_info.employee_current_status'), ['class' => 'required']) }}
            {{ Form::select(
                'status',
                Config::get('constants.employee_available_status'),
                null,
                [
                    'placeholder' => trans('labels.select'),
                    'class' => 'form-control form-control-sm select2',
                    'required' => 'required',
                    'data-msg-required'=>trans('labels.This field is required')
                ]
              )
            }}
            <div class="help-block"></div>
            @if ($errors->has('status'))
                <div class="help-block">  {{ $errors->first('status') }}</div>
            @endif
        </div>
        <div class="form-group {{ $errors->has('religion_id') ? ' error' : '' }}">
            {{ Form::label('religion_id', trans('hrm::employee.religion.title')) }}
            {{ Form::select(
                'religion_id',
                $employeeReligions,
                null,
                [
                    'placeholder' => trans('labels.select'),
                    'class' => 'form-control form-control-sm select2',
                ]
              )
            }}
            <div class="help-block"></div>
            @if ($errors->has('religion_id'))
                <div class="help-block">  {{ $errors->first('religion_id') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group" style="{{ !isset($employee) ? "margin-top: 120px;" : "margin-top: 30px;" }}">
            <h4 class="text-center"><label class="required">
                    @lang('hrm::employee_general_info.upload_employee_photo')
                    (@lang('hm::booking-request.maximum') @lang('hm::booking-request.size')
                    - @lang('hm::booking-request.3mb'))
                </label></h4>
            <div class="avatar-upload">
                <div class="avatar-edit">
                    {{ Form::file('photo',
                            [
                                'id' => 'imageUpload',
                                'class' => '' . $photoUrl ? '' : 'required',
                                'accept' => ".png, .jpg, .jpeg",
                                'data-msg-required' => trans('labels.Picture field is required')
                            ]
                        )
                    }}
                    <label for="imageUpload"></label>
                </div>
                <div class="avatar-preview">
                    <div id="imagePreview"
                         style="background-image: url({!! asset('images/default-profile-picture.png') !!});">
                    </div>
                </div>
                <div class="help-block"></div>
            </div>

        </div>
        <div class="form-group {{ $errors->has('email') ? ' error' : '' }}">
            {{ Form::label('email', trans('labels.email_address'), ['class' => 'required']) }}
            {{ Form::email(
                'email',
                null,
                [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'info@example.com',
                    'required' => 'required',
                    'data-msg-required'=>trans('labels.This field is required')
                ]
              )
            }}
            <div class="help-block"></div>
            @foreach ($errors->get('email') as $message)
                <div class="help-block">  {{ $message }}</div>
            @endforeach
        </div>
        <div class="form-group {{ $errors->has('tel_office') ? ' error' : '' }}">
            {{ Form::label('tel_office', trans('labels.tel_office')) }}
            {{ Form::number(
                'tel_office',
                null,
                [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => '02XXXXXXX',
                    'data-rule-maxlength' =>'11',
                    'data-msg-maxlength' => trans('labels.At least 11 characters')
                ]
              )
            }}
            <div class="help-block"></div>
            @foreach ($errors->get('tel_office') as $message)
                <div class="help-block">  {{ $message }}</div>
            @endforeach
        </div>

        <div class="form-group {{ $errors->has('tel_home') ? ' error' : '' }}">
            {{ Form::label('tel_home', trans('labels.tel_home')) }}
            {{ Form::number(
                'tel_home',
                null,
                [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => '02XXXXXXX',
                    'data-rule-maxlength' =>'11',
                    'data-msg-maxlength' => trans('labels.At least 11 characters')
                ]
              )
            }}
            <div class="help-block"></div>
            @foreach ($errors->get('tel_home') as $message)
                <div class="help-block">  {{ $message }}</div>
            @endforeach
        </div>

        <div class="form-group {{ $errors->has('mobile_one') ? ' error' : '' }}">
            {{ Form::label('mobile_one', trans('labels.mobile') . " (1)", ['class' => 'required']) }}
            {{ Form::number(
                'mobile_one',
                null,
                [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => '017XXXXXXXX',
                    'required' => 'required',
                    'data-msg-required'=> trans('labels.This field is required'),
                    'data-rule-number' => 'true',
                    'data-msg-number' => trans('labels.Please enter a valid number'),
                    'data-rule-minlength' =>'11',
                    'data-msg-minlength'=>trans('validation.minlength', ['attribute'=> __('labels.mobile'), 'min'=>11]),
                    'data-rule-maxlength' =>'11',
                    'data-msg-maxlength'=> trans('validation.maxlength', ['attribute'=> __('labels.mobile'), 'max'=>11])
                ])
            }}
            <div class="help-block"></div>
            @foreach ($errors->get('mobile_one') as $message)
                <div class="help-block">  {{ $message }}</div>
            @endforeach
        </div>

        <div class="form-group {{ $errors->has('mobile_two') ? ' error' : '' }}">
            {{ Form::label('mobile_two', trans('labels.mobile'). " (2)") }}
            {{ Form::number(
                'mobile_two',
                null,
                [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => '017XXXXXXXX',
                    'data-rule-number' => 'true',
                    'data-msg-number' => trans('labels.Please enter a valid number'),
                    'data-rule-minlength' =>'11',
                    'data-msg-minlength'=>trans('validation.minlength', ['attribute'=> __('labels.mobile'), 'min'=>11]),
                    'data-rule-maxlength' =>'11',
                    'data-msg-maxlength'=> trans('validation.maxlength', ['attribute'=> __('labels.mobile'), 'max'=>11])
                ]
              )
            }}
            <div class="help-block"></div>
            @foreach ($errors->get('mobile_two') as $message)
                <div class="help-block">  {{ $message }}</div>
            @endforeach
        </div>
        @if(isset($employee))
            <div class="form-group col-md-6">
                <label for="is_retired">@lang('hrm::retirement.is_retired')</label>
                <div class="skin skin-flat">
                    {{ Form::checkbox('is_retired', 1, isset($employee) ? ($employee->is_retired ? true : false) : false)  }}
                    <label>@lang('hrm::retirement.label')</label>
                </div>
                <div class="row col-md-12 radio-error">
                    @if ($errors->has('is_retired'))
                        <span class="small text-danger"><strong>{{ $errors->first('is_retired') }}</strong></span>
                    @endif
                </div>
            </div>
        @endif
    </div>


    <hr>
    {{ Form::hidden('id', null) }}
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
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imageUpload").change(function () {
                readURL(this);
            });

            let hrmEmployeeCreateFormGeneral = $('.hrm-employee-create-form-general');

            hrmEmployeeCreateFormGeneral.validate({
                ignore: 'input[type=hidden]',
                errorClass: "danger",
                successClass: "success",
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function (error, element) {

                    if (element.attr('type') === 'radio') {

                        error.insertBefore(element.parents().siblings('.radio-error'));

                    } else if (element[0].tagName === "SELECT") {

                        error.insertAfter(element.siblings('.select2-container'));

                    } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {

                        error.insertAfter(element.parents('.input-group'));

                    } else if(element.attr('type') === 'file') {

                        error.insertAfter(element.parent().parent().find('.avatar-preview'));

                    } else {

                        error.insertAfter(element);
                    }
                },
                rules: {},
                submitHandler: function (form, event) {
                    form.submit();
                }
            });
            jQuery.validator.addMethod(
                "regex-bn",
                function (value, element, params) {
                    let regex = new RegExp(params);
                    return value.match(params);
                },
                "{{ trans('tms::trainee.errors.messages.regex.bn') }}"
            );

        });

        $("#department_id").change(function () {
            var url = "{{url('hrm/get-sections-by-dept-id/')}}" ;
            $.get( url +'/'+ $('#department_id').val(), function (data) {
                $('#section_id').find('option').not(':first').remove();
                if(data.length > 0)
                {
                    for (i=0; i < data.length; i++)
                    {
                        $('#section_id').append(new Option(data[i]['name'], data[i]['id']));
                    }
                }
            });
        });

    </script>

@endpush
