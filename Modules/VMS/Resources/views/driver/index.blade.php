@extends('vms::layouts.master')
@section('title',trans('vms::driver.title'))

@section('content')

    <section id="">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('vms::driver.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('vms.drivers.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('vms::driver.create') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination text-center">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.name')</th>
                                        <th>@lang('vms::driver.form_elements.date_of_birth')</th>
                                        <th>@lang('vms::driver.form_elements.license_number')</th>
                                        <th>@lang('vms::driver.form_elements.address')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($drivers as $driver)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$driver->getName() ?? trans('labels.not_found')}}</td>
                                            <td>{{$driver->date_of_birth ?? trans('labels.not_found')}}</td>
                                            <td>{{$driver->license_number ?? trans('labels.not_found')}}</td>
                                            <td>{{$driver->address ?? trans('labels.not_found')}}</td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href=" {{ route('vms.drivers.edit',  $driver->id )}}"
                                                           class="dropdown-item"><i class="ft-edit"></i> {{trans('labels.edit')}}</a>
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
@endpush
