@extends('hrm::layouts.master')
@section('title', trans('hrm::job_application.all'))
@section('content')
    <section id="role-list">
        <div class="col-xl-11 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('hrm::job_application.all')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{ route('job-circular.index') }}" class="btn btn-warning btn-sm">
                             @lang('labels.cancel')
                        </a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>

        @foreach($applications as $application)
            <div class="col-md-11 col-sm-12">
                <div class="card border-top-blue border-blue-blue border-top-blue border-top-blue">
                    <div class="card-header">
                        <h2 class="card-title">
                            <p class="text-success text-bold-700">
                                <a href="{{ route('job-circular.show', $application->jobCircular->id) }}">{{ $application->jobCircular->title }}</a>
                                <a class="pull-right" href="{{ route('job-application.show', $application->id) }}"><i
                                            class="la la-eye"></i></a>
                            </p>
                        </h2>
                        <a><i class="la la-tags"></i> @lang('hrm::job_application.circular_id')
                            : {{ $application->jobCircular->unique_id }}</a>
                        <span class="pull-right">@lang('hrm::job_application.date_of_application')
                            : {{ date('F d, Y', strtotime($application->created_at)) }}</span>
                        <br/><br/>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div>
                            <h4>@lang('hrm::job_application.applicant') :</h4>

                            <table>
                                <tr>
                                    <td>@lang('labels.name') : <a
                                                href="{{ route('job-application.show', $application->id) }}">{{ $application->applicant_name }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('labels.mobile') : {{ $application->mobile }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('labels.dob')
                                        : {{ date('F d, Y', strtotime($application->birth_date)) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

@endsection
