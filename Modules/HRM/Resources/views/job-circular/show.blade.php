@extends('hrm::layouts.master')
@section('title', trans('hrm::circular.job_circular'))

@section('content')
    <section id="role-list">
        @if (!Auth::guest())
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('hrm::circular.job_circular')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{ route('job-circular.create') }}" class="btn btn-primary btn-sm">
                                    <i class="ft-plus white"></i> @lang('labels.add')</a>
                                {{--                                <a href="{{route('job-circular.email-shortlisted', $jobCircular->id)}}"--}}
                                {{--                                   class="btn btn-sm btn-info">--}}
                                {{--                                    <i class="ft-inbox"></i>--}}
                                {{--                                    @lang('job-application.email_to_shortlisted')--}}
                                {{--                                </a>--}}
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    @include('hrm::job-circular.partial.common-view')
@endsection
