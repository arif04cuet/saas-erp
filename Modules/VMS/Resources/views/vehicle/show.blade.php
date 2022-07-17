@extends('vms::layouts.master')

@section('title', trans('vms::vehicle.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h1>@lang('vms::vehicle.details')</h1>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <h4 class="form-section"><i class="la la-tag"></i>
                    @lang('vms::vehicle.details')
                </h4>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <table class="table">
                            <tr>
                                <th>@lang('labels.id')</th>
                                <td>{{$vehicle->unique_id ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.name')</th>
                                <td>{{$vehicle->name ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::vehicle.form_elements.price')</th>
                                <td>{{$vehicle->price ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::vehicle.form_elements.seat')</th>
                                <td>{{$vehicle->seat ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::vehicle.form_elements.purchase_date')</th>
                                <td>{{$vehicle->purchase_date ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::driver.title')</th>
                                <td>
                                    @forelse($vehicle->drivers as $driver)
                                        <li>{{$driver->getName() ?? trans('labels.not_found')}}</li>
                                    @empty
                                        {{trans('labels.not_found')}}
                                    @endforelse
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 col-md-6">
                        <table class="table">
                            <tr>
                                <th>@lang('vms::vehicle.form_elements.vehicle_type_id')</th>
                                <td>{{ optional($vehicle->vehicleType)->getTitle() ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::vehicle.form_elements.model')</th>
                                <td>{{$vehicle->model ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::vehicle.form_elements.cc')</th>
                                <td>{{$vehicle->cc ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::vehicle.form_elements.chassis_number')</th>
                                <td>{{$vehicle->chassis_number ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::vehicle.form_elements.registration_number')</th>
                                <td>{{$vehicle->registration_number ?? trans('labels.not_found')}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <h4 class="form-section"><i class="la la-tag"></i>
                    @lang('vms::driver.title')
                </h4>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered alt-pagination text-center">
                            <thead>
                            <tr>
                                <th>@lang('labels.serial')</th>
                                <th>@lang('labels.name')</th>
                                <th>@lang('vms::driver.form_elements.date_of_birth')</th>
                                <th>@lang('vms::driver.form_elements.address')</th>
                                <th>@lang('labels.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicle->drivers as $driver)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$driver->getName() ?? trans('labels.not_found')}}</td>
                                    <td>{{$driver->date_of_birth ?? trans('labels.not_found')}}</td>
                                    <td>{{$driver->address ?? trans('labels.not_found')}}</td>
                                    <td>
                                        <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false" class="btn btn-info dropdown-toggle">
                                            <i class="la la-cog"></i>
                                        </button>
                                        <span aria-labelledby="btnSearchDrop2"
                                              class="dropdown-menu mt-1 dropdown-menu-right">
                                        {!! Form::open(['url' =>  route('vms.vehicles.driver-assign.destroy'), 'method' => 'DELETE', 'class' => 'form',' novalidate']) !!}
                                            {!! Form::hidden('driver_id',$driver->id) !!}
                                            {!! Form::hidden('vehicle_id',$vehicle->id) !!}
                                            {!! Form::button('<i class="ft-trash"></i> ' . trans('labels.delete'), array(
                                                 'type' => 'submit',
                                                 'class' => 'dropdown-item',
                                                 'title' => trans('labels.remove'),
                                                 'onclick'=>'return confirmMessage()',
                                            )) !!}
                                            {!! Form::close() !!}

                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
