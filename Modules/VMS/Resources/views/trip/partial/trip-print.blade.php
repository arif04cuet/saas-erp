<!DOCTYPE html>
<html class="loading" lang="bn" data-textdirection="ltr">
<head>
    <title> {{ trans('labels.print') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css')}} " media="print">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}" media="print">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">
    <style>
        @media print {
            header {
                display: none;
            }

            a[href]:after {
                content: none !important;
            }

            .form-actions {
                display: none;
            }

            @page {
                margin-top: 0;
                margin-bottom: 0;
            }

            body {
                padding-top: 72px;
                padding-bottom: 72px;
                font-size: 18px;
            }
        }

    </style>
</head>

<body>
<!-- General Information Card -->
<div class="container ">
    <div class="row ">


        <div class="col-md-12 col-xl-12 ">
            <div class="card text-center ">

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

                <div class="card-header ">
                    <h4 class="card-title">@lang('hrm::house-circular.application.details')</h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
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

                    </div>
                </div>

                <div class="card-footer">
                    <div class="form-actions text-center">
                        <a class="btn btn-primary"
                           href="{{route('vms.trip.index')}}">
                            <i class="la la-backward"></i> {{trans('labels.back_page')}}
                        </a>
                        <a class="btn btn-warning" href="#" onclick="window.print()">
                            <i class="la la-print"></i> {{trans('labels.print')}}
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <!-- DataTable Card -->
    </div>
</div>

</body>
</html>


<script>
    window.onload = function () {
        window.print();
    }
</script>
