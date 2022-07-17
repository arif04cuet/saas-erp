@extends('layouts.public')
@section('title', trans('tms::trainee.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">@lang('tms::training.trainee_details') @lang('labels.show')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                        </ul>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('tms::training.title') }}
                                    </th>
                                    <td>{{ $training->title ?? trans('labels.not_found') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('tms::trainee.title') }}</th>
                                    <td>{{ $trainee->getName() ?? trans('labels.not_found') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('labels.start') }}</th>
                                    <td>{{ $training->start_date ?? trans('labels.not_found') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('labels.end') }}</th>
                                    <td>{{ $training->end_date ?? trans('labels.not_found') }}</td>
                                </tr>

                            </tbody>
                        </table>

                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="base-tab11" data-toggle="tab"
                                                aria-controls="tab11" href="#tab11" aria-expanded="true">
                                                @lang('tms::trainee.personal_info')
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab12" data-toggle="tab"
                                                aria-controls="tab12" href="#tab12" aria-expanded="false">
                                                @lang('tms::training.general_info')
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab13" data-toggle="tab"
                                                aria-controls="tab13" href="#tab13" aria-expanded="false">
                                                @lang('tms::training.educational_info')
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab14" data-toggle="tab"
                                                aria-controls="tab14" href="#tab14" aria-expanded="false">
                                                @lang('tms::training.trainee_service')
                                            </a>
                                        </li>
                                        <!-- salary-outstanding data -->
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab15" data-toggle="tab"
                                                aria-controls="tab15" href="#tab15" aria-expanded="false">
                                                @lang('tms::training.emergency_contact')
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content px-1 pt-1">
                                        <!-- private information -->
                                        <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true"
                                            aria-labelledby="base-tab11">
                                            @include(
                                                'tms::public.training-registration.partials.show-tabs.personal_information'
                                            )
                                        </div>
                                        <!-- general information -->
                                        <div class="tab-pane" id="tab12" aria-labelledby="base-tab12">
                                            @include(
                                                'tms::public.training-registration.partials.show-tabs.general_information'
                                            )
                                        </div>
                                        <!-- education information -->
                                        <div class="tab-pane" id="tab13" aria-labelledby="base-tab13">
                                            @include(
                                                'tms::public.training-registration.partials.show-tabs.education_information'
                                            )
                                        </div>
                                        <!-- Job information -->
                                        <div class="tab-pane" id="tab14" aria-labelledby="base-tab14">
                                            @include(
                                                'tms::public.training-registration.partials.show-tabs.job_information'
                                            )
                                        </div>
                                        <!-- Emergency Tab-->
                                        <div class="tab-pane" id="tab15" aria-labelledby="base-tab15">
                                            @include(
                                                'tms::public.training-registration.partials.show-tabs.emergency_information'
                                            )
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions text-center">
                                <a class="btn btn-warning mr-1" role="button"
                                    href="{{ route('training-registration.index') }}">
                                    <i class="ft-x"></i> {{ trans('labels.back_page') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
