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
                                    <td>{{ $purchaseList->title }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.date')</th>
                                    <td>{{ $purchaseList->purchase_date }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.status')</th>
                                    <td><span class="badge badge-secondary">{{ trans('cafeteria::cafeteria.'.$purchaseList->status) }}</span></td>
                                </tr>
                                <tr>
                                    <th>{{trans('cafeteria::food-order.requester')}}</th>
                                    <td>{{ $purchaseList->user == null ? '' : $purchaseList->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.remarks')</th>
                                    <td>{{ $purchaseList->remark }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                @if ($purchaseList->status == "pending" || $purchaseList->status == "draft")

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
                                    @foreach($purchaseList->purchaseItemLists as $item)
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
                                            <td class="total-price">
                                                {{ $item->total_price }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>@lang('labels.grand_total')</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="grand-total"></th>
                                        
                                    </tr>
                                    <tr>
                                        <th>@lang('cafeteria::purchase-list.in_words')</th>
                                        <th colspan="5" class="grand-total-in-words text-right"></th>
                                    </tr>
                                </tfoot>
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
                                        @foreach($purchaseList->purchaseItemLists as $item)
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
                                        @foreach($purchaseList->purchaseItemLists as $item)
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

                <div class="col-md-8">
                   <div class="row">
                    <div class="col-md-3">
                        <h4>@lang('cafeteria::purchase-list.approval_note')</h4>
                    </div>
                    <div class="col-md-6">
                       <textarea class="form-control mb-3" id="" readonly cols="30" rows="3">{{ $purchaseList->approval_note }}</textarea>
                    </div>
                   </div>
                </div>
                @endif

                <div class="card-footer">
                    <div class="col-md-12">
                        <a href="{{route('purchase-lists.index')}}" class="btn btn-danger">
                            <i class="la la-backward"></i> @lang('labels.back_page')
                        </a>
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
                        let numAsEn = convertToEnWords.convert(grandTotal).replace('only', 'taka only');
                        let sentenceCase = numAsEn.charAt(0).toUpperCase() + numAsEn.substr(1).toLowerCase();   
                        $('.grand-total-in-words').html(numAsEn == 'Zero' ? `${numAsEn} Taka` : sentenceCase);
                    @else
                        $('.grand-total').html(enToBnNumber(`${grandTotal}`));
                        $('.grand-total-in-words').html(convertToBnWords.convert(grandTotal) + ` @lang('cafeteria::cafeteria.taka')`);
                    @endif
                }
            })
        }
    </script>
@endpush