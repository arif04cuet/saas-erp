@extends('tms::layouts.master')
@section('title', __('tms::annual_training.title').' '.__('labels.show'))

@section('content')

    <!-- General Information Card -->
    <div class="row justify-content-center print-part">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('tms::annual_training.title') @lang('labels.show')</h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements" style="top: 5px;">
                        <ul class="list-inline mb-1">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>

                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <th width="25%">@lang('tms::annual_training.year')</th>
                                    <td>{{$notification->year}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('tms::annual_training.send_dd')</th>
                                    <td>
                                        {{$notification->send_to_divisional_director ? __('labels.yes') : __('labels.no')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.note')</th>
                                    <td><?php echo $notification->note ?></td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.attachments')</th>
                                    <td>
                                        @if($notification->attachment)
                                            <a href="{{route('annual-training-notification.download', $notification->id)}}"
                                               class="">
                                                <i class="la la-file"></i>
                                                {{$notification->attachment_file_name}}
                                            </a>
                                        @else
                                            @lang('labels.not_available')
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('tms::annual_training.notified_date')</th>
                                    <td>{{\Carbon\Carbon::parse($notification->created_at)->format('d F, Y')}}</td>
                                </tr>

                            </table>
                        </div>
                    </div>


                    <div class="card-body">
                    @if($notification->send_to_divisional_director)
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
                                            <th>@lang('tms::annual_training.view_response')</th>
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
                                                <td>{{$divisionalDirector->getName()}}</td>
                                                <td>{{$department ? $department->name : ''}}</td>
                                                <td>{{$divisionalDirector->email}}</td>
                                                {{--                                                <td>{{ucwords('pending')}}</td>--}}
                                                {{--                                                <td>-</td>--}}
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                       href="{{route('tms.annual-training-notification.response.user.create',
[$notification->id, $ddUser->id])}}" target="_blank">
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
                                class="la la-institution"></i> @lang('tms::annual_training.organization')</h4>
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
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <!-- Organizations -->
                                    @foreach($notification->organizations as $notifiedOrganization)
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
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <!-- Edit -->
                                                     <a href="{{route('annual-training-notification.response.organization.create',$notifiedOrganization->unique_key)}}"
                                                        class="dropdown-item"><i class="ft ft-eye"></i>
                                                            {{trans('tms::annual_training.view_response')}}
                                                     </a>
                                                </span>

                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/ Organizations -->
                    </div>
                </div>

                <div class="card-footer">
                    <div class="col-md-12">
                        {{--                        <a href="{{route('tms-budgets.edit', $notification->id)}}" class="btn btn-success">--}}
                        {{--                            <i class="la la-pencil"></i> @lang('labels.edit')--}}
                        {{--                        </a>--}}
                        <a href="{{route('annual-training-notification.index')}}" class="btn btn-danger">
                            <i class="la la-backward"></i> @lang('labels.back_page')
                        </a>
                        <a href="{{route('annual-training-notification.print',$notification->id)}}"
                           class="btn btn-primary">
                            <i class="la la-print"></i> @lang('labels.print')
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <!-- DataTable Card -->
    </div>
@endsection


