@extends('ims::layouts.master')
@section('title', trans('ims::procurement.index'))

@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::procurement.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('procurement-billings.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('labels.create') }}
                            </a>

                        </div>
                    </div>
                    @if (!$errors->isEmpty())
                        @foreach($errors->all() as $e)
                            <div class="alert bg-danger white" style="display: block">{{ $e }}</div>
                        @endforeach
                    @endif

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('ims::procurement.order_no')</th>
                                        <th>@lang('labels.title')</th>
                                        <th>@lang('ims::vendor.vendor')</th>
                                        <th>@lang('labels.grand_total')</th>
                                        <th>
                                            @lang('ims::procurement.payable')
                                            <i class="la la-question-circle"
                                               title="{{__('ims::procurement.payable_info')}}"></i>
                                        </th>
                                        <th>@lang('labels.status')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($procurements as $procurement)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>

                                            <td>
                                                <a href="{{route('procurement-billings.show', $procurement->id)}}">
                                                    {{$procurement->order_no}}
                                                </a>
                                            </td>
                                            <td>{{$procurement->title}}</td>
                                            <td>{{$procurement->vendor->name ?? ""}}</td>
                                            <td class="text-right">
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($procurement->grandTotal()) ?? ""}}
                                            </td>
                                            <td class="text-right">
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($procurement->totalAmount()) ?? ""}}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{config('constants.status_classes')[$procurement->status]}}">
                                                {{ucwords($procurement->status) ?? ""}}
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
                                                    <a href="{{route('procurement-billings.show', $procurement->id)}}"
                                                       class="dropdown-item"><i class="ft-eye"></i>
                                                        @lang('labels.details')
                                                    </a>
{{--                                                    <div class="dropdown-divider"></div>--}}
                                                <!-- Edit -->
                                                    {{--                                                     <a href="{{route('budgets.edit',$procurement->id)}}"--}}
                                                    {{--                                                        class="dropdown-item"><i class="ft-pencil"></i>--}}
                                                    {{--                                                            {{trans('labels.edit')}}--}}
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
