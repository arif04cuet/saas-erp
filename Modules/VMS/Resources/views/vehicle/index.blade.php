@extends('vms::layouts.master')
@section('title',trans('vms::vehicle.title'))

@section('content')

    <section id="">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('vms::vehicle.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('vms.vehicles.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('vms::vehicle.create') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination text-center"
                                       id="journal_entry_table">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.name')</th>
                                        <th>@lang('vms::vehicle.form_elements.vehicle_type_id')</th>
                                        <th>@lang('vms::driver.title')</th>
                                        <th>@lang('labels.status')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vehicles as $vehicle)
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
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href=" {{ route('vms.vehicles.edit',  $vehicle->id )}}"></a>
                                                <div class="dropdown-divider"></div>
                                                         <a href="{{ route('vms.vehicles.show',$vehicle) }}"
                                                            class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                                        <div class="dropdown-divider"></div>
                                                            <a href="{{ route('vms.vehicles.edit',  $vehicle->id) }}"
                                                               class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>
                                                        <div class="dropdown-divider"></div>

                                                        <a href="{{ route('vms.vehicles.driver-assign.create',$vehicle->id) }}"
                                                           class="dropdown-item"><i
                                                                class="la la-plus"></i> @lang('vms::vehicle.add_driver')</a>
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
        </div>
    </section>
@endsection



@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>
    <script>

        $(document).ready(function () {
            let table = $('#journal_entry_table').DataTable({
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });
    </script>

@endpush
