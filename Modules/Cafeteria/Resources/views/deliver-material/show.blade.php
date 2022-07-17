@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::deliver-material.title'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('cafeteria::deliver-material.title') @lang('labels.show')</h4>
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
                                    <td>{{ $deliverItem->title }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.date')</th>
                                    <td>{{ $deliverItem->deliver_date }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.status')</th>
                                    <td><span class="badge badge-secondary">{{ trans('cafeteria::cafeteria.'.$deliverItem->status) }}</span></td>
                                </tr>
                                <tr>
                                    <th>{{trans('cafeteria::food-order.requester')}}</th>
                                    <td>{{ $deliverItem->user == null ? '' : $deliverItem->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.remarks')</th>
                                    <td>{{ $deliverItem->remark }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                @if ($deliverItem->status == "pending" || $deliverItem->status == "draft")

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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deliverItem->deliverItemLists as $item)
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @else

                 <!-- Approved Items-->
                 <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('cafeteria::purchase-list.approved_item')<h4>
                        <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($deliverItem->deliverItemLists as $item)
                                        @if ($item->status == "approved")
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
                                            </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rejected Items-->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('cafeteria::purchase-list.rejected_item')<h4>
                        <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($deliverItem->deliverItemLists as $item)
                                        @if ($item->status == "rejected")
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
                                            </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                   <div class="row">
                    <div class="col-md-3">
                        <h4>@lang('cafeteria::purchase-list.approval_note')</h4>
                    </div>
                    <div class="col-md-6">
                       <textarea class="form-control mb-3" id="" readonly cols="30" rows="3">{{ $deliverItem->approval_note }}</textarea>
                    </div>
                   </div>
                </div>
                @endif
                <div class="card-footer">
                    <div class="col-md-12">
                        @if ($deliverItem->status=='pending')
                        <a href="{{route('deliver-materials.approval',$deliverItem->id)}}">
                            <button type="submit" class="btn btn-success">{{ trans('labels.approve') }}</button>
                        </a>
                        @endif
                       
                        <a href="{{route('deliver-materials.index')}}" class="btn btn-danger">
                            <i class="la la-backward"></i> @lang('labels.back_page')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection