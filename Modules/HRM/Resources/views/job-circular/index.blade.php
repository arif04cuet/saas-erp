@extends('hrm::layouts.master')
@section('title', trans('job-application.job_application'))
{{--@section("employee_create", 'active')--}}


@section('content')
    <section id="role-list">
        <div class="col-xl-11 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of jobs</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{ route('job-circular.store') }}" class="btn btn-primary btn-sm">
                            <i class="ft-plus white"></i> @lang('labels.add')
                        </a>
                        <a href="{{ route('job-application.index') }}" class="btn btn-primary btn-sm">
                            <i class="ft-plus white"></i> @lang('hrm::job_application.all')
                        </a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>

        @foreach($jobCirculars as $jobCircular)
            <div class="col-md-11 col-sm-12">
                <div class="card border-top-blue border-blue-blue border-top-blue border-top-blue">
                    <div class="card-header">
                        <ul class="list-inline pull-right">
                            {{--                            <li class="list-inline-item">--}}
                            {{--                                <a class="btn btn-outline-info btn-sm" title="{{__('hrm::job-circular.admit_card.create')}}"--}}
                            {{--                                   href="{{ route('job-admit-cards.create', $jobCircular->id) }}">--}}
                            {{--                                    <i class="ft ft-file-plus"></i>--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                            <li class="list-inline-item">
                                <a class="btn btn-outline-info btn-sm" title="{{__('labels.edit')}}"
                                   href="{{ route('job-circular.edit', $jobCircular->id) }}">
                                    <i class="ft ft-edit"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn btn-outline-danger btn-sm" title="{{__('labels.delete')}}"
                                   href="{{ route('job-circular.destroy', $jobCircular->id) }}">
                                    <i class="ft ft-trash"></i>
                                </a>
                            </li>
                        </ul>
                        <h2 class="card-title">
                            <p class="text-success text-bold-700">
                                <a href="{{ route('job-circular.show', $jobCircular->id) }}">
                                    {{ $jobCircular->title }}
                                </a>
                            </p>
                            @foreach($jobCircular->jobCircularDetails as $jobCircularDetail)
                                <a><i class="la la-tags"></i>
                                    {{
                                            optional($jobCircularDetail->designation)->getName() ??  trans('labels.not_found')
                                    }},</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            @endforeach
                        </h2>

                        <br>
                        <div>
                            <h4>
                                @lang('hrm::circular.application_deadline')
                                : {{ date('F d, Y', strtotime($jobCircular->application_deadline)) }}
                            </h4>
                        </div>
                        <div>
                            <h4>
                                @lang('hrm::circular.job_location') : {!! $jobCircular->job_location !!}
                            </h4>
                        </div>

                    </div>
                    {{--                    <div class="card-content collapse show">--}}
                    {{--                        <div class="card-body " >--}}
                    {{--                            <p class="card-text">Use <code>border-left-*</code> and<code>border-right-*</code> class for border left and right color.</p>--}}

                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        @endforeach
    </section>

@endsection
