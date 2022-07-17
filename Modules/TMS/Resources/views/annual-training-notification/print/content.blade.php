<!-- General Information Card -->
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <table class="table table-borderless text-center">
                <tr class>
                    <td>
                        {{trans('labels.bard_title')}}
                    </td>
                </tr>
                <tr>
                    <td>{{trans('labels.bard_address.kotbari')}}
                        , {{trans('labels.bard_address.cumilla')}}</td>
                </tr>

            </table>

            <div class="card-header text-center">
                <h3 class="card-title">@lang('tms::annual_training.title') @lang('labels.show')</h3>
            </div>
            <div class="card-content collapse show text-center">
                <div class="card-body ">
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <th width="25%">@lang('tms::annual_training.year')</th>
                                <td>{{$annualTrainingNotification->year}} </td>
                            </tr>
                            <tr>
                                <th>@lang('tms::annual_training.send_dd')</th>
                                <td>
                                    {{$annualTrainingNotification->send_to_divisional_director ? __('labels.yes') : __('labels.no')}}
                                </td>
                            </tr>
                            <tr>
                                <th>@lang('labels.note')</th>
                                <td>
                                    {!! $annualTrainingNotification->note ?? trans('labels.not_found') !!}
                                </td>
                            </tr>
                            <tr>
                                <th>@lang('labels.attachments')</th>
                                <td>
                                    @if($annualTrainingNotification->attachment)
                                        <a href="{{route('annual-training-notification.download', $annualTrainingNotification->id)}}"
                                           class="">
                                            <i class="la la-file"></i>
                                            {{$annualTrainingNotification->attachment_file_name}}
                                        </a>
                                    @else
                                        @lang('labels.not_available')
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>@lang('tms::annual_training.notified_date')</th>
                                <td>{{\Carbon\Carbon::parse($annualTrainingNotification->created_at)->format('d F, Y')}}</td>
                            </tr>

                        </table>
                    </div>
                </div>


                <div class="card-body">
                @if($annualTrainingNotification->send_to_divisional_director)
                    <!-- Divisional Director Details -->
                        <h4 class="form-section"><i
                                class="la la-users"></i> @lang('tms::annual_training.dds')</h4>
                        <div class="row">
                            <div class="table-responsive col-sm-12">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('tms::annual_training.dd_name')</th>
                                        <th>@lang('tms::annual_training.department')</th>
                                        <th>@lang('labels.email_address')</th>
                                        {{--                                            <th>@lang('labels.status')</th>--}}
                                        {{--                                            <th>@lang('tms::annual_training.responded_time')</th>--}}
                                        <th class="ignore">@lang('tms::annual_training.view_response')</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <!-- Organizations -->
                                    @foreach($divisionalDirectors as $divisionalDirector)
                                        @php
                                            $department = $divisionalDirector->employeeDepartment;
                                        $ddUser = $divisionalDirector->user;
                                        @endphp
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$divisionalDirector->getName() ?? trans('labels.not_found')}}</td>
                                            <td>{{$department ? $department->name : ''}}</td>
                                            <td>{{$divisionalDirector->email}}</td>
                                            <td class="ignore">
                                                <a class="btn btn-sm btn-primary"
                                                   href="{{route('tms.annual-training-notification.response.user.create',
[$annualTrainingNotification->id, $divisionalDirector->id])}}" target="_blank">
                                                    <i class="la la-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/ Divisional Director -->

                @endif

                <!-- Organization Details -->
                    <h4 class="form-section"><i
                            class=""></i> @lang('tms::annual_training.organization')</h4>
                    <div class="row">
                        <div class="table-responsive col-sm-12">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('tms::annual_training.organization_name')</th>
                                    <th>@lang('labels.email_address')</th>
                                    <th>@lang('labels.status')</th>
                                    <th>@lang('tms::annual_training.responded_time')</th>
                                </tr>
                                </thead>

                                <tbody>
                                <!-- Organizations -->
                                @foreach($annualTrainingNotification->organizations as $notifiedOrganization)
                                    @php
                                        $organization = $notifiedOrganization->organization;
                                    @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$organization ? $organization->name : ''}}</td>
                                        <td>{{$organization ? $organization->contact_person_email : ''}}</td>
                                        <td>{{ucwords($notifiedOrganization->status)}}</td>
                                        <td>{{$notifiedOrganization->date_of_response ?
                                            \Carbon\Carbon::parse($notifiedOrganization->date_of_response)->format('d F, Y') : '-'}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/ Organizations -->
                </div>
            </div>

            <div class="form-actions text-center card-footer">
                <div class="col-md-12">
                    <a href="{{route('annual-training-notification.show',$annualTrainingNotification->id)}}"
                       class="btn btn-danger">
                        <i class="la la-backward"></i> @lang('labels.back_page')
                    </a>
                    <button onclick="window.print();"
                            class="btn btn-primary">
                        <i class="la la-print"></i> @lang('labels.print')
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-- DataTable Card -->
</div>

