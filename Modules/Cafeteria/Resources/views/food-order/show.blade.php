@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::food-order.index'))

@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('cafeteria::food-order.title') @lang('labels.show')</h4>
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
                                    <th>@lang('cafeteria::sales.bill_to')</th>
                                    <td>
                                        @if ($foodOrders->reference_type == "employee")
                                                {{ $foodOrders->employee->employee_id . ' - '
                                                    . $foodOrders->employee->first_name
                                                    . ' ' . $foodOrders->employee->last_name
                                                    . ' - '
                                                    . $foodOrders->employee->mobile_one }}
                                        @elseif($foodOrders->reference_type == "training")
                                            {{ $foodOrders->training->title }}
                                        @else
                                            {{ $foodOrders->reference }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('cafeteria::sales.type.title')</th>
                                    <td>{{ trans('cafeteria::sales.type.'.$foodOrders->reference_type) }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('cafeteria::food-order.requester')</th>
                                    <td>{{ $foodOrders->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.remarks')</th>
                                    <td>{{ $foodOrders->remark }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                @if ($foodOrders->status == "pending" || $foodOrders->status == "draft")

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
                                    @foreach($foodOrders->foodOrderItems as $item)
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
                                            <th>{{trans('cafeteria::purchase-list.unit_price')}}</th>
                                            <th>{{trans('cafeteria::purchase-list.total_price')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($foodOrders->foodOrderItems as $item)
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
                                                <td>
                                                    {{ $item->unit_price }}
                                                </td>
                                                <td>
                                                    {{ $item->total_price }}
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
                                            <th>{{trans('cafeteria::purchase-list.unit_price')}}</th>
                                            <th>{{trans('cafeteria::purchase-list.total_price')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($foodOrders->foodOrderItems as $item)
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
                                                <td>
                                                    {{ $item->unit_price }}
                                                </td>
                                                <td>
                                                    {{ $item->total_price }}
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
                @endif

                <div class="col-md-5 mb-1">
                    <label for="note">@lang('cafeteria::food-order.note')</label>
                    <textarea name="note" id="note" cols="30" rows="2" class="form-control" readonly>{{ $foodOrders->note }}</textarea>
                </div>

                <div class="card-footer">
                    <div class="col-md-12">
                        <a href="{{route('food-orders.index')}}" class="btn btn-danger">
                            <i class="ft-backward"></i> @lang('labels.back_page')
                        </a>
                        @if(Auth::user()->hasRole(Config::get('constants.cafeteria.roles.cafeteria_manager')))
                            @if($foodOrders->status == "pending")
                                <a href="{{ route('food-orders.approval', $foodOrders->id) }}"
                                   class="btn btn-success"><i class="ft-check-square"></i> {{trans('labels.approve')}}</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('page-js')
    <script src="{{asset('js/utility/NumberConverter.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.total-price').each(function(i) {
                showGrandTotal(i);
            })
        })

        function showGrandTotal(index) {
            let grandTotal = 0;
            $('.total-price').each(function () {
                let eachTotal = Number($(this).eq(index).html());
                if (!isNaN(eachTotal)) {
                    grandTotal += eachTotal;

                    @if(app()->isLocale('en'))
                        $('.grand-total').html(bnToEnNumber(`${grandTotal}`));
                        $('.grand-total-in-words').html(convertToEnWords.convert(grandTotal));
                    @else
                        $('.grand-total').html(enToBnNumber(`${grandTotal}`));
                        $('.grand-total-in-words').html(convertToBnWords.convert(grandTotal));
                    @endif
                }
            })
        }
    </script>
@endpush
