@extends('ims::layouts.master')
@section('title', trans('ims::inventory.item.title') . ' ' . trans('labels.list'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::inventory.item.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">

                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.title')</th>
                                        <th>@lang('labels.id')</th>
                                        <th>@lang('ims::inventory.item_category')</th>
                                        <th>@lang('ims::inventory.inventory_location')</th>
                                        <th>@lang('labels.status')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <a href="{{route('inventory-items.show', $item->id)}}">
                                                    {{$item->title ?? __('labels.not_available')}}
                                                </a>
                                            </td>
                                            <td>{{$item->unique_id ?? ""}}</td>
                                            <td>{{optional($item->category)->name ?? ""}}</td>
                                            <td>
                                                {{optional($item->location)->name ?? __('ims::inventory.item.no_location')}}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{$item->status == 'active' ? "success": "danger"}}">
                                                    {{ucwords($item->status)}}
                                                </span>
                                            </td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <!-- Details -->
                                                    <a href="{{route('inventory-items.show', $item->id)}}"
                                                       class="dropdown-item"><i class="ft-eye"></i>
                                                            {{trans('labels.details')}}
                                                    </a>
                                                    <!-- Edit -->
                                                    @if($item->status == 'inactive')
                                                        <div class="dropdown-divider"></div>
                                                        <a href="{{route('inventory-items.edit', $item->id)}}"
                                                           class="dropdown-item"><i class="ft-edit"></i>
                                                            {{trans('labels.edit')}}
                                                    </a>
                                                    @endif
                                                <!-- Delete -->

                                                    {{--                                                     <a href="#" class="dropdown-item disabled">--}}
                                                    {{--                                                         <i class="ft ft-delete disabled"></i>--}}
                                                    {{--                                                            {{trans('labels.delete')}}--}}
                                                    {{--                                                     </a>--}}
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
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'csv', 'print'],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });
    </script>

@endpush
