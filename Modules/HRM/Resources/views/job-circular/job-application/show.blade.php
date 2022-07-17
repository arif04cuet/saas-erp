@extends('hrm::layouts.master')
@section('title', trans('hrm::job_application.details'))
@push('page-css')
    <style>
        legend.scheduler-border {
            width: inherit; /* Or auto */
            padding: 0 10px; /* To give a bit of padding on the left and right */
            border-bottom: none;
        }

        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
        }
    </style>
@endpush
@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><p style="color: black">@lang('hrm::job_application.details')</p></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('job-application.index') }}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> @lang('labels.cancel')</a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="col-md-11 col-sm-12">
                                <div class="card">
                                    <div class="card-header pl-0 pr-0">
                                        <h2 class="card-title">
                                            <p class="text-success text-bold-700">
                                                <a href="{{ route('job-circular.show', $jobApplication->jobCircular->id) }}">{{ $jobApplication->jobCircular->title }}</a>
                                            </p>
                                        </h2>
                                        <div class="row">
                                            <table class="table">
                                                <tr>
                                                    <th>@lang('hrm::job_application.circular_id')</th>
                                                    <td> {{ $jobApplication->jobCircular->unique_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('hrm::circular.vacancy_no')</th>
                                                    <td> {{ $jobApplication->jobCircularDetail->vacancy_no }}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('hrm::circular.job_nature')</th>
                                                    <td> {{ $jobApplication->jobCircular->job_nature }}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('hrm::circular.salary')</th>
                                                    <td> {{ $jobApplication->jobCircular->salary }}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('hrm::circular.application_deadline')</th>
                                                    <td> {{  $jobApplication->jobCircular->application_deadline  }}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('labels.designation')</th>
                                                    <td>
                                                        {{ optional($jobApplication->jobCircularDetail)->designation->getName()?? trans('labels.not_found') }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: center">
                                    <a class="btn btn-success" style="color: #fff;" onclick="printDiv('printable')">
                                        @lang('labels.download')
                                    </a>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </section>

    <div class="row">
        <div class="col-md-12" id="printable">
            <div class="card border-top-blue border-blue-blue border-top-blue border-top-blue ">
                <div class="card-header">
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="col-md-12 scheduler-border row">
                                    <legend class="scheduler-border">
                                        <h5> @lang('hrm::job_application.applicant_details')</h5></legend>
                                    <div class="row">
                                        @foreach($jobApplication->pictures as $picture)
                                            <div class="col-md-6" style="text-align: center">
                                                <div class="form-group">
                                                    <img src="{{ '/file/get?filePath=' . $picture->file_location }}"
                                                         alt="Paris"
                                                         style="border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 300px;">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('job-application.job_applicant_id')</label>
                                                {{ Form::text('', $jobApplication->applicant_id,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('labels.name') (@lang('hrm::job_application.bangla')
                                                    )</label>
                                                {{ Form::text('', $jobApplication->applicant_name_bn,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('labels.name') (@lang('hrm::job_application.english')
                                                    )</label>
                                                {{ Form::text('', $jobApplication->applicant_name,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gender" class="form-label">@lang('labels.gender')</label>
                                                {{ Form::text('', $jobApplication->gender,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="occupation"
                                                       class="form-label">@lang('job-application.occupation')</label>
                                                {{ Form::text('', $jobApplication->occupation,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""
                                                       class="form-label">@lang('job-application.job_applicant_father_name')</label>
                                                {{ Form::text('', $jobApplication->father_name,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="applicant_birth_place"
                                                       class="form-label">@lang('job-application.job_applicant_mother_name')</label>
                                                {{ Form::text('', $jobApplication->mother_name,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="applicant_birth_place"
                                                       class="form-label">@lang('job-application.job_applicant_birth_place')</label>
                                                {{ Form::text('', $jobApplication->birth_place,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="birth_date"
                                                       class="form-label">@lang('job-application.job_applicant_birth_date')</label>
                                                {{ Form::text('', date('F d, Y', strtotime($jobApplication->birth_date)),
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nationality"
                                                       class="form-label">@lang('job-application.nationality')</label>
                                                {{ Form::text('', $jobApplication->nationality,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('nid_number', trans('labels.nid_number'), ['class' => 'form-label'] ) }}
                                                {{ Form::text('', $jobApplication->national_id,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('birth_certificate_no', trans('job-application.job_applicant_birth_certificate_no'), ['class' => 'form-label'] ) }}
                                                {{ Form::number('', $jobApplication->birth_certificate_no,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="religion"
                                                       class="form-label">@lang('job-application.religion')</label>
                                                {{ Form::text('', $jobApplication->religion,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="religion"
                                                       class="form-label">@lang('hrm::job_application.quota')</label>
                                                @if($jobApplication->quota == 'freedom_fighter_quota')
                                                    <label for="religion" class="form-control"
                                                           readonly>@lang('job-application.freedom_fighter_quota')</label>
                                                @elseif($jobApplication->quota == 'disabled_quota')
                                                    <label for="religion" class="form-control"
                                                           readonly>@lang('job-application.disabled_quota')</label>
                                                @elseif($jobApplication->quota == 'tribal_quota')
                                                    <label for="religion" class="form-control"
                                                           readonly>@lang('job-application.tribal_quota')</label>
                                                @elseif($jobApplication->quota == 'ansar_quota')
                                                    <label for="religion" class="form-control"
                                                           readonly>@lang('job-application.ansar_quota')</label>
                                                @elseif($jobApplication->quota == 'others_quota')
                                                    <label for="religion" class="form-control"
                                                           readonly>@lang('job-application.others_quota')</label>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="religion"
                                                       class="form-label">@lang('hrm::job_application.is_divisional_candidate')</label>
                                                @if($jobApplication->is_divisional_applicant == '1')
                                                    <label for="religion" class="form-control"
                                                           readonly>@lang('labels.yes')</label>
                                                @elseif($jobApplication->is_divisional_applicant == '0')
                                                    <label for="religion" class="form-control"
                                                           readonly>@lang('labels.no')</label>
                                                @elseif($jobApplication->is_divisional_applicant == '2')
                                                    <label for="religion" class="form-control"
                                                           readonly>@lang('labels.not_applicable')</label>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="col-md-12 scheduler-border row">
                                    <legend class="scheduler-border"><h5>@lang('job-application.contact')</h5></legend>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mobile" class="form-label"> @lang('labels.mobile')</label>
                                                {{ Form::text('mobile', $jobApplication->mobile, [
                                                    'class' => 'form-control',
                                                    'readonly'
                                                ]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email"
                                                       class="form-label">@lang('labels.email_address')</label>
                                                {!! Form::email('email', $jobApplication->email, [
                                                    'class' => 'form-control',
                                                    'readonly'
                                                ]) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">@lang('job-application.present') :</div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label required">@lang('job-application.care_of')</label>
                                                            {{ Form::text('', $jobApplication->presentAddress->care_of,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label required">@lang('job-application.home_and_road_no')</label>
                                                            {{ Form::text('', $jobApplication->presentAddress->road_and_house,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label required">@lang('job-application.district')</label>
                                                            {{ Form::text('', $jobApplication->presentAddress->district,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label required">@lang('job-application.sub_district')</label>
                                                            {{ Form::text('', $jobApplication->presentAddress->sub_district,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label required">@lang('job-application.post_office')</label>
                                                            {{ Form::text('', $jobApplication->presentAddress->post_office,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label">@lang('job-application.post_code')</label>

                                                            {{ Form::text('', $jobApplication->presentAddress->post_code,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">@lang('job-application.permanent') :
                                                </div>
                                                <div class="panel-body" id="permanent_address">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label required">@lang('job-application.care_of')</label>
                                                            {{ Form::text('', $jobApplication->permanentAddress->care_of,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label required">@lang('job-application.home_and_road_no')</label>
                                                            {{ Form::text('', $jobApplication->permanentAddress->road_and_house,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label required">@lang('job-application.district')</label>
                                                            {{ Form::text('', $jobApplication->permanentAddress->district,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label required">@lang('job-application.sub_district')</label>
                                                            {{ Form::text('', $jobApplication->permanentAddress->sub_district,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label required">@lang('job-application.post_office')</label>
                                                            {{ Form::text('', $jobApplication->permanentAddress->post_office,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label">@lang('job-application.post_code')</label>

                                                            {{ Form::text('', $jobApplication->permanentAddress->post_code,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="col-md-12 scheduler-border row">
                                    <legend class="scheduler-border">
                                        <h5>@lang('job-application.educational_qualification')</h5></legend>
                                    <div class="row">
                                        @foreach($jobApplication->educations as $education)
                                        <div class="col-md-6">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">@lang('job-application.' . $education->level)</div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label">@lang('job-application.name_of_exam')</label>
                                                            {{ Form::text('', $education->exam_name,
                                                                [
                                                                    'class' => 'form-control',
                                                                    'readonly' => 'readonly',
                                                                ])
                                                            }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label">@lang('job-application.board_university')</label>
                                                            {{ Form::text('', $education->board_or_university,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label">@lang('job-application.roll_no')</label>
                                                            <input type="hidden" name="course_duration[0]"
                                                                   class="form-control">

                                                            {{ Form::text('', $education->roll,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label">@lang('job-application.grade')</label>
                                                            {{ Form::text('', $education->grade,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label">@lang('job-application.subject')</label>
                                                            {{ Form::text('', $education->subject,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                                        </div>
                                                        @if(isset($education->course_duration) && !empty($education->course_duration))
                                                            <div class="form-group col-md-6">
                                                                <label
                                                                    class="form-label">@lang('job-application.course_duration')</label>
                                                                <input type="hidden" name="roll[2]" class="form-control">
                                                                {{ Form::text('', $education->course_duration,
                                                                    [
                                                                        'class' => 'form-control',
                                                                        'readonly' => 'readonly',
                                                                    ])
                                                                }}
                                                            </div>
                                                        @endif

                                                        <div class="form-group col-md-6">
                                                            <label
                                                                class="form-label">@lang('job-application.passing_year')</label>
                                                            {{ Form::text('', $education->passing_year,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="extra_qualities"
                                           class="form-label">@lang('job-application.extra_qualities')</label>
                                    <textarea name="extra_qualities" readonly="readonly"
                                              class="form-control">{!! $jobApplication->extra_qualities !!}</textarea>
                                </div>
                            </div>
                            @if ($jobApplication->experiences->isNotEmpty())
                                <div class="col-md-12">
                                    <h5 class="mb-1">@lang('job-application.details_of_experience')</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-primary">
                                                <div class="panel-body">
                                                    @foreach ($jobApplication->experiences as $experience)
                                                        <fieldset class="scheduler-border">
                                                            <legend class="scheduler-border">
                                                                <h5 style="color:#6B6F82">@lang('job-application.organaization')
                                                                    - {{ $experience->organization_name }}</h5></legend>
                                                            <div class="row mb-1">
                                                                <div class="col-md-6">
                                                                    <label
                                                                        for="">{{ trans('job-application.designation') }}</label>
                                                                    {!! Form::text('', $experience->designation,
                                                                    [
                                                                        'class' => 'form-control organaization',
                                                                        'readOnly' => true
                                                                    ]) !!}
                                                                </div>
                                                                <div class="col-md-6 mb-1">
                                                                    <label
                                                                        for="">{{ trans('job-application.length') }}</label>
                                                                    {!! Form::text('', $experience->length_of_service,
                                                                    [
                                                                        'class' => 'form-control organaization',
                                                                        'readOnly' => true
                                                                    ]) !!}
                                                                </div>
                                                                <div class="col-md-6 mb-1">
                                                                    <label
                                                                        for="">{{ trans('job-application.from') }}</label>
                                                                    {!! Form::text('', $experience->from,
                                                                    [
                                                                        'class' => 'form-control organaization',
                                                                        'readOnly' => true
                                                                    ]) !!}
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label
                                                                        for="">{{ trans('job-application.to') }}</label>
                                                                    {!! Form::text('', $experience->to ?? trans('job-application.currently_working'),
                                                                    [
                                                                        'class' => 'form-control',
                                                                        'readOnly' => true
                                                                    ]) !!}
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label
                                                                        for="">{{ trans('job-application.responsibility') }}</label>
                                                                    {!! Form::textarea('', $experience->responsibilities,
                                                                    [
                                                                        'class' => 'form-control',
                                                                        'readOnly' => true,
                                                                        'rows' => 3
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($jobApplication->researches->isNotEmpty())
                                <div class="col-md-12">
                                    <h5 class="mb-1">@lang('job-application.research.research_details')</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-primary">
                                                <div class="panel-body">
                                                    @foreach ($jobApplication->researches as $research)
                                                        <fieldset class="scheduler-border">
                                                            <legend class="scheduler-border">
                                                                <h5 style="color:#6B6F82">@lang('job-application.research.title')
                                                                    -
                                                                    {{ $research->title }}</h5>
                                                            </legend>
                                                            <div class="row mb-1">
                                                                <div class="col-md-6">
                                                                    <label
                                                                        for="">{{ trans('job-application.research.duration') }}</label>
                                                                    {!! Form::text('', $research->duration,
                                                                    [
                                                                    'class' => 'form-control',
                                                                    'readOnly' => true
                                                                    ]) !!}
                                                                </div>
                                                                <div class="col-md-6 mb-1">
                                                                    <label
                                                                        for="">{{ trans('job-application.from') }}</label>
                                                                    {!! Form::text('', $research->from,
                                                                    [
                                                                    'class' => 'form-control organaization',
                                                                    'readOnly' => true
                                                                    ]) !!}
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label
                                                                        for="">{{ trans('job-application.to') }}</label>
                                                                    {!! Form::text('', $research->to,
                                                                    [
                                                                    'class' => 'form-control',
                                                                    'readOnly' => true
                                                                    ]) !!}
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label
                                                                        for="">{{ trans('job-application.research.supervisor') }}</label>
                                                                    {!! Form::text('', $research->supervisor,
                                                                    [
                                                                    'class' => 'form-control',
                                                                    'readOnly' => true,
                                                                    ]) !!}
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label
                                                                        for="">{{ trans('job-application.organaization') }}</label>
                                                                    {!! Form::text('', $research->organaization,
                                                                    [
                                                                    'class' => 'form-control',
                                                                    'readOnly' => true,
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <fieldset class="col-md-12 scheduler-border row">
                                    <legend class="scheduler-border"><h5>@lang('job-application.bank_draft')</h5>
                                    </legend>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="bank_draft_no"
                                                       class="form-label"> @lang('job-application.bank_draft_no')</label>
                                                <input type="text" readonly class="form-control"
                                                       value="{{ $jobApplication->bank_draft_no }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="birth_date" class="form-label">@lang('labels.date')</label>
                                                {{ Form::text('', date('F d, Y', strtotime($jobApplication->payment_date)),
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="bank_branch_name"
                                                       class="form-label ">@lang('job-application.bank_branch_name')</label>
                                                {{ Form::text('', $jobApplication->name_of_bank_branch,
                                                    [
                                                        'class' => 'form-control',
                                                        'readonly' => 'readonly',
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-text">
                        @if($jobApplication->status == "submitted")
                            <h4 class="pb-0 mb-0">@lang('job-application.add_to_shortlist')</h4>
                        @elseif($jobApplication->status == "short_listed")
                            <h4 class="pb-0 mb-0">@lang('job-application.remove_from_shortlist')</h4>
                        @endif
                    </div>
                </div>
                <div class="card-body mt-0">
                    {!! Form::open(['url' => route('job-applications.update', ['jobApplication' => $jobApplication]), 'class' => 'form', 'novalidate', 'method' => 'put']) !!}
                    {!! Form::token() !!}
                    @if($jobApplication->status == "submitted")
                        {{ Form::hidden('status', 'short_listed') }}
                        <button type="submit" class="btn btn-success mt-0">@lang('labels.add')</button>
                    @elseif($jobApplication->status == "short_listed")
                        {{ Form::hidden('status', 'submitted') }}
                        <button type="submit" class="btn btn-danger mt-0">@lang('labels.remove')</button>
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js"
        integrity="sha512-mPA/BA22QPGx1iuaMpZdSsXVsHUTr9OisxHDtdsYj73eDGWG2bTSTLTUOb4TG40JvUyjoTcLF+2srfRchwbodg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // Print The page 
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
        }
    </script>


@endpush