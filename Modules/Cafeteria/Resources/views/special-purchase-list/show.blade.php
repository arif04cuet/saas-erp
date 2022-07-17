@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::purchase-list.index'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('cafeteria::purchase-list.title') @lang('labels.show')</h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements" style="top: 5px;">
                        <ul class="list-inline mb-1">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>

                </div>
                <div class="card-content show">
                    <div class="card-body">
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <th>@lang('labels.title')</th>
                                    <td>{{ $list->title }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.date')</th>
                                    <td>{{ $list->purchase_date }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('cafeteria::cafeteria.group')</th>
                                    <td>{{ $list->specialGroup->getName() ?? trans('labels.not_found')}} </td>
                                </tr>
                                <tr>
                                    <th>@lang('cafeteria::special-service.bill.payment')</th>
                                    <td>৳{{ $list->payment }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('cafeteria::special-service.bill.due_total')</th>
                                    <td>৳{{ $list->due_total }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.remarks')</th>
                                    <td>{{ $list->remark }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

               
                    
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>{{trans('cafeteria::purchase-list.name')}}</th>
                                        <th>{{trans('cafeteria::purchase-list.quantity')}}</th>
                                        <th>{{trans('cafeteria::purchase-list.unit')}}</th>
                                        <th>{{trans('cafeteria::purchase-list.unit_price')}}</th>
                                        <th>{{trans('cafeteria::purchase-list.total_price')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list->purchaseItems as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                {{ $item->rawMaterial->getName() ?? trans('labels.not_found') }}
                                            </td>
                                            <td>
                                                {{ $item->quantity }}
                                            </td>
                                            <td>
                                                {{ $item->rawMaterial->unit->getName() ?? trans('labels.not_found') }}
                                            </td>
                                            <td>
                                                {{ $item->unit_price }}
                                            </td>
                                            <td>
                                                {{ $item->total_price }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="card-footer">
                    <div class="col-md-12">
                        <a href="{{route('special-purchase-lists.index')}}" class="btn btn-danger">
                            <i class="la la-backward"></i> @lang('labels.back_page')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection