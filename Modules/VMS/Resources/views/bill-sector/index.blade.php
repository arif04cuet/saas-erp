@extends('vms::layouts.master')
@section('title',trans('vms::bill-sector.index'))

@section('content')

    <section id="">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('vms::bill-sector.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('vms.bill-sector.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('vms::bill-sector.create') }}
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
                                        <th>@lang('vms::bill-sector.form_elements.title_english')</th>
                                        <th>@lang('vms::bill-sector.form_elements.title_bangla')</th>
                                        <th>@lang('vms::bill-sector.form_elements.amount')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead
                                    <tbody>
                                    @foreach($vmsBillSectors as $vmsBillSector)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$vmsBillSector->title_english ?? trans('labels.not_found')}}</td>
                                            <td>{{$vmsBillSector->title_bangla ?? trans('labels.not_found')}}</td>
                                            <td>{{$vmsBillSector->amount ?? trans('labels.not_found')}}</td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href=" {{ route('vms.bill-sector.show',$vmsBillSector )}}"
                                                           class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.details')}}</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href=" {{ route('vms.bill-sector.edit', $vmsBillSector)}}"
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
