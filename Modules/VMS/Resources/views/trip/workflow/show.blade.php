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

                <!-- trip details -->
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
                                <th>@lang('labels.designation')</th>
                                <td>
                                    @php
                                        $employee = $trip->requester;
                                        $designation = trans('labels.not_found');
                                        if(!is_null($employee))
                                        {
                                            $designation = optional($employee->designation)->getName() ?? trans('labels.not_found');
                                        }
                                    @endphp
                                    {{ $designation }}
                                </td>
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
                                <td>{{trans('vms::trip.distance.'.$trip->distance) ?? trans('labels.not_found')}}</td>
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
                                <td class="view-start-date-time">{{ $trip->start_date_time ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::trip.form_elements.end_date_time')</th>
                                <td class="view-end-date-time">{{ $trip->end_date_time ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th class="text text-bold">@lang('vms::trip.limit.form_elements.limit')</th>
                                <td>{{ $userMaxTripLimit ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th class="text text-bold">@lang('vms::trip.limit.crossed_limits')</th>
                                <td>
                                    @if($hasRequesterCrossedLimits)
                                        {{ trans('vms::trip.limit.1') ?? trans('labels.not_found')}}
                                    @else
                                        {{ trans('vms::trip.limit.0') ?? trans('labels.not_found')}}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- edit modal -->
                <a href="#"
                   class="btn btn-sm btn-primary allocate-button"
                   data-toggle="modal"
                   title="{{trans('labels.edit')}}"
                   data-target="#inlineForm">
                    <i class="ft-edit"></i>
                </a>
                @include('vms::trip.partial.trip-edit-modal')
                @if($shouldShowVehicleSelection)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <!-- this has to be handled via ajax and a generic template -->
                                        @include('vms::trip.workflow.vehicle-selection')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @else
                <!-- i have to show the selected vehicles already -->
                    <h4 class="form-section"><i class="la la-tag"></i>
                        @lang('vms::vehicle.index')
                    </h4>
                    <table class="table table-striped table-bordered  text-center">
                        <thead>
                        <tr>
                            <th>@lang('labels.serial')</th>
                            <th>@lang('labels.name')</th>
                            <th>@lang('vms::vehicle.form_elements.vehicle_type_id')</th>
                            <th>@lang('vms::driver.title')</th>
                            <th>@lang('labels.status')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trip->vehicles as $vehicle)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
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
                                <td>{{trans('vms::vehicle.status.'.$vehicle->status)  ?? trans('labels.not_found')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table

                        @endif
                        <!-- previous trip history -->
                    <h4 class="form-section"><i class="la la-tag"></i>
                        @lang('vms::trip.previous_trip_title')
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center"
                               id="journal_entry_table">
                            <thead>
                            <tr>
                                <th width="5%">@lang('labels.serial')</th>
                                <th width="25%">@lang('labels.title')</th>
                                <th width="20%">@lang('vms::trip.form_elements.requester_id')</th>
                                <th width="10%">@lang('vms::trip.form_elements.start_date_time')</th>
                                <th width="5%">@lang('vms::trip.form_elements.end_date_time')</th>
                                <th width="5%">@lang('labels.status')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recentTrips as $recentTrip)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$recentTrip->title ?? trans('labels.not_found')}}</td>
                                    <td>{{ optional($recentTrip->requester)->getName() ?? trans('labels.not_found')}}</td>
                                    <td>{{$recentTrip->start_date_time ?? trans('labels.not_found')}}</td>
                                    <td>{{$recentTrip->end_date_time ?? trans('labels.not_found')}}</td>
                                    <td>
                                        <p class="btn btn-{{$statusCssArray[$recentTrip->status]}} btn-sm">
                                            {{trans('vms::trip.status.'.$recentTrip->status)}}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

            </div>
        </div>
    </div>

    @if($shouldShowApproveRejectButton)
        <div class="form-actions text-center">
            <a class="btn btn-outline-success mr-1" role="button"
               href="{{route('vms.trip.change-status',[$trip->id,\Modules\VMS\Entities\Trip::getStatuses()['approved']])}}">
                <i class="la la-check-square"></i> @lang('labels.approve')
            </a>
            <a class="btn btn-outline-danger mr-1" role="button"
               href="{{route('vms.trip.change-status',[$trip->id,\Modules\VMS\Entities\Trip::getStatuses()['rejected']])}}">
                <i class="ft-x la la-check-square"></i> @lang('labels.reject')
            </a>
        </div>
    @endif

@endsection

@push('page-css')

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">

@endpush

@push('page-js')
    <!-- bootstrap date time picker -->
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script>
        let genericErrorMessage = '{!! trans('labels.generic_error_message') !!}';


        $('.start-date-time').daterangepicker({
            parentEl: ".modal-body",
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
            }
        });
        $('.end-date-time').daterangepicker({
            parentEl: " .modal-body",
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
            }
        });

        $('.trip-edit-form').on('submit', function (e) {
            e.preventDefault();
            let url = '{{route('vms.trip.update-via-ajax',$trip)}}';
            let startDate = $('.start-date-time').val();
            let endDate = $('.end-date-time').val();
            let message = '<div><h3>{{ trans('tms::schedule.message.submit.wait') }}</h3><br> <span class="ft-refresh-cw icon-spin font-medium-2"></span></div>';
            let token = "{{csrf_token()}}";
            // block the UI
            $.blockUI({
                message: message,
                timeout: null, //unblock after 2 seconds
                overlayCSS: {
                    backgroundColor: '#FFF',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
            let messageContainer = $('.blockMsg>div>h3');
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: token,
                    _method: 'PUT',
                    start_date_time: startDate,
                    end_date_time: endDate
                },
                success: function (response) {
                    if (response) {
                        let startDateTime = response.start_date_time;
                        let endDateTime = response.end_date_time;
                        $('.start-date-time').data('daterangepicker').setStartDate(startDateTime);
                        $('.end-date-time').data('daterangepicker').setStartDate(endDateTime);
                        $('.view-start-date-time').html(response.start_date_time);
                        $('.view-end-date-time').html(response.end_date_time);
                        messageContainer.html('<div><h3>{{ trans('tms::schedule.message.submit.success') }}</h3></div>');
                        $('.modal').modal('toggle');
                        $.unblockUI();
                        return true;
                    } else {
                        alert(genericErrorMessage);
                        $.unblockUI();
                        return false;
                    }
                },
                error: function (request, status, error) {
                    alert(genericErrorMessage);
                    $.unblockUI();
                    return false;
                }
            });
        });


        $(document).ready(function () {
            let vehicleTypeElementId = 'filter-vehicle-types';
            let vehiclesTypes = @json($vehicleTypes);
            let requestedVehicleTypeId = @json($requestedVehicleTypeId);
            let table = $('.vehicle-type-selection').DataTable({
                "stateSave": true,
                "columnDefs": [
                    {"orderable": false, "targets": 1}
                ],
                "language": {
                    "search": "{{ trans('labels.search') }}",
                    "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                    "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                    "info": "{{trans('labels.showing')}} _START_ {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
                    "infoFiltered": "( {{ trans('labels.total')}} _MAX_ {{ trans('labels.infoFiltered') }} )",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "{{ trans('labels.next') }}",
                        "previous": "{{ trans('labels.previous') }}"
                    },
                },
            });

            $("div.dataTables_length").append(`
            <label style="margin-left: 20px">
                {{ trans('labels.filtered') }}
            <select id="${vehicleTypeElementId}" class="form-control form-control-sm" style="width: 100px">

                </select>
                {{ trans('labels.records') }}
            </label>
            `);

            // prepare the dropdowns
            let option = '';
            for (key in vehiclesTypes) {
                option += `<option value=${key}>${vehiclesTypes[key]}</option>`;
            }

            $('#' + vehicleTypeElementId).append(option);

            $('#' + vehicleTypeElementId).val(requestedVehicleTypeId);
            $('#' + vehicleTypeElementId).on('change', function () {
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterType = $('#' + vehicleTypeElementId + ' option:selected').html().trim();
                        let typeValue = data[1].trim();
                        console.log(filterType, typeValue);
                        return filterType === "@lang('labels.all')" || filterType === typeValue;
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });
            $('#' + vehicleTypeElementId).trigger('change');
        })


    </script>
@endpush
