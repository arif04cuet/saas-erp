@if($errors->educationError->has('employee_id'))
    <div class="col-md-12">
        <div class="alert bg-danger alert-dismissible mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert"
                    aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{$errors->educationError->first('employee_id')}}
        </div>
    </div>
@endif
<div class="education-repeater">
    <div data-repeater-list="education">
        @php
            $oldEducations = old();
        @endphp
        @if(isset($oldEducations['education']) && count($oldEducations['education'])>0)
            @foreach($oldEducations['education'] as $key => $education)
                <div data-repeater-item>
                    <div class="row">
                            <div class=" col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <section class="basic-select2">
                                            <div class="form-group {{ $errors->educationError->has("education.".$key.".academic_institute_id") ? ' error' : '' }}">
                                                <label class="required">{{ trans('hrm::education.institute_name') }}</label>
                                                <br/>
                                                {{ Form::select(
                                                'academic_institute_id',
                                                $institutes,
                                                $education['academic_institute_id'],
                                                [
                                                'class' => 'select2 form-control form-control-sm instituteSelection required',
                                                'placeholder' => trans('labels.select'),
                                                'data-msg-required'=>trans('labels.This field is required')
                                                ]
                                                )
                                                }}
                                                <div class="help-block"></div>
                                                @if ($errors->educationError->has("education.".$key.".academic_institute_id"))
                                                    <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                                @endif

                                            </div>
                                        </section>
                                    </div>

                                    <div class="help-block"></div>

                                    <div class="col-md-6 addOtherInstitute" style="display: {{ $education['academic_institute_id'] == "other" ? 'block' : 'none' }};">
                                        <div class="form-group ">
                                            <label class="required">{{ trans('hrm::education.other_institute_name') }}</label>
                                            <br/>
                                            {{ Form::text(
                                                'other_institute_name',
                                                 $education['academic_institute_id'] == "other" ? $education['other_institute_name'] : null,
                                                [
                                                    'placeholder' =>trans('labels.select'),
                                                    'id'=>'',
                                                    'class' => $education['academic_institute_id'] == "other" ? 'addInstituteInput form-control form-control-sm required' : 'addInstituteInput form-control form-control-sm',
                                                    'data-msg-required' => trans('labels.This field is required')
                                                ]
                                              )
                                            }}

                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->educationError->has("education.".$key.".academic_department_id") ? ' error' : '' }}">
                                            <label class="required">{{ trans('hrm::education.department_section_group') }}</label>
                                            {{ Form::select(
                                            'academic_department_id',
                                            $academicDepartments,
                                            $education['academic_department_id'],
                                            [
                                            'class' => 'form-control form-control-sm select2 academicDepartmentSelect',
                                            'placeholder' => trans('labels.select'),
                                            'required' => 'required',
                                            'data-msg-required'=> trans('labels.This field is required')
                                            ]
                                            )
                                            }}
                                            <div class="help-block"></div>
                                            @if ($errors->educationError->has("education.".$key.".academic_department_id"))
                                                <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 addDepartmentSection" style="display: {{ $education['academic_department_id'] == "other_department" ? 'block' : 'none' }};">
                                        <div class="form-group ">
                                            <label class="required">{{ trans('hrm::education.other_department') }}</label>
                                            <br/>
                                            {{ Form::text(
                                                'other_department_name',
                                                $education['academic_department_id'] == "other_department" ? $education['other_department_name'] : null,
                                                [
                                                    'id'=>'',
                                                    'class' => $education['academic_department_id'] == "other_department" ? 'addDepartmentInput form-control form-control-sm required' : 'addDepartmentInput form-control form-control-sm',
                                                    'placeholder' => 'Enter Your Institute Name',
                                                    'data-msg-required' => trans('labels.This field is required')
                                                ]
                                             )
                                           }}

                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->educationError->has("education.".$key.".academic_degree_id") ? ' error' : '' }}">
                                            <label class="required">{{ trans('hrm::education.degree_name') }}</label>
                                            {{ Form::select(
                                            'academic_degree_id',
                                            $academicDegree,
                                            $education['academic_degree_id'],
                                            [
                                            'class' => 'form-control form-control-sm select2 academicDegreeSelect',
                                            'placeholder' => trans('labels.select'),
                                            'required' => 'required',
                                            'data-msg-required' => trans('labels.This field is required')
                                            ]
                                            )
                                            }}
                                            <div class="help-block"></div>
                                            @if ($errors->educationError->has("education.".$key.".academic_degree_id"))
                                                <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 addDegreeSection" style="display: {{ $education['academic_degree_id'] == "other_degree" ? 'block' : 'none' }};">
                                        <div class="form-group ">
                                            <label class="required"> {{ trans('hrm::education.other_degree') }} </label>
                                            {{ Form::text(
                                                'other_degree_name',
                                                $education['academic_degree_id'] == "other_degree" ? $education['other_degree_name'] : null,
                                                [
                                                    'id'=>'',
                                                    'class' => $education['academic_degree_id'] == "other_degree" ? 'addDegreeInput form-control form-control-sm required' : 'addDegreeInput form-control form-control-sm',
                                                    'placeholder' => 'Enter Your degree Name',
                                                    'data-msg-required' => trans('labels.This field is required')
                                                ]
                                              )
                                            }}

                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->educationError->has("education.".$key.".passing_year") ? ' error' : '' }}">
                                            <label class="required">{{ trans('hrm::education.passing_year') }}</label>
                                            {{ Form::text(
                                            'passing_year',
                                            null,
                                            [
                                                'id' => 'passing_year',
                                                'class' => 'form-control form-control-sm required',
                                                'placeholder' => 'e.g: 2015',
                                                'data-rule-number' => 'true',
                                                'data-rule-year-length' => '4',
                                                'data-msg-required'=>trans('labels.This field is required'),
                                                'data-msg-year-length' => trans('labels.Please enter a valid number'),
                                                'data-msg-number' => trans('labels.Please enter a valid number')

                                            ]) }}
                                            <div class="help-block"></div>
                                            @if ($errors->educationError->has("education.".$key.".passing_year"))
                                                <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="required">{{ trans('hrm::education.medium') }}</label>
                                            {{ Form::select(
                                            'medium',
                                            Config('constants.employee_education_medium'),
                                            $education['medium'],
                                            [
                                            'placeholder' =>trans('labels.select'),
                                            'class' => 'form-control form-control-sm select2'
                                            ]
                                            )
                                            }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->educationError->has("education.".$key.".duration") ? ' error' : '' }}">
                                            <label class="required">{{ trans('hrm::education.duration') }}</label>
                                            {{ Form::select(
                                            'duration',
                                            $academicDurations,
                                            $education['duration'],
                                            [
                                            'class' => 'form-control form-control-sm',
                                            'placeholder' =>trans('labels.select'),
                                            'required' => 'required',
                                            'data-msg-required'=>trans('labels.This field is required')
                                            ]
                                            )
                                            }}

                                            <div class="help-block"></div>
                                            @if ($errors->educationError->has("education.".$key.".duration"))
                                                <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->educationError->has("education.".$key.".result") ? ' error' : '' }}">
                                            <label class="required">{{ trans('hrm::education.result') }}</label>
                                            {{ Form::text(
                                            'result',
                                            $education['result'],
                                            [
                                            'class' => 'form-control form-control-sm',
                                            'placeholder' => 'CGPA / Grade / Division',
                                            'required' => 'required',
                                            'data-msg-required' => trans('labels.This field is required')
                                            ]
                                            )
                                            }}
                                            <div class="help-block"></div>
                                            @if ($errors->educationError->has("education.".$key.".result"))
                                                <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required">{{ trans('hrm::education.achievement') }}</label>
                                            {{ Form::text(
                                            'achievement',
                                            $education['achievement'],
                                            [
                                            'class' => 'form-control form-control-sm',
                                            'placeholder' => 'eg. President Gold Medal'
                                            ]
                                            )
                                            }}
                                        </div>
                                    </div>
                                    {{ Form::hidden('id', isset($education['id']) ? $education['id'] : null   ) }}
                                    {{ Form::hidden('employee_id', isset($education['employee_id']) ? $education['employee_id'] : null, ['class' =>'EmployeeId']) }}
                                    <hr>
                                </div>
                            </div>

                            <div class=" col-md-2">
                                <div class="form-group col-sm-12 col-md-2 mt-2">
                                    <button type="button" class="btn btn-danger" data-repeater-delete=""><i
                                                class="ft-x"></i>
                                        @lang('labels.remove')
                                    </button>
                                </div>
                            </div>
                    </div>
                    <hr style="border-bottom: 1px solid #1E9FF2">

                </div>
            @endforeach
        @else
            <div data-repeater-item>
                <div class="row">
                    {{--<form class="form">--}}
                    <div class=" col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <section class="basic-select2">
                                    <div class="form-group">
                                        <label class="required">{{ trans('hrm::education.institute_name') }}</label>
                                        <br/>
                                        {{ Form::select(
                                            'academic_institute_id',
                                            $institutes,
                                            null,
                                            [
                                                'placeholder' =>trans('labels.select'),
                                                'class' => 'select2 form-control form-control-sm instituteSelection',
                                                'required' => 'required',
                                                'data-msg-required'=> trans('labels.This field is required')
                                            ]
                                          )
                                        }}

                                        <div class="help-block"></div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-6 addOtherInstitute" style="display: none;">
                                <div class="form-group ">
                                    <label class="required">{{ trans('hrm::education.other_institute_name') }}</label>
                                    <br/>
                                    {{ Form::text(
                                        'other_institute_name',
                                         null,
                                        [
                                            'placeholder' =>trans('labels.select'),
                                            'id'=>'',
                                            'class' => 'addInstituteInput form-control form-control-sm',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                      )
                                    }}

                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">{{ trans('hrm::education.department_section_group') }}</label>
                                    {{ Form::select(
                                        'academic_department_id',
                                        $academicDepartments, null,
                                        [
                                            'placeholder' =>trans('labels.select'),
                                            'class' => 'select2 academicDepartmentSelect form-control form-control-sm',
                                            'required' => 'required',
                                            'data-msg-required'=>trans('labels.This field is required')
                                        ]
                                      )
                                    }}
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6 addDepartmentSection" style="display: none;">
                                <div class="form-group ">
                                    <label class="required">{{ trans('hrm::education.other_department') }}</label>
                                    <br/>
                                    {{ Form::text(
                                        'other_department_name',
                                        null,
                                        [
                                            'id'=>'',
                                            'class' => 'addDepartmentInput form-control form-control-sm',
                                            'placeholder' => 'Enter Your Institute Name',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                     )
                                   }}

                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">{{ trans('hrm::education.degree_name') }}</label>
                                    {{ Form::select(
                                        'academic_degree_id',
                                        $academicDegree,
                                        null,
                                        [
                                            'placeholder' =>trans('labels.select'),
                                            'class' => 'select2 form-control form-control-sm academicDegreeSelect',
                                            'required' => 'required',
                                            'data-msg-required'=>trans('labels.This field is required')
                                        ]
                                      )
                                    }}
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-md-6 addDegreeSection" style="display: none;">
                                <div class="form-group ">
                                    <label class="required"> {{ trans('hrm::education.other_degree') }} </label>
                                    {{ Form::text(
                                        'other_degree_name',
                                        null,
                                        [
                                            'id'=>'',
                                            'class' => 'addDegreeInput form-control form-control-sm',
                                            'placeholder' => 'Enter Your degree Name',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                      )
                                    }}

                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">{{ trans('hrm::education.passing_year') }}</label>
                                    {{ Form::text(
                                            'passing_year',
                                            null,
                                            [
                                                'id' => 'passing_year',
                                                'class' => 'form-control form-control-sm required',
                                                'placeholder' => 'e.g: 2015',
                                                'data-rule-number' => 'true',
                                                'data-rule-year-length' => '4',
                                                'data-msg-required'=>trans('labels.This field is required'),
                                                'data-msg-year-length' => trans('labels.Please enter a valid number'),
                                                'data-msg-number' => trans('labels.Please enter a valid number')
                                            ]
                                          )
                                    }}

                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('hrm::education.medium') }}</label>
                                    {{ Form::select(
                                        'medium',
                                        Config('constants.employee_education_medium'),
                                        null,
                                        [
                                            'placeholder' =>trans('labels.select'),
                                            'class' => 'form-control form-control-sm select2'
                                        ]
                                      )
                                    }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">{{ trans('hrm::education.duration') }}</label>
                                    {{ Form::select(
                                        'duration',
                                        $academicDurations,
                                        null,
                                        [
                                            'placeholder' =>trans('labels.select'),
                                            'class' => 'form-control form-control-sm select2',
                                            'required' => 'required',
                                            'data-msg-required'=>trans('labels.This field is required')
                                        ]
                                      )
                                    }}
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">{{ trans('hrm::education.result') }}</label>
                                    {{ Form::text(
                                        'result',
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm',
                                            'placeholder' => 'CGPA / Grade / Division',
                                            'required' => 'required',
                                            'data-msg-required'=>trans('labels.This field is required')
                                        ]
                                      )
                                    }}
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('hrm::education.achievement') }}</label>
                                    {{ Form::text(
                                        'achievement',
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm', '
                                            placeholder' => 'eg. President Gold Medal'
                                        ]
                                      )
                                    }}
                                </div>
                            </div>
                            {{ Form::hidden('employee_id', isset($employee_id) ? $employee_id : null, ['class' =>'EmployeeId']) }}
                            <hr>
                        </div>
                    </div>
                    <div class=" col-md-2">
                        <div class="form-group col-sm-12 col-md-2 mt-2">
                            <button type="button" class="btn btn-danger" data-repeater-delete=""><i class="ft-x"></i>
                                @lang('labels.remove')
                            </button>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid #1E9FF2">
            </div>
            @endif
    </div>
    {{--form repeater end--}}
    <div class="col-md-12">
        <button type="button" data-repeater-create="" class="master btn btn-primary addMore"><i
                    class="ft-plus"></i> @lang('labels.add_more')
        </button>
    </div>
    <div class="form-actions col-md-12 ">
        <div class="pull-right">
            {{ Form::button('<i class="la la-check-square-o"></i>'. trans('labels.save'), ['type' => 'submit', 'id' => 'SubmitButton', 'class' => 'master btn btn-primary'] )  }}
            <a href="{{ route('employee.index') }}">
                <button type="button" class="master btn btn-warning mr-1"><i class="la la-times"></i> @lang('labels.cancel')
                </button>
            </a>
        </div>
    </div>
</div>
{{ Form::hidden('employee_id', isset($employee_id) ? $employee_id : null, ['class' =>'EmployeeId']) }}
@push('page-js')
    <script>

        $(document).ready(function () {


            $(" .instituteSelection, .academicDepartmentSelect, .academicDegreeSelect").select2({
                placeholder:selectPlaceholder,
                width: '100%'
            }).on('change', function() {
                var value = $(this).val();

                switch (true) {
                    case $(this).hasClass('instituteSelection'):
                        if (value === 'other') {
                            $(this).parent().parent().parent().next('.addOtherInstitute').show();
                            $(this).parent().parent().parent().next('.addOtherInstitute').find('.addInstituteInput').focus().addClass('required');
                        } else {
                            $(this).parent().parent().parent().next('.addOtherInstitute').find('.addInstituteInput').removeClass('required');
                            $(this).parent().parent().parent().next('.addOtherInstitute').hide();
                        }
                        break;
                    case $(this).hasClass('academicDepartmentSelect'):
                        if (value === 'other_department') {
                            $(this).parent().parent().next('.addDepartmentSection').show();
                            $(this).parent().parent().next('.addDepartmentSection').find('.addDepartmentSection').focus().addClass('required');
                        } else {
                            $(this).parent().parent().next('.addDepartmentSection').find('.addDepartmentSection').removeClass('required');
                            $(this).parent().parent().next('.addDepartmentSection').hide();
                        }
                        break;
                    case $(this).hasClass('academicDegreeSelect'):
                        if (value === 'other_degree') {
                            $(this).parent().parent().next('.addDegreeSection').show();
                            $(this).parent().parent().next('.addDegreeSection').find('.addDegreeInput').focus().addClass('required');
                        } else {
                            $(this).parent().parent().next('.addDegreeSection').find('.addDegreeInput').removeClass('required');
                            $(this).parent().parent().next('.addDegreeSection').hide();
                        }
                        break;
                    default:
                        console.log('Default');
                        break;
                }
            });

            // $('.instituteSelection').on('select2:select', function (e) {
            //     var value = $(".instituteSelection option:selected").val();
            //     if (value === 'other') {
            //         $(".addOtherInstitute").show();
            //         $(".addInstituteInput").focus().addClass('required');
            //     } else {
            //         $(".addInstituteInput").removeClass('required');
            //         $(".addOtherInstitute").hide();
            //
            //     }
            // });
            //
            // $('.academicDepartmentSelect').on('select2:select', function (e) {
            //     var value = $(".academicDepartmentSelect option:selected").val();
            //     if (value === 'other_department') {
            //         $(".addDepartmentSection").show();
            //         $(".addDepartmentInput").focus().addClass('required');
            //     } else {
            //         $(".addDepartmentInput").removeClass('required');
            //         $(".addDepartmentSection").hide();
            //     }
            // });
            // $('.academicDegreeSelect').on('select2:select', function (e) {
            //     var value = $(".academicDegreeSelect option:selected").val();
            //     if (value === 'other_degree') {
            //         $(".addDegreeSection").show();
            //         $(".addDegreeInput").focus().addClass('required');
            //     } else {
            //         $(".addDegreeInput").removeClass('required');
            //         $(".addDegreeSection").hide();
            //
            //     }
            // });
            $('.education-repeater').repeater({
                show: function () {
                    $(this).find('.select2-container').remove();
                    $(this).find('select').select2({
                        placeholder: selectPlaceholder
                    }).on('change', function () {

                        var value = $(this).val();

                        switch (true) {
                            case $(this).hasClass('instituteSelection'):
                                if(value === 'other') {
                                    $(this).parent().parent().parent().next('.addOtherInstitute').show();
                                    $(this).parent().parent().parent().next('.addOtherInstitute').find('.addInstituteInput').focus().addClass('required');
                                }else {
                                    $(this).parent().parent().parent().next('.addOtherInstitute').find('.addInstituteInput').removeClass('required');
                                    $(this).parent().parent().parent().next('.addOtherInstitute').hide();
                                }
                                break;
                            case $(this).hasClass('academicDepartmentSelect'):
                                if(value === 'other_department') {
                                    $(this).parent().parent().next('.addDepartmentSection').show();
                                    $(this).parent().parent().next('.addDepartmentSection').find('.addDepartmentSection').focus().addClass('required');
                                }else {
                                    $(this).parent().parent().next('.addDepartmentSection').find('.addDepartmentSection').removeClass('required');
                                    $(this).parent().parent().next('.addDepartmentSection').hide();
                                }
                                break;
                            case $(this).hasClass('academicDegreeSelect'):
                                if(value === 'other_degree') {
                                    $(this).parent().parent().next('.addDegreeSection').show();
                                    $(this).parent().parent().next('.addDegreeSection').find('.addDegreeInput').focus().addClass('required');
                                }else {
                                    $(this).parent().parent().next('.addDegreeSection').find('.addDegreeInput').removeClass('required');
                                    $(this).parent().parent().next('.addDegreeSection').hide();
                                }
                                break;
                            default:
                                console.log('Default');
                                break;
                        }

                    });

                    // remove error span
                    $('div:hidden[data-repeater-item]')
                        .find('input.is-invalid, select.is-invalid')
                        .each((index, element) => {
                            $(element).removeClass('is-invalid');
                        });

                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        })
    </script>

    <script type="text/javascript">

        $(document).ready(function () {

            jQuery.validator.addMethod(
                "year-length",
                function (value, element, params) {

                    let validLength = parseInt(params);

                    if(value.length === 0) {
                        return true;
                    }

                    return value.length === validLength && parseInt(value) > 0;
                },
                'Year should be a 4 digit number'
            );

            let hrmEmployeeCreateFormEducation = $('.hrm-employee-create-form-education');

            hrmEmployeeCreateFormEducation.validate({
                ignore: 'input[type=hidden]',
                errorClass: 'danger',
                successClass: 'success',
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

                    } else if (element.attr('type') === 'file') {

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

        });

    </script>
@endpush


