@if($errors->trainingError->has('employee_id'))
    <div class="col-md-12">
        <div class="alert bg-danger alert-dismissible mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{$errors->trainingError->first('employee_id')}}
        </div>
    </div>
@endif
<div class="education-repeater">

    <div data-repeater-list="training">
        @php
            $oldTrainings = old();
        @endphp
        @if(isset($oldTrainings['training']) && count($oldTrainings['training'])>0)
            @foreach($oldTrainings['training'] as $key => $training)

                <div data-repeater-item="">
                    <div class="row">
                        <div class=" col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->trainingError->has("training.".$key.".course_name") ? ' error' : '' }}">
                                        <label class="required">{{ trans('hrm::training.course_name') }}</label>
                                        {{ Form::text(
                                            'course_name', 
                                            $training['course_name'], 
                                            [
                                                'class' => 'form-control form-control-sm required', 
                                                'placeholder' => 'eg. Microsoft Office Application', 
                                                'data-msg-required'=> trans('labels.This field is required')
                                            ]
                                         ) 
                                        }}
                                        <div class="help-block"></div>
                                        @if ($errors->trainingError->has("training.".$key.".course_name"))
                                            <div class="help-block">  {{trans('labels.This field is required')}}</div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->trainingError->has("training.".$key.".organization_name") ? ' error' : '' }}">
                                        <label class="required">{{ trans('hrm::training.institute_name') }}</label>
                                        {{ Form::text(
                                            'organization_name',
                                            $training['organization_name'],
                                            [
                                                'class' => 'form-control form-control-sm required',
                                                'placeholder' => 'eg. BARD',
                                                'data-msg-required'=>trans('labels.This field is required')
                                            ]
                                         )
                                        }}
                                        <div class="help-block"></div>
                                        @if ($errors->trainingError->has("training.".$key.".organization_name"))
                                            <div class="help-block"> {{trans('labels.This field is required')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->trainingError->has("training.".$key.".category") ? ' error' : '' }}">
                                        <label class="required">{{ trans('hrm::training.training_category') }}</label>
                                        {{ Form::text(
                                            'category',
                                            $training['category'],
                                            [
                                                'class' => 'form-control form-control-sm required',
                                                'placeholder' => trans('hrm::training.training_category'),
                                                'data-msg-required'=>trans('labels.This field is required')
                                            ]
                                          )
                                        }}
                                        <div class="help-block"></div>
                                        @if ($errors->trainingError->has("training.".$key.".category"))
                                            <div class="help-block">{{trans('labels.This field is required')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->trainingError->has("training.".$key.".duration") ? ' error' : '' }}">
                                        <label class="required">{{ trans('hrm::training.duration') }}</label>
                                        {{ Form::text(
                                            'duration',
                                            $training['duration'],
                                            [
                                                'class' => 'form-control form-control-sm required',
                                                'placeholder' => trans('hrm::training.duration_eg'),
                                                'data-msg-required'=>trans('labels.This field is required')
                                            ]
                                          )
                                        }}
                                         <div class="help-block"></div>
                                         @if ($errors->trainingError->has("training.".$key.".duration"))
                                             <div class="help-block">{{trans('labels.This field is required')}}</div>
                                         @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('hrm::training.training_year') }}</label>
                                        {{ Form::text(
                                            'training_year',
                                            $training['training_year'],
                                            [
                                                'class' => 'form-control form-control-sm',
                                                'placeholder' => 'e.g: 2018',
                                                'data-rule-number' => 'true',
                                                'data-rule-year-length' => '4',
                                                'data-msg-year-length' => trans('labels.Please enter a valid number'),
                                                'data-msg-number' => trans('labels.Please enter a valid number')
                                            ]
                                          )
                                        }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('hrm::training.result') }}</label>
                                        {{ Form::text(
                                            'result',
                                            $training['result'],
                                            [
                                                'class' => 'form-control form-control-sm',
                                                'placeholder' => 'CGPA / Grade / Division / Certificate name / Course Completed'
                                            ]
                                          )
                                        }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->trainingError->has("training.".$key.".region") ? ' error' : '' }}">
                                        <label class="required">{{ trans('hrm::training.region') }}</label>
                                        {{ Form::select(
                                            'region',
                                            Config::get('constants.hrm_employee_training.region'),
                                            $training['region'],
                                            [
                                                'class' => 'form-control form-control-sm required',
                                                'data-msg-required'=>trans('labels.This field is required')
                                            ]
                                          )
                                        }}
                                         <div class="help-block"></div>
                                         @if ($errors->trainingError->has("training.".$key.".region"))
                                             <div class="help-block"> {{trans('labels.This field is required')}}</div>
                                         @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('hrm::training.organization_country') }}</label>
                                        {{ Form::text(
                                            'organization_country',
                                            $training['organization_country'],
                                            [
                                                'class' => 'form-control form-control-sm',
                                                'placeholder' => 'eg. Bangladesh'
                                            ]
                                          )
                                        }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('hrm::training.organization_website') }}</label>
                                        {{ Form::url(
                                            'organization_website',
                                            $training['organization_website'],
                                            [
                                                'class' => 'form-control form-control-sm',
                                                'placeholder' => 'http://www.bs-23.net',
                                                'data-rule-url' => config('constants.regex.url'),
                                                'data-msg-url'=>trans('labels.invalid_url')
                                            ]
                                         )
                                        }}
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->trainingError->has("training.".$key.".nominating_authority") ? ' error' : '' }}">
                                        <label class="required">{{ trans('hrm::training.nominating_authority') }}</label>
                                        {{ Form::select(
                                            'nominating_authority',
                                            Config::get('constants.hrm_employee_training.nominating_authority'),
                                            $training->nominating_authority ?? null,
                                            [
                                                'class' => 'form-control form-control-sm required',
                                                'data-msg-required'=> trans('labels.This field is required')
                                            ]
                                          )
                                        }}
                                        <div class="help-block"></div>
                                        @if ($errors->trainingError->has("training.".$key.".nominating_authority"))
                                            <div class="help-block"> {{trans('labels.This field is required')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('hrm::training.achievement') }}</label>
                                        {{ Form::text(
                                            'achievement',
                                            $training['achievement'],
                                            [
                                                'class' => 'form-control form-control-sm',
                                                'placeholder' => 'eg. Best Performer'
                                            ]
                                          )
                                        }}
                                    </div>
                                </div>
                                {{ Form::hidden('employee_id', $employee_id, ['class' =>'EmployeeId']) }}
                                <hr>
                            </div>
                        </div>
                        <div class=" col-md-2">
                            <div class="form-group col-sm-12 col-md-2 mt-2">
                                <button type="button" class="btn btn-danger" data-repeater-delete=""><i
                                            class="ft-x"></i>
                                    {{trans('labels.remove')}}
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr style="border-bottom: 1px solid #1E9FF2">
                </div>
            @endforeach
        @elseif(count($employee->employeeTrainingInfo) > 0)
            @foreach($employee->employeeTrainingInfo as $training)
                <div data-repeater-item="">
                    <div class="row">
                        <div class=" col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">{{ trans('hrm::training.course_name') }}</label>
                                        {{ Form::text(
                                            'course_name',
                                            $training->course_name,
                                            [
                                                'class' => 'form-control form-control-sm required',
                                                'placeholder' => 'eg. Microsoft Office Application',
                                                'data-msg-required'=> trans('labels.This field is required')
                                            ]
                                         )
                                        }}
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">{{ trans('hrm::training.institute_name') }}</label>
                                        {{ Form::text(
                                            'organization_name',
                                            $training->organization_name,
                                            [
                                                'class' => 'form-control form-control-sm required',
                                                'placeholder' => 'eg. BARD',
                                                'data-msg-required'=>trans('labels.This field is required')
                                            ]
                                         )
                                        }}
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">{{ trans('hrm::training.training_category') }}</label>
                                        {{ Form::text(
                                            'category',
                                            $training->category,
                                            [
                                                'class' => 'form-control form-control-sm required',
                                                'placeholder' => trans('hrm::training.training_category'),
                                                'data-msg-required'=>trans('labels.This field is required')
                                            ]
                                          )
                                        }}
                                        <div class="help-block"></div>
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">{{ trans('hrm::training.duration') }}</label>
                                        {{ Form::text(
                                            'duration',
                                            $training->duration,
                                            [
                                                'class' => 'form-control form-control-sm required',
                                                'placeholder' => trans('hrm::training.duration_eg'),
                                                'data-msg-required'=>trans('labels.This field is required')
                                            ]
                                          )
                                        }}
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('hrm::training.training_year') }}</label>
                                        {{ Form::text(
                                            'training_year',
                                            $training->training_year,
                                            [
                                                'class' => 'form-control form-control-sm',
                                                'placeholder' => 'e.g: 2018',
                                                'data-rule-number' => 'true',
                                                'data-rule-year-length' => '4',
                                                'data-msg-year-length' => trans('labels.Please enter a valid number'),
                                                'data-msg-number' => trans('labels.Please enter a valid number')
                                            ]
                                          )
                                        }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('hrm::training.result') }}</label>
                                        {{ Form::text(
                                            'result',
                                            $training->result,
                                            [
                                                'class' => 'form-control form-control-sm',
                                                'placeholder' => 'CGPA / Grade / Division / Certificate name / Course Completed',
                                            ]
                                          )
                                        }}
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">{{ trans('hrm::training.region') }}</label>
                                        {{ Form::select(
                                            'region',
                                            Config::get('constants.hrm_employee_training.region'),
                                            $training->region,
                                            [
                                                'class' => 'form-control form-control-sm required',
                                                'data-msg-required'=>trans('labels.This field is required')
                                            ]
                                          )
                                        }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('hrm::training.organization_country') }}</label>
                                        {{ Form::text(
                                            'organization_country',
                                            $training->organization_country,
                                            [
                                                'class' => 'form-control form-control-sm',
                                                'placeholder' => 'eg. Bangladesh'
                                            ]
                                          )
                                        }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('hrm::training.organization_website') }}</label>
                                        {{ Form::url(
                                            'organization_website',
                                            $training['organization_website'],
                                            [
                                                'class' => 'form-control form-control-sm',
                                                'placeholder' => 'http://www.bs-23.net',
                                                'data-rule-url' => config('constants.regex.url'),
                                                'data-msg-url'=>trans('labels.invalid_url')
                                            ]
                                         )
                                        }}
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">{{ trans('hrm::training.nominating_authority') }}</label>
                                        {{ Form::select(
                                            'nominating_authority',
                                            Config::get('constants.hrm_employee_training.nominating_authority'),
                                            $training->nominating_authority,
                                            [
                                                'class' => 'form-control form-control-sm required',
                                                'data-msg-required'=> trans('labels.This field is required')
                                            ]
                                          )
                                        }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('hrm::training.achievement') }}</label>
                                        {{ Form::text(
                                            'achievement',
                                            $training['achievement'],
                                            [
                                                'class' => 'form-control form-control-sm',
                                                'placeholder' => 'eg. Best Performer'
                                            ]
                                          )
                                        }}
                                    </div>
                                </div>
                                {{ Form::hidden('employee_id', $training->employee_id, ['class' =>'EmployeeId']) }}
                                <hr>
                            </div>
                        </div>
                        <div class=" col-md-2">
                            <div class="form-group col-sm-12 col-md-2 mt-2">
                                <button type="button" class="btn btn-danger" data-repeater-delete=""><i
                                            class="ft-x"></i>
                                    {{trans('labels.remove')}}
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr style="border-bottom: 1px solid #1E9FF2">
                </div>
            @endforeach
        @else
            <div data-repeater-item="">
                <div class="row">
                    {{--<form class="form">--}}
                    <div class=" col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">{{ trans('hrm::training.course_name') }}</label>
                                    {{ Form::text(
                                        'course_name',
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm required',
                                            'placeholder' => 'eg. Microsoft Office Application',
                                            'data-msg-required'=> trans('labels.This field is required')
                                        ]
                                      )
                                    }}
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">{{ trans('hrm::training.institute_name') }}</label>
                                    {{ Form::text(
                                        'organization_name',
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm required',
                                            'placeholder' => 'eg. BARD',
                                            'data-msg-required'=>  trans('labels.This field is required')
                                        ]
                                      )
                                    }}
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">{{ trans('hrm::training.training_category') }}</label>
                                    {{ Form::text(
                                        'category',
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm required',
                                            'placeholder' => trans('hrm::training.training_category'),
                                            'data-msg-required'=>trans('labels.This field is required')
                                        ]
                                      )
                                    }}
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">{{ trans('hrm::training.duration') }}</label>
                                    {{ Form::text(
                                        'duration',
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm required',
                                            'placeholder' => trans('hrm::training.duration_eg'),
                                            'data-msg-required'=>trans('labels.This field is required')
                                        ]
                                      )
                                    }}
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('hrm::training.training_year') }}</label>
                                    {{ Form::text(
                                        'training_year',
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm',
                                            'placeholder' => 'e.g: 2018',
                                            'data-rule-number' => 'true',
                                            'data-rule-year-length' => '4',
                                            'data-msg-year-length' => trans('labels.Please enter a valid number'),
                                            'data-msg-number' => trans('labels.Please enter a valid number')
                                        ]
                                      )
                                    }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">{{ trans('hrm::training.result') }}</label>
                                    {{ Form::text(
                                        'result',
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm',
                                            'placeholder' => 'CGPA / Grade / Division / Certificate name / Course Completed',
                                        ]
                                      )
                                    }}
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('hrm::training.region') }}</label>
                                    {{ Form::select(
                                        'region',
                                        Config::get('constants.hrm_employee_training.region'),
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm',
                                        ]
                                      )
                                    }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('hrm::training.organization_country') }}</label>
                                    {{ Form::text(
                                        'organization_country',
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm',
                                            'placeholder' => 'eg. Bangladesh'
                                        ]
                                      )
                                    }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('hrm::training.organization_website') }}</label>
                                    {{ Form::url(
                                        'organization_website',
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm',
                                            'placeholder' => 'http://www.bs-23.net',
                                            'data-rule-url' => config('constants.regex.url'),
                                            'data-msg-url'=>trans('labels.invalid_url')
                                        ]
                                     )
                                    }}
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('hrm::training.nominating_authority') }}</label>
                                    {{ Form::select(
                                        'nominating_authority',
                                        Config::get('constants.hrm_employee_training.nominating_authority'),
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm',
                                        ]
                                      )
                                    }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('hrm::training.achievement') }}</label>
                                    {{ Form::text(
                                        'achievement',
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm',
                                            'placeholder' => 'eg. Best Performer'
                                        ]
                                     )
                                    }}
                                </div>
                            </div>
                            {{ Form::hidden('employee_id', $employee->id, ['class' =>'EmployeeId']) }}
                            <hr>
                        </div>
                    </div>
                    <div class=" col-md-2">
                        <div class="form-group col-sm-12 col-md-2 mt-2">
                            <button type="button" class="btn btn-danger" data-repeater-delete=""><i
                                        class="ft-x"></i>
                                {{trans('labels.remove')}}
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
        <button type="button" data-repeater-create="" class="btn btn-primary addMore"><i class="ft-plus"></i>
            {{trans('labels.add_more')}}
        </button>
    </div>
    <div class="form-actions col-md-12 ">
        <div class="pull-right">
            {{ Form::button('<i class="la la-check-square-o"></i> '.trans('labels.save'), ['type' => 'submit', 'id' => 'SubmitButton', 'class' => 'master btn btn-primary'] )  }}
            <a href="{{ route('employee.index') }}">
                <button type="button" class="master btn btn-warning mr-1"><i
                            class="la la-times"></i> {{trans('labels.cancel')}}</button>
            </a>
        </div>
    </div>
</div>
{{ Form::hidden('employee_id', isset($employee->id) ? $employee->id : null, ['class' =>'EmployeeId']) }}
@push('page-js')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.training-repeater').repeater({

                show: function () {
                    $(this).find('.select2-container').remove();
                    $(this).find('select').select2({
                        placeholder: selectPlaceholder
                    });

                    $('div:hidden[data-repeater-item]')
                        .find('input.is-invalid, select.is-invalid')
                        .each((index, element) => {
                            $(element).removeClass('is-invalid');
                        });

                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement)
                }
            });

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

            jQuery.validator.addMethod(
                "url",
                function (value, element, params) {
                    if(value.length === 0) {
                        return true;
                    }
                    return value.match(params);
                },
                'Letters only.'
            );

            let hrmEmployeeCreateFormTraining = $('.hrm-employee-create-form-training');

            hrmEmployeeCreateFormTraining.validate({
                ignore: 'input[type=hidden]',
                errorClass: 'danger',
                successClass: 'success',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function(error, element) {

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
                submitHandler: function(form, event) {
                    form.submit();
                }
            });

        });
    </script>
@endpush