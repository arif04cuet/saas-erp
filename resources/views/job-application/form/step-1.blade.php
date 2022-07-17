<h6>{{ trans('hm::booking-request.step_1') }}</h6>
<fieldset>
<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> Job Application Form </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="form-label">
                    @lang('labels.digits.1',[],'en'). @lang('job-application.job_post_title',[],'en') :
                    <label class="content-header-title font-weight-bold">{{$jobCircular->title}}</label>
                </label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="title" class="form-label">
                    @lang('labels.digits.2',[],'en'). @lang('job-application.job_circular_number',[],'en'):
                </label>
                <label class="content-header-title font-weight-bold">{{$jobCircular->unique_id}}</label>
                {{ Form::hidden('circular_no', $jobCircular->id) }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="circular_date" class="form-label">
                    @lang('labels.digits.3',[],'en') @lang('hrm::circular.application_deadline',[],'en')
                    :</label>
                <label class="content-header-title font-weight-bold">
                    {{\App\Utilities\MonthNameConverter::convertMonthToBn($jobCircular->application_deadline, false, true)}}
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- designation -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="circular_date" class="form-label required">
                    @lang('labels.digits.4',[],'en') @lang('labels.designation',[],'en') :
                </label>
                {{ Form::select('job_circular_detail_id', $jobCircularDetails ?? [], null,
                                         [
                                             'placeholder' => trans('labels.select',[],'en'),
                                             'id'=>'job_circular_detail_id',
                                             'onchange'=>'changeBirthDateValidation()',
                                             'class' => 'form-control required select2'.($errors->has('job_circular_detail_id') ? ' is-invalid' : ''),
                                             'data-msg-required' => trans('validation.required',
                                         ['attribute' => trans('job-application.district')]),
                                         ])
                 }}
                <div class="job_circular_detail_id text-danger"></div>
            </div>
        </div>
    </div>

    <!-- candidate name -->
    <div class="row">
        <div class="col-md-12">
            <fieldset class="col-md-12 scheduler-border">
                <legend class="scheduler-border">
                    <h5 class="font-weight-bold">
                        @lang('labels.digits.5',[],'en'). @lang('job-application.job_applicant_name',[],'en')</h5>
                </legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('applicant_name_bn',  trans('job-application.job_applicant_name_bn',[],'en'), ['class' => 'form-label required'] ) }}
                            {{ Form::text('applicant_name_bn', null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => '',
                                    'required' => 'required',
                                    'data-msg-required' => trans('validation.required', ['attribute' => trans('job-application.job_applicant_name_bn')])
                                ])
                            }}
                            <div class="applicant_name_bn_err text-danger"></div>
                            <div class="help-block"></div>
                            @if ($errors->has('applicant_name_bn'))
                                <div class="help-block red"><strong>{{ $errors->first('applicant_name_bn') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('job_applicant_name_en', trans('job-application.job_applicant_name_en',[],'en'), ['class' => 'form-label required'] ) }}
                            {{ Form::text('applicant_name', null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => '',
                                    'required' => 'required',
                                    'data-msg-required' => trans('validation.required', ['attribute' => trans('job-application.job_applicant_name_en')])
                                ])
                            }}
                            <div class="applicant_name_en_err text-danger"></div>
                            <div class="help-block"></div>
                            @if ($errors->has('applicant_name'))
                                <div class="help-block red"><strong>{{ $errors->first('applicant_name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-12">
            <fieldset class="col-md-12 scheduler-border">
                <legend class="scheduler-border"><h5 class="font-weight-bold">@lang('labels.digits.6',[],'en')
                        . @lang('labels.nid_number',[],'en')
                        /@lang('job-application.job_applicant_birth_certificate_no',[],'en')
                        (@lang('job-application.any_one',[],'en')
                        )</h5>
                </legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('nid_number', trans('labels.nid_number',[],'en'), ['class' => 'form-label'] ) }}
                            {{ Form::text('national_id', null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => '',
                                    'data-rule-number' => 'true',
                                    'data-msg-number' => trans('labels.Please enter a valid number'),
                                    'data-rule-nid-validation-count' => '10,13,17',
                                    'data-msg-nid-validation-count' => trans('labels.nid_validation_count_error_msg'),
                                    /*'data-rule-regex' => '/^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)$/',*/
                                    'min' => 1,
                                    'data-msg-min' => trans('labels.Please enter a valid number'),
                                ])
                            }}
                            <div class="err-msg text-danger"></div>
                            <div class="help-block"></div>
                            @if ($errors->has('national_id'))
                                <div class="help-block red">{{ $errors->first('national_id') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('birth_certificate_no', trans('job-application.job_applicant_birth_certificate_no',[],'en'), ['class' => 'form-label'] ) }}
                            {{ Form::number('birth_certificate_no', null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => '',
                                    'data-msg-number' => trans('labels.Please enter a valid number'),
                                    'min' => 1,
                                    'data-msg-min' => trans('labels.Please enter a valid number'),
                                ])
                            }}
                            <div class="help-block"></div>
                            @if ($errors->has('birth_certificate_no'))
                                <div class="help-block red">{{ $errors->first('birth_certificate_no') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <!-- divisional candidate -->
    <div class="col-md-12">
        <fieldset class="col-md-12 scheduler-border">
            <legend class="scheduler-border  required  ">
                <h5 class="font-weight-bold">
                    @lang('labels.digits.7',[],'en'). @lang('job-application.divisional_candidate',[],'en')
                    <span class="font-medium-5 font-weight-bold" style="color:red"> *</span>
                </h5>
            </legend>


            <div class="row">
                <div class="col-md-4">
                    <div class="skin skin-flat">
                        <fieldset>
                            {!! Form::radio('is_divisional_applicant', '1', false,
                                [
                                    'class' => 'required',
                                    'data-msg-required' => Lang::get('labels.This field is required')
                                ])

                            !!}
                            <label>@lang('labels.yes',[],'en')</label>
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="skin skin-flat">
                        <fieldset>
                            {!! Form::radio('is_divisional_applicant', '0', false, ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                            <label>{{ trans('labels.no',[],'en') }}</label>
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="skin skin-flat">
                        <fieldset>
                            {!! Form::radio('is_divisional_applicant', '2',  false, ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                            <label>{{ trans('labels.not_applicable',[],'en') }}</label>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="is_divisional_applicant_err text-danger"></div>
            <div class="row radio-error"></div>
            @if ($errors->has('is_divisional_applicant'))
                <div class="small danger">
                    <strong>{{ $errors->first('is_divisional_applicant') }}</strong>
                </div>
            @endif
        </fieldset>
    </div>
    <!-- quota field -->
    <div class="col-md-12">
        <fieldset class="col-md-12 scheduler-border">
            <legend class="scheduler-border">
                <h5 class="font-weight-bold">@lang('labels.digits.8',[],'en')
                    . @lang('job-application.quota',[],'en')</h5>
            </legend>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="quota" value="freedom_fighter_quota">
                            @lang('job-application.freedom_fighter_quota',[],'en')
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="quota" value="disabled_quota">
                            @lang('job-application.disabled_quota',[],'en')
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="quota"
                                                           value="tribal_quota"> @lang('job-application.tribal_quota',[],'en')
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="quota"
                                                           value="ansar_quota"> @lang('job-application.ansar_quota',[],'en')
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="quota"
                                                           value="others_quota"> @lang('job-application.others_quota',[],'en')
                        </label>
                        <input type="text" name="others_quota" id="other_quota"
                               placeholder="{{__('job-application.quota_details',[],'en')}}" class="form-control">
                    </div>
                </div>
            </div>
            @if ($errors->has('quota'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('quota') }}</strong></span>
            @endif
        </fieldset>
    </div>
    <!-- Birth Place, Date , Circular Date -->
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="applicant_birth_place" class="form-label required">
                    @lang('labels.digits.9',[],'en')
                    . @lang('job-application.job_applicant_birth_place',[],'en')</label>
                {{ Form::select('birth_place', $districts->pluck('name', 'name'), null,
                    [
                        'class' => 'form-control select2',
                        'placeholder' => trans('labels.select',[],'en'),
                        'required' => 'required',
                        'data-msg-required' => trans('validation.required', ['attribute' => trans('job-application.job_applicant_birth_place')]),
                    ])
                }}
                <div class="birth_place_err text-danger"></div>
                <div class="help-block"></div>
                @if ($errors->has('birth_place'))
                    <div class="help-block">{{ $errors->first('birth_place') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="birth_date" class="form-label required">
                    @lang('labels.digits.10',[],'en')
                    . @lang('job-application.job_applicant_birth_date',[],'en')</label>
                {{ Form::text('birth_date', null,
                    [
                        'class' => 'form-control',
                        'id' => 'birth_date',
                        'placeholder' => '',
                        'required' => 'required',
                        'data-msg-required' => trans('validation.required', ['attribute' => trans('job-application.job_applicant_birth_date')]),
                    ])
                }}
                {{ Form::hidden('', $jobCircular->created_at, ['id' => 'circular_date']) }}
                <div class="birth_date_err text-danger"></div>
                <div class="help-block"></div>
                @if ($errors->has('birth_date'))
                    <div class="help-block red">{{ $errors->first('birth_date') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="age" class="form-label required">
                    @lang('labels.digits.11',[],'en')
                    . @lang('job-application.job_applicant_age_on_circular_date',[],'en')</label>
                <label class="form-control" id="age"> ...</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="form-label required">@lang('labels.digits.12',[],'en')
                    . @lang('job-application.job_applicant_father_name',[],'en')</label>
                {{ Form::text('father_name', null,
                    [
                        'class' => 'form-control',
                        'placeholder' => '',
                        'required' => 'required',
                        'data-msg-required' => trans('validation.required', ['attribute' => trans('job-application.job_applicant_father_name')]),
                    ])
                }}
                <div class="father_name_err text-danger"></div>
                <div class="help-block"></div>
                @if ($errors->has('father_name'))
                    <div class="help-block red">{{ $errors->first('father_name') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="applicant_birth_place" class="form-label required">@lang('labels.digits.13',[],'en')
                    . @lang('job-application.job_applicant_mother_name',[],'en')</label>
                {{ Form::text('mother_name', null,
                    [
                        'class' => 'form-control',
                        'placeholder' => '',
                        'required' => 'required',
                        'data-msg-required' => trans('validation.required', ['attribute' => trans('job-application.job_applicant_mother_name')]),
                    ])
                }}
                <div class="mother_name_err text-danger"></div>
                <div class="help-block"></div>
                @if ($errors->has('mother_name'))
                    <div class="help-block red">{{ $errors->first('mother_name') }}</div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label class="form-label required bold">
                @lang('labels.digits.14',[],'en') . @lang('labels.address',[],'en')
            </label>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">@lang('job-application.present',[],'en')</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label required">@lang('job-application.care_of',[],'en')</label>
                                    {{ Form::hidden('address_type[0]', 'present_address') }}
                                    {{ Form::text('care_of[0]', null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'required' => 'required',
                                            'data-msg-required' => trans('validation.required', ['attribute' => trans('job-application.care_of')]),
                                        ])
                                    }}
                                    <div class="care_of_0_err text-danger"></div>
                                    @if ($errors->has('care_of.0'))
                                        <div class="help-block red">{{ $errors->first('care_of.0') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label
                                        class="form-label required">@lang('job-application.home_and_road_no',[],'en')</label>
                                    {{ Form::text('road_and_house[0]', null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'required' => 'required',
                                            'data-msg-required' => trans('validation.required', ['attribute' => trans('job-application.home_and_road_no')]),
                                        ])
                                    }}
                                    <div class="road_and_house_0_err text-danger"></div>
                                    @if ($errors->has('road_and_house.0'))
                                        <div class="help-block red">{{ $errors->first('road_and_house.0') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label required">@lang('job-application.district',[],'en')</label>
                                    {{ Form::select('district[0]', $districts->pluck('name', 'name'), null,
                                        [
                                             'placeholder' => trans('labels.select',[],'en'),
                                            'class' => 'form-control required select2'.($errors->has('district') ? ' is-invalid' : ''),
                                            'id' => 'present_district',
                                            'data-msg-required' => trans('validation.required',
                                        ['attribute' => trans('job-application.district')]),
                                        ])
                                    }}
                                    <div class="district_0_err text-danger"></div>
                                    @if ($errors->has('district.0'))
                                        <div class="help-block red">{{ $errors->first('district.0') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label
                                        class="form-label required">@lang('job-application.sub_district',[],'en')</label>
                                    {{ Form::select('sub_district[0]', $districts->pluck('name', 'name'), null,
                                        [
                                             'placeholder' => trans('labels.select',[],'en'),
                                            'class' => 'form-control select2 required'.($errors->has('sub_district') ? ' is-invalid' : ''),
                                            'id' => 'present_sub_district',
                                            'data-msg-required' => trans('validation.required',
                                        ['attribute' => trans('job-application.sub_district')]),
                                        ])
                                    }}
                                    <div class="sub_district_0_err text-danger"></div>
                                    @if ($errors->has('sub_district.0'))
                                        <div class="help-block red">{{ $errors->first('sub_district.0') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label
                                        class="form-label required">@lang('job-application.post_office',[],'en')</label>
                                    <input type="text" name="post_office[0]" class="form-control" required
                                           data-msg-required="{{trans('validation.required',
                                       ['attribute' => trans('job-application.post_office')])}}">
                                    <div class="post_office_0_err text-danger"></div>
                                    @if ($errors->has('post_office.0'))
                                        <div class="help-block red">{{ $errors->first('post_office.0') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label
                                        class="form-label required">@lang('job-application.post_code',[],'en')</label>

                                    {{ Form::number('post_code[0]', null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'required' => 'required',
                                            'data-msg-required' => trans('validation.required',
                                               ['attribute' => trans('job-application.post_code')]),
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                        ])
                                    }}
                                    <div class="post_code_0_err text-danger"></div>
                                    @if ($errors->has('post_code.0'))
                                        <div class="help-block red">{{ $errors->first('post_code.0') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">@lang('job-application.permanent',[],'en')
                            ( <input type="checkbox" name="same_as_present" id="same_as_present">
                            @lang('job-application.same_as_present',[],'en') )
                        </div>
                        <div class="panel-body" id="permanent_address">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('job-application.care_of',[],'en')</label>
                                    <input type="hidden" name="address_type[1]" value="permanent_address">
                                    {{ Form::text('care_of[1]', null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'required' => 'required',
                                            'data-msg-required' => trans('validation.required', ['attribute' => trans('job-application.care_of')]),
                                        ])
                                    }}
                                    <div class="care_of_1_err text-danger"></div>
                                    @if ($errors->has('care_of.1'))
                                        <div class="help-block red">{{ $errors->first('care_of.1') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('job-application.home_and_road_no',[],'en')</label>
                                    {{ Form::text('road_and_house[1]', null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'required' => 'required',
                                            'data-msg-required' => trans('validation.required', ['attribute' => trans('job-application.home_and_road_no')]),
                                        ])
                                    }}
                                    <div class="road_and_house_1_err text-danger"></div>
                                    @if ($errors->has('road_and_house.1'))
                                        <div class="help-block red">{{ $errors->first('road_and_house.1') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('job-application.district',[],'en')</label>
                                    {{ Form::select('district[1]', $districts->pluck('name', 'name'), null,
                                        [
                                             'placeholder' => trans('labels.select',[],'en'),
                                            'class' => 'form-control select2'.($errors->has('district') ? ' is-invalid' : ''),
                                            'id' => 'permanent_district',
                                            'required' => 'required',
                                            'data-msg-required' => trans('validation.required',
                                        ['attribute' => trans('job-application.district')]),
                                        ])
                                    }}
                                    <div class="district_1_err text-danger"></div>
                                    @if ($errors->has('district.1'))
                                        <div class="help-block red">{{ $errors->first('district.1') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('job-application.sub_district',[],'en')</label>
                                    <select name="sub_district[1]" id="permanent_sub_district" data-msg-required="{{trans('validation.required',
                                        ['attribute' => trans('job-application.sub_district')])}}"
                                            class="form-control required">
                                        <option value="">@lang('labels.select',[],'en')</option>
                                    </select>
                                    <div class="sub_district_1_err text-danger"></div>
                                    @if ($errors->has('sub_district.1'))
                                        <div class="help-block red">{{ $errors->first('sub_district.1') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('job-application.post_office',[],'en')</label>
                                    <input type="text" name="post_office[1]" class="form-control required"
                                           data-msg-required="{{trans('validation.required',
                                        ['attribute' => trans('job-application.sub_district')])}}">
                                    <div class="post_office_1_err text-danger"></div>
                                    @if ($errors->has('post_office.1'))
                                        <div class="help-block red">{{ $errors->first('post_office.1') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label
                                        class="form-label required">@lang('job-application.post_code',[],'en')</label>
                                    {{ Form::number('post_code[1]', null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'required' => 'required',
                                            'data-msg-required' => trans('validation.required',
                                               ['attribute' => trans('job-application.post_code')]),
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                        ])
                                    }}
                                    <div class="post_code_1_err text-danger"></div>
                                    @if ($errors->has('post_code.1'))
                                        <div class="help-block red">{{ $errors->first('post_code.1') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" id="permanent_address_static" style="display: none">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">@lang('job-application.care_of',[],'en')</label>
                                    <label class="form-control">-</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">@lang('job-application.home_and_road_no',[],'en')</label>
                                    <label class="form-control">-</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('job-application.district',[],'en')</label>
                                    <label class="form-control">-</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('job-application.sub_district',[],'en')</label>
                                    <label class="form-control">-</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('job-application.post_office',[],'en')</label>
                                    <label class="form-control">-</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">@lang('job-application.post_code',[],'en')</label>
                                    <label class="form-control">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <fieldset class="col-md-12 scheduler-border">
            <legend class="scheduler-border">
                <h5 class="font-weight-bold">@lang('labels.digits.15',[],'en')
                    . @lang('job-application.contact',[],'en')</h5>
            </legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile" class="form-label required"> @lang('labels.mobile',[],'en')</label>
                        {{ Form::text('mobile', null, [
                            'class' => 'form-control',
                            'required' => 'required',
                            'data-msg-required' => trans('validation.required',
                                                        ['attribute' => trans('labels.mobile')]),
                            'placeholder' => '11 digit number',
                            'data-rule-minlength' => 11,
                            'data-msg-minlength'=> trans('labels.At least 11 characters'),
                            'data-rule-maxlength' => 11,
                            'data-msg-maxlength'=> trans('labels.At most 11 characters'),
                            'data-rule-number' => 'true',
                            'data-msg-number' => trans('labels.Please enter a valid number'),
                        ]) }}
                        <div class="mobile_err text-danger"></div>
                        <div class="help-block"></div>
                        @if ($errors->has('mobile'))
                            <div class="help-block red" role="alert">{{ $errors->first('mobile') }}</div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="form-label required">@lang('labels.email_address',[],'en')</label>
                        {!! Form::email('email', null, [
                                        'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                                        'placeholder' => 'john@example.com',
                                          'required' => 'required',
                                        'data-rule-maxlength' => 50,
                                        'data-msg-maxlength'=>Lang::get('labels.At least 50 characters'),
                                        'data-msg-email' => trans('labels.Please enter a valid email address')
                                        ]) !!}
                        <div class="email_err text-danger"></div>
                        <div class="help-block"></div>
                        @if ($errors->has('email'))
                            <div class="help-block red">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="">
        <fieldset>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nationality"
                               class="form-label required">@lang('labels.digits.16',[],'en')
                            . @lang('job-application.nationality',[],'en')</label>
                        <select name="nationality" id="nationality" class="form-control" required
                                data-msg-required="{{trans('validation.required', ['attribute' => trans('job-application.nationality')])}}">
                            <option value="Bangladeshi">Bangladeshi</option>
                        </select>
                        <div class="help-block"></div>
                        @if ($errors->has('nationality'))
                            <div class="help-block red">{{ $errors->first('nationality') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gender" class="form-label required">@lang('labels.digits.17',[],'en')
                            . @lang('labels.gender',[],'en')</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="skin skin-flat">
                                    <fieldset>
                                        {!! Form::radio('gender', 'male', false, ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                        <label>@lang('labels.male',[],'en')</label>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="skin skin-flat">
                                    <fieldset>
                                        {!! Form::radio('gender', 'female', false, ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                        <label>{{ trans('labels.female',[],'en') }}</label>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="skin skin-flat">
                                    <fieldset>
                                        {!! Form::radio('gender', 'others',  false, ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                        <label>{{ trans('labels.others',[],'en') }}</label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="row radio-error gender_err text-danger"></div>
                        @if ($errors->has('gender'))
                            <div class="small danger">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="religion"
                               class="form-label required">@lang('labels.digits.18',[],'en')
                            . @lang('job-application.religion',[],'en')</label>
                        <select name="religion" id="religion" class="form-control" required
                                data-msg-required="{{trans('validation.required', ['attribute' => trans('job-application.religion')])}}">
                            <option value="">@lang('labels.select',[],'en')</option>
                            <option value="islam">@lang('labels.religion.islam',[],'en')</option>
                            <option value="hinduism">@lang('labels.religion.hinduism',[],'en')</option>
                            <option value="buddhist">@lang('labels.religion.buddhist',[],'en')</option>
                            <option value="cristian">@lang('labels.religion.cristian',[],'en')</option>
                            <option value="others">@lang('labels.others',[],'en')</option>
                        </select>
                        <div class="religion_err text-danger"></div>
                        <div class="help-block"></div>
                        @if ($errors->has('religion'))
                            <div class="help-block">{{ $errors->first('religion') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="occupation"
                               class="form-label">@lang('labels.digits.19',[],'en')
                            . @lang('job-application.occupation',[],'en')</label>
                        <input type="text" name="occupation" id="occupation" class="form-control">
                        <div class="help-block"></div>
                        @if ($errors->has('occupation'))
                            <div class="help-block">{{ $errors->first('occupation') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <!-- Educational Information -->
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">
            <h5 class="font-weight-bold">
                @lang('labels.digits.20',[],'en'). @lang('job-application.educational_qualification',[],'en')
                <span class="font-medium-5 font-weight-bold" style="color:red"> *</span>
            </h5>
        </legend>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered repeater-education-info">
                        <thead>
                        <tr>
                            <th width="15%">Level</th>
                            <th width="15%">@lang('job-application.name_of_exam',[],'en')</th>
                            <th width="15%">@lang('job-application.board_university',[],'en')</th>
                            <th width="20%">@lang('job-application.roll_no',[],'en')</th>
                            <th width="5%">@lang('job-application.grade',[],'en')</th>
                            <th width="15%">@lang('job-application.subject',[],'en')</th>
                            <th width="9%">@lang('job-application.passing_year',[],'en')</th>
                            <th width="1%">
                                <i data-repeater-create class="la la-plus-circle text-info" id="add-repeater-row"
                                   style="cursor: pointer"></i>
                            </th>
                        </tr>
                        </thead>
                        <tbody data-repeater-list="education_information">
                        <!-- SSC/Equivalent -->
                        <tr>
                            <td>
                                {!! Form::select('education_information[10][level]', $levels, null,
                                    [
                                        'onChange' => 'getDataByLevel(this.name)',
                                        'class' => 'form-control select2 edu-level', 'required' ,
                                        'placeholder' => trans('labels.select',[],'en'),
                                        'data-msg-required' =>trans('validation.required', ['attribute' => trans('job-application.name_of_exam')])
                                    ])
                                !!}
                            </td>
                            <td>
                                {!! Form::select('education_information[10][exam_name]', [], null,
                                    [
                                        'class' => 'form-control select2', 'required' ,
                                        'placeholder' => trans('labels.select',[],'en'),
                                        'data-msg-required' =>trans('validation.required', ['attribute' => trans('job-application.name_of_exam')])
                                    ])
                                !!}
                            </td>

                            <td>
                                {!! Form::select('education_information[10][board_or_university]', [],
                                    null, [
                                        'class' => 'form-control select2', 'required' ,
                                         'placeholder' => trans('labels.select',[],'en'),
                                        'data-msg-required' =>
                                        trans('validation.required', ['attribute' => __('job-application.board_university')])
                                    ])
                                !!}
                            </td>
                            <td>
                                <input type="hidden" name="education_information[10][course_duration]"
                                       class="form-control">
                                {{ Form::number('education_information[10][roll]', null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'required' => 'required',
                                            'data-msg-required' => trans('validation.required',
                                             ['attribute' => trans('job-application.roll_no')]),
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                        ])
                                    }}
                            </td>
                            <td>
                                {!! Form::text('education_information[10][grade]', null, ['class' => 'form-control', 'required',
                                    'data-msg-required' => __('validation.required',['attribute' => __('job-application.grade')])
                                    ])
                                 !!}
                            </td>
                            <td>
                                {!! Form::text('education_information[10][subject]', null, ['class' => 'form-control', 'required',
                                    'data-msg-required' => __('validation.required',['attribute' => __('job-application.subject')])
                                    ])
                                 !!}
                            </td>
                            <td>
                                {!! Form::select('education_information[10][passing_year]', ['' => ''] + $passingYears, null,
                                 [
                                     'class' => 'form-control select2', 'required' ,
                                     'placeholder' => trans('labels.select',[],'en'),
                                     'data-msg-required' =>trans('validation.required', ['attribute' => trans('job-application.passing_year')])
                                 ])
                                !!}
                            </td>
                            <td></td>
                        </tr>

                        <tr data-repeater-item>
                            <td>
                                {!! Form::select('level', $levels, null,
                                    [
                                        'onChange' => 'getDataByLevel(this.name)',
                                        'class' => 'form-control select2 edu-level', 'required' ,
                                        'placeholder' => trans('labels.select',[],'en'),
                                        'data-msg-required' =>trans('validation.required', ['attribute' => trans('job-application.name_of_exam')])
                                    ])
                                !!}

                            </td>
                            <td>
                                {!! Form::select('exam_name', [], null,
                                    ['class' => 'form-control select2', 'required' , 'data-msg-required' =>
                                    __('validation.required', ['attribute' => trans('job-application.name_of_exam')])
                                    ])
                                !!}
                            </td>

                            <td>
                                {!! Form::select('board_or_university', [],
                                    null, ['class' => 'form-control select2', 'required' , 'data-msg-required' =>
                                    __('validation.required', ['attribute' => __('job-application.board_university')])
                                    ])
                                !!}
                            </td>
                            <td>
                                <input type="hidden" name="course_duration" class="form-control">
                                {{ Form::number('roll', null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'required' => 'required',
                                            'data-msg-required' => trans('validation.required',
                                             ['attribute' => trans('job-application.roll_no')]),
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                        ])
                                    }}
                            </td>
                            <td>
                                {!! Form::text('grade', null, ['class' => 'form-control', 'required',
                                    'data-msg-required' => __('validation.required',['attribute' => __('job-application.grade')])
                                    ])
                                 !!}
                            </td>
                            <td>
                                <input type="text" name="subject" class="form-control" required
                                       data-msg-required="{{trans('validation.required', ['attribute' =>
                              __('job-application.subject')])}}">
                            </td>
                            <td>
                                {!! Form::select('passing_year', ['' => ''] + $passingYears, null,
                                   ['class' => 'form-control select2', 'required' , 'data-msg-required' =>
                                   __('validation.required', ['attribute' => trans('job-application.passing_year')])
                                   ])
                                !!}
                            </td>
                            <td>
                                <i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-info" onclick="$('#add-repeater-row').trigger('click');">
                    + @lang('labels.add_more',[],'en')
                </button>
                <div class="edu-err text-danger mt-1"></div>
            </div>
        </div>
    </fieldset>

    <div class="col-md-12">
        <div class="form-group">
            <label for="extra_qualities" class="form-label">@lang('labels.digits.21',[],'en')
                . @lang('job-application.extra_qualities',[],'en')</label>
            <textarea name="extra_qualities" id="extra_qualities" class="form-control"></textarea>
            @if ($errors->has('extra_qualities'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('extra_qualities') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-12 mb-2">
        <label for="add_experience">@lang('labels.digits.22',[],'en')
            . @lang('job-application.add_experience',[],'en')</label>
        <div class="skin skin-flat">
            {{ Form::checkbox(
                'add_experience',
                null, false, [
                    'id' => 'add-experience',
                ]
            ) }}
            <label>@lang('labels.yes',[],'en')</label>
        </div>
    </div>

    <!-- Experience Information -->
    <fieldset class="scheduler-border experience-field" style="display: none">
        <legend class="scheduler-border">
            <h5>
                @lang('job-application.details_of_experience',[],'en')
            </h5>
        </legend>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-responsive table-bordered repeater-experience-info" id="experienceInfo">
                        <thead>
                        <tr>
                            <th>@lang('job-application.organaization',[],'en')</th>
                            <th>@lang('job-application.designation',[],'en')</th>
                            <th width="10%">@lang('job-application.length',[],'en')</th>
                            <th width="15%">@lang('job-application.from',[],'en')</th>
                            <th width="15%">@lang('job-application.to',[],'en')</th>
                            <th style="max-width: 75px">@lang('job-application.currently_working',[],'en')</th>
                            <th>@lang('job-application.responsibility',[],'en')</th>
                            <th width="1%">
                                <i data-repeater-create class="la la-plus-circle text-info" id="add-repeater-ex-row"
                                   style="cursor: pointer"></i>
                            </th>
                        </tr>
                        </thead>
                        <tbody data-repeater-list="experience_information">
                        <tr data-repeater-item>
                            <td>
                                {!! Form::text('organization_name', null,
                                [
                                    'class' => 'form-control organaization',
                                    'data-msg-required' => trans('validation.required',
                                        ['attribute' => trans('job-application.organaization')]),
                                    'placeholder' => trans('job-application.organaization',[],'en'),
                                    'data-rule-maxlength' => 255,
                                    'data-msg-maxlength'=> trans('labels.At most 255 characters')
                                ]) !!}
                            </td>

                            <td>
                                {!! Form::text('designation', null,
                                [
                                    'class' => 'form-control designation',
                                    'data-msg-required' => trans('validation.required',
                                        ['attribute' => trans('job-application.designation')]),
                                    'placeholder' => trans('job-application.designation',[],'en'),
                                    'data-rule-maxlength' => 255,
                                    'data-msg-maxlength'=> trans('labels.At most 255 characters')
                                ]) !!}
                            </td>
                            <td>
                                {!! Form::text('length_of_service', null,
                                [
                                    'class' => 'form-control length',
                                    'data-msg-required' => trans('validation.required',
                                        ['attribute' => trans('job-application.length')]),
                                    'placeholder' => trans('job-application.length',[],'en'),
                                    'data-rule-maxlength' => 255,
                                    'data-msg-maxlength'=> trans('labels.At most 255 characters')
                                ]) !!}
                            </td>
                            <td>
                                {!! Form::text('from', null,
                                [
                                    'class' => 'form-control date form-date',
                                    'data-msg-required' => trans('validation.required',
                                        ['attribute' => trans('job-application.from')]),
                                    'placeholder' => trans('job-application.from',[],'en')
                                ]) !!}
                            </td>
                            <td>
                                {!! Form::text('to', null,
                                [
                                    'class' => 'form-control date to-date',
                                    'data-msg-required' => trans('validation.required',
                                        ['attribute' => trans('job-application.to')]),
                                    'placeholder' => trans('job-application.to',[],'en')
                                ]) !!}
                            </td>
                            <td>
                                <div>
                                    {!! Form::checkbox('currently-working', null, false,
                                    [
                                        'class' => 'currently-working'
                                    ]) !!}
                                </div>
                            </td>
                            <td>
                                {!! Form::text('responsibilities', null,
                                [
                                    'class' => 'form-control responsibility',
                                    'data-msg-required' => trans('validation.required',
                                        ['attribute' => trans('job-application.responsibility')]),
                                    'placeholder' => trans('job-application.responsibility',[],'en'),
                                    'data-rule-maxlength' => 255,
                                    'data-msg-maxlength'=> trans('labels.At most 255 characters')
                                ]) !!}
                            </td>
                            <td>
                                <i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-info" onclick="$('#add-repeater-ex-row').trigger('click');">
                    + @lang('labels.add')
                </button>
                <div class="experience-err text-danger mt-1"></div>
            </div>
        </div>
    </fieldset>

    <div class="col-md-12 mb-2">
        <label for="">@lang('labels.digits.23',[],'en'). @lang('job-application.research.add_research',[],'en')</label>
        <div class="skin skin-flat">
            {{ Form::checkbox(
                    'add_research',
                    null, false, [
                        'id' => 'add_research',
                    ]
                ) }}
            <label>@lang('labels.yes',[],'en')</label>
        </div>
    </div>

    <!-- Research Information -->
    <fieldset class="scheduler-border research-field" style="display: none">
        <legend class="scheduler-border">
            <h5>
                @lang('job-application.research.research_details',[],'en')
            </h5>
        </legend>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered repeater-research-info">
                        <thead>
                        <tr>

                            <th>@lang('job-application.research.title',[],'en')</th>
                            <th width="15%">@lang('job-application.research.duration',[],'en')</th>
                            <th width="15%">@lang('job-application.from',[],'en')</th>
                            <th width="15%">@lang('job-application.to',[],'en')</th>
                            <th>@lang('job-application.research.supervisor',[],'en')</th>
                            <th>@lang('job-application.organaization',[],'en')</th>
                            <th width="1%">
                                <i data-repeater-create class="la la-plus-circle text-info"
                                   id="add-repeater-research-row"
                                   style="cursor: pointer"></i>
                            </th>
                        </tr>
                        </thead>
                        <tbody data-repeater-list="research_information">
                        <tr data-repeater-item>
                            <td>
                                {!! Form::text('title', null,
                                [
                                    'class' => 'form-control title research-title',
                                    'data-msg-required' => trans('validation.required',
                                    ['attribute' => trans('job-application.research.title')]),
                                    'placeholder' => trans('job-application.research.title',[],'en'),
                                    'data-rule-maxlength' => 255,
                                    'data-msg-maxlength'=> trans('labels.At most 255 characters')
                                ]) !!}
                            </td>
                            <td>
                                {!! Form::text('duration', null,
                                [
                                    'class' => 'form-control duration',
                                    'data-msg-required' => trans('validation.required',
                                    ['attribute' => trans('job-application.research.duration')]),
                                    'placeholder' => trans('job-application.research.duration_placeholder',[],'en'),
                                    'data-rule-maxlength' => 255,
                                    'data-msg-maxlength'=> trans('labels.At most 255 characters')
                                ]) !!}
                            </td>
                            <td>
                                {!! Form::text('from', null,
                                [
                                'class' => 'form-control date form',
                                'data-msg-required' => trans('validation.required',
                                ['attribute' => trans('job-application.from')]),
                                'placeholder' => trans('job-application.from',[],'en')
                                ]) !!}
                            </td>
                            <td>
                                {!! Form::text('to', null,
                                [
                                'class' => 'form-control date to',
                                'data-msg-required' => trans('validation.required',
                                ['attribute' => trans('job-application.to')]),
                                'placeholder' => trans('job-application.to',[],'en')
                                ]) !!}
                            </td>
                            <td>
                                {!! Form::text('supervisor', null,
                                [
                                    'class' => 'form-control supervisor',
                                    'data-msg-required' => trans('validation.required',
                                        ['attribute' => trans('job-application.research.supervisor')]),
                                    'placeholder' => trans('job-application.research.supervisor',[],'en'),
                                    'data-rule-maxlength' => 255,
                                    'data-msg-maxlength'=> trans('labels.At most 255 characters')
                                ]) !!}
                            </td>
                            <td>
                                {!! Form::text('organaization', null,
                                [
                                    'class' => 'form-control research-organaization',
                                    'data-msg-required' => trans('validation.required',
                                        ['attribute' => trans('job-application.organaization')]),
                                    'placeholder' => trans('job-application.research.organaization_placeholder',[],'en'),
                                    'data-rule-maxlength' => 255,
                                    'data-msg-maxlength'=> trans('labels.At most 255 characters')
                                ]) !!}
                            </td>
                            <td>
                                <i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-info"
                        onclick="$('#add-repeater-research-row').trigger('click');">
                    + @lang('labels.add')
                </button>
                <div class="research-err text-danger mt-1"></div>
            </div>
        </div>
    </fieldset>


    <div class="col-md-12">
        <fieldset class="col-md-12 scheduler-border">
            <legend class="scheduler-border"><h5 class="font-weight-bold">@lang('labels.digits.24',[],'en')
                    . @lang('job-application.bank_draft',[],'en')</h5></legend>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bank_draft_no"
                               class="form-label required"> @lang('job-application.bank_draft_no',[],'en')</label>
                        <input type="text" name="bank_draft_no" id="bank_draft_no" class="form-control" required
                               data-msg-required="{{trans('validation.required',
                       ['attribute' => trans('job-application.bank_draft_no',[],'en')])}}">
                        <div class="bank_draft_no_err text-danger"></div>
                        <div class="help-block"></div>
                        @if ($errors->has('bank_draft_no'))
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $errors->first('bank_draft_no') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('payment_date', trans('labels.date',[],'en'), ['class' => 'required']) }}
                        {{ Form::text('payment_date', null,
                            [
                                'id' => 'payment_date',
                                'class' => 'form-control required' . ($errors->has('payment_date') ? ' is-invalid' : ''),
                                'required' => 'required',
                                'data-msg-required' => trans('validation.required', ['attribute' => trans('labels.date')])
                            ])
                        }}
                        <div class="payment_date_err text-danger"></div>
                        @if ($errors->has('payment_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('payment_date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bank_branch_name"
                               class="form-label required">@lang('job-application.bank_branch_name',[],'en')</label>
                        <input type="text" name="name_of_bank_branch" id="bank_branch_name" class="form-control"
                               required
                               data-msg-required="{{trans('validation.required', ['attribute' => trans('job-application.bank_branch_name')])}}">
                        <div class="name_of_bank_branch_err text-danger"></div>
                        <div class="help-block"></div>
                        @if ($errors->has('name_of_bank_branch'))
                            <div class="help-block red">{{ $errors->first('name_of_bank_branch') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>
<input name="step" type="hidden" value="1">
</fieldset>

