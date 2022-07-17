@extends('ims::layouts.master')
@section('title', trans('ims::procurement.settings.title') . ' ' . trans('labels.list'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::procurement.settings.title') @lang('labels.list')</h4>

                        <div class="heading-elements">
                            <a href="{{ route('procurement-bill-settings.create') }}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> {{trans('ims::procurement.settings.create')}}
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-bordered alt-pagination   ">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('labels.title')</th>
                                        <th scope="col">@lang('ims::procurement.settings.bill_type')</th>
                                        <th scope="col">@lang('labels.status')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($settings as $setting)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <a href="{{route('procurement-bill-settings.show', $setting->id)}}">
                                                    {{ $setting->title }}
                                                </a>
                                                @if($setting->is_default)
                                                    <i class="la la-check-circle text-success" style="margin-left: 5px;"
                                                       title="{{__('ims::procurement.settings.default')}}"></i>

                                                @endif
                                            </td>
                                            <td>{{__('ims::procurement.bill_types.' . $setting->bill_type)}}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{config('constants.status_classes')[$setting->status]}}">
                                                    {{ucwords($setting->status)}}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="dropdown">
                                                    <button id="imsProductList" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    <span aria-labelledby="imsProductList"
                                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('procurement-bill-settings.show', $setting->id) }}"
                                                           class="dropdown-item">
                                                            <i class="ft-eye"></i> @lang('labels.details')
                                                        </a>
                                                        <a href="{{ route('procurement-bill-settings.edit', $setting->id) }}"
                                                           class="dropdown-item">
                                                            <i class="ft-edit"></i> @lang('labels.edit')
                                                        </a>
                                                        <a href="{{ route('procurement-bill-settings.activation', $setting->id)}}"
                                                           class="dropdown-item">
                                                            @if($setting->status == 'active')
                                                                <i class="ft-x-circle"></i>
                                                                @lang('labels.inactive')
                                                            @else
                                                                <i class="ft-check-circle"></i>
                                                                @lang('labels.active')
                                                            @endif
                                                        </a>
                                                    </span>
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
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'csv', 'print'],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });
    </script>

@endpush
