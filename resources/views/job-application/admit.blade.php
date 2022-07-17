@extends('layouts.public')
@section('title', trans('hrm::job-circular.admit_card.download'))

@section('content')
    {{--{{ dd($employee) }}--}}
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">@lang('labels.details')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                    </ul>
                </div>
            </div>
            {!! Form::open(['url' => route('job-admit-cards.download', ['jobCircular' => $admitCardId]),
                'class' => 'form', 'novalidate'])
            !!}
            <div class="card-content collapse show" style="">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" role="tabpanel" id="general" aria-labelledby="general-tab"
                             aria-expanded="true">
                            <table class="table ">
                                <tbody>
                                <tr>
                                    <th style="width: 30%">@lang('job-application.job_post_title')</th>
                                    <td><strong>{{$jobCircular->title}}</strong></td>
                                </tr>
                                <tr>
                                    <th class="">@lang('job-application.job_circular_number')</th>
                                    <td>{{$jobCircular->unique_id}}</td>
                                </tr>
                                @if(isset($application))
                                    <tr>
                                        <th class="">@lang('hrm::job-circular.admit_card.applicant') @lang('labels.id')</th>
                                        <td>{{$application->applicant_id}}</td>
                                    </tr>
                                    <tr>
                                        <th class="">@lang('job-application.job_applicant_name')</th>
                                        <td>
                                            {{\Illuminate\Support\Facades\App::getLocale() == 'bn' ?
                                                $application->applicant_name_bn : $application->applicant_name
                                            }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="">@lang('job-application.job_applicant_father_name')</th>
                                        <td>{{$application->father_name}}</td>
                                    </tr>
                                    <tr>
                                        <th class="">@lang('labels.mobile')</th>
                                        <td>{{$application->mobile}}</td>
                                    </tr>
                                @else
                                    @if($valid)
                                        <tr>
                                            <th class="">
                                                @lang('hrm::job-circular.admit_card.applicant') @lang('labels.id')
                                                <span class="danger">*</span>
                                            </th>
                                            <td>

                                                {!! Form::text('applicant_id', null, ['class' => 'form-control col-6', 'required',
                                                    'placeholder' => __('labels.id'),
                                                    'data-msg-required' => __('labels.This field is required')
                                                    ])
                                                !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="">
                                                @lang('hrm::job-circular.admit_card.registered_mobile')
                                                <span class="danger">*</span>
                                            </th>
                                            <td>
                                                {!! Form::text('mobile', null, ['class' => 'form-control col-6', 'required',
                                                    'placeholder' => __('labels.mobile'),
                                                    'data-msg-required' => __('labels.This field is required'),
                                                    'data-rule-minlength' => 11,
                                                    'data-msg-minlength'=> trans('labels.At least 11 characters'),
                                                    'data-rule-maxlength' => 11,
                                                    'data-msg-maxlength'=> trans('labels.At most 11 characters'),
                                                    'data-rule-number' => 'true',
                                                    'data-msg-number' => trans('labels.Please enter a valid number'),
                                                    ])
                                                !!}

                                            </td>
                                        </tr>
                                    @endif
                                @endif
                                </tbody>
                            </table>

                            <center>
                                <div class="center">
                                    @if(isset($downloadUrl))
                                        <a href="{{url($downloadUrl)}}" class="btn btn-info">
                                            <b>
                                                <i class="la la-download"></i>
                                                @lang('hrm::job-circular.admit_card.download')
                                            </b>
                                        </a>
                                        <a href="{{url('/')}}"
                                           class="btn btn-warning">
                                            <i class="la la-times"></i>
                                            @lang('labels.cancel')
                                        </a>
                                    @elseif($valid)
                                        <button type="submit" class="btn btn-success">
                                            <b>
                                                <i class="la la-check-circle"></i>
                                                @lang('labels.submit')
                                            </b>
                                        </button>
                                    @else
                                        <span class="alert badge-danger">
                                            <strong>
                                                @lang('hrm::job-circular.admit_card.messages.date_expired')
                                            </strong>

                                        </span>
                                    @endif
                                </div>
                            </center>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script>
        $('.form').validate({

            ignore: 'input[type=hidden]', // ignore hidden fields
            errorClass: 'danger',
            successClass: 'success',
        });
    </script>
@endpush
