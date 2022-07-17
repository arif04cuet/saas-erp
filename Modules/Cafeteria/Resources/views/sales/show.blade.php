@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::sales.index'))

@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('cafeteria::finish-food.title') @lang('cafeteria::sales.title') @lang('labels.show')</h4>
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
                                        @if ($sales->reference_type == "employee")
                                                {{ $sales->employee->employee_id . ' - '
                                                    . $sales->employee->first_name 
                                                    . ' ' . $sales->employee->last_name
                                                    . ' - ' 
                                                    . $sales->employee->mobile_one }}
                                        @elseif($sales->reference_type == "training")
                                            {{ $sales->training->title }}
                                        @else
                                            {{ $sales->reference }}
                                        @endif    
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('cafeteria::sales.type.title')</th>
                                    <td>{{ trans('cafeteria::sales.type.'.$sales->reference_type) }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('cafeteria::sales.paid')</th>
                                    <td> {{\App\Utilities\EnToBnNumberConverter::en2bn($sales->paid)}} @lang('cafeteria::cafeteria.taka')</td>
                                </tr>
                                <tr>
                                    <th>@lang('cafeteria::sales.due')</th>
                                    <td> {{\App\Utilities\EnToBnNumberConverter::en2bn($sales->due) }} @lang('cafeteria::cafeteria.taka')</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.remarks')</th>
                                    <td>{{ $sales->remark }}</td>
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
                                        <th>{{trans('cafeteria::sales.vat')}}</th>
                                        <th>{{trans('cafeteria::purchase-list.total_price')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sales->salesItems as $item)
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
                                                {{ $item->vat }}
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
                                        <th></th>
                                        <th class="grand-total"></th>
                                    </tr>
                                    <tr>
                                        <th>@lang('cafeteria::purchase-list.in_words')</th>
                                        <th colspan="6" class="grand-total-in-words text-right"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="col-md-12">
                        <a href="{{route('sales.index')}}" class="btn btn-danger">
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