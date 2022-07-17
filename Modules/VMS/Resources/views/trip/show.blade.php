@extends('vms::layouts.master')

@section('title', trans('vms::trip.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    @if($trip->status == 'rejected')
                        <li><span class="badge badge-danger"
                                  style="padding: 8px;">{{ trans('hm::booking-request.rejected') }}</span>
                        </li>
                    @elseif($trip->status == 'approved')
                        <li><span class="badge badge-success"
                                  style="padding: 8px;">{{ trans('hm::booking-request.approved') }}</span>
                        </li>
                    @else

                        <li><span class="badge badge-warning"
                                  style="padding: 8px;">{{ trans('hm::booking-request.pending') }}</span>
                        </li>
                    @endif

                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
            <div class="card-title">
                <h1>@lang('vms::trip.details')</h1>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <h4 class="form-section"><i class="la la-tag"></i>
                    @lang('vms::trip.details')
                </h4>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <table class="table">
                            <tr>
                                <th>@lang('vms::trip.form_elements.requester_id')</th>
                                <td>{{$trip->requester->getName() ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::trip.form_elements.no_of_passenger')</th>
                                <td>@enToBnNumber($trip->no_of_passenger ?? 0)</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::trip.form_elements.destination')</th>
                                <td>{{$trip->destination ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::trip.form_elements.distance')</th>
                                <td>{{$trip->distance ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::trip.form_elements.type')</th>
                                <td>{{$trip->type ?? trans('labels.not_found')}}</td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-12 col-md-6">
                        <table class="table">
                            <tr>
                                <th>@lang('vms::trip.form_elements.start_date_time')</th>
                                <td>{{ $trip->start_date_time ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::trip.form_elements.end_date_time')</th>
                                <td>{{ $trip->end_date_time ?? trans('labels.not_found')}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- vehicle details -->
                <h4 class="form-section"><i class="la la-tag"></i>
                    @lang('vms::vehicle.details')
                </h4>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center"
                               id="journal_entry_table">
                            <thead>
                            <tr>
                                <th>@lang('labels.serial')</th>
                                <th>@lang('labels.name')</th>
                                <th>@lang('vms::vehicle.form_elements.vehicle_type_id')</th>
                                <th>@lang('vms::driver.title')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trip->vehicles as $vehicle)
                                {!! Form::hidden('vehicles[]',$vehicle->id) !!}
                                <tr>
                                    <th scope="row">
                                        {{$loop->iteration}}
                                    </th>
                                    <td>{{$vehicle->name ?? trans('labels.not_found')}}</td>
                                    <td>{{$vehicle->vehicleType->getTitle() ?? trans('labels.not_found')}}</td>
                                    <td>
                                        @forelse($vehicle->drivers as $driver)
                                            <li>
                                                {{
                                                    $driver->getName() ?? trans('labels.not_found')
                                                 }}
                                            </li>
                                        @empty
                                            {{trans('labels.not_found')}}
                                        @endforelse
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="form-actions text-center">
                        <a class="btn btn-warning" href="{{route('vms.trip.print',$trip)}}">
                            <i class="la la-print"></i> {{trans('labels.print')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
