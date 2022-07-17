@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::report.purchase_list.title'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                @include('cafeteria::report.purchase-list.search-form')
            </div>
        </div>
        @if(app('request')->input('start_date'))
        <div class="col-md-12">
            <div class="card" id="printable">
                <div class="card-header">
                    <h4>@lang('cafeteria::report.purchase_list.title') @lang('labels.show')</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="row">
                            <div class="col-md-10">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>@lang('cafeteria::report.title')</th>
                                        <td>@lang('cafeteria::report.purchase_list.title')</td>
                                        <th>@lang('cafeteria::raw-material.title')</th>
                                        <td class="material-name"></td>
                                    </tr>
                                    <tr>
                                        <th>@lang('cafeteria::report.start_date')</th>
                                        <td>{{ app('request')->input('start_date') ?? '' }}</td>
                                        <th>@lang('cafeteria::report.end_date')</th>
                                        <td>{{ app('request')->input('end_date') ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('cafeteria::report.type.title')</th>
                                        <td>@lang('cafeteria::report.purchase_list.' . app('request')->input('report_type') )</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-bordered" id="finish-food-table">
                                <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        @if (app('request')->input('report_type') == "date-wise")
                                            <th>{{ trans('labels.date') }}</th>
                                        @endif
                                        <th>{{trans('cafeteria::purchase-list.name')}}</th>
                                        <th>{{trans('cafeteria::purchase-list.unit')}}</th>
                                        <th>{{trans('cafeteria::purchase-list.quantity')}}</th>
                                        <th>{{trans('cafeteria::purchase-list.total_price')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($listData) && $listData->isNotEmpty())
                                        @foreach($listData as $data)
                                            <tr>
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                @if (app('request')->input('report_type') == "date-wise")
                                                    <td>{{ $data->purchase_date }}</td>
                                                @endif
                                                <td>
                                                    @if ($data->raw_material_bn_name)
                                                        {{ app()->isLocale('en') ? 
                                                            $data->raw_material_en_name : 
                                                                $data->raw_material_bn_name }}

                                                    @else
                                                        {{ app()->isLocale('en') ? 
                                                            $data->rawMaterial->en_name : 
                                                                $data->rawMaterial->bn_name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->unit_bn_name)
                                                        {{ app()->isLocale('en') ? 
                                                            $data->unit_en_name : 
                                                                $data->unit_bn_name }}

                                                    @else
                                                        {{ app()->isLocale('en') ? 
                                                            $data->rawMaterial->unit->en_name : 
                                                                $data->rawMaterial->unit->bn_name }}
                                                    @endif
                                                </td>
                                                <td>{{ $data->quantity }}</td>
                                                <td class="total-price">{{ $data->total_price }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="6">@lang('labels.empty_table')</td>
                                    </tr>
                                    @endif
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>@lang('labels.grand_total')</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        @if (app('request')->input('report_type') == "date-wise")
                                        <th></th>
                                        @endif
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
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
@push('page-css')
<!-- date-picker css -->
<link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
<link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
<link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
<!-- pickadate -->
<script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{asset('js/utility/NumberConverter.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js"
integrity="sha512-mPA/BA22QPGx1iuaMpZdSsXVsHUTr9OisxHDtdsYj73eDGWG2bTSTLTUOb4TG40JvUyjoTcLF+2srfRchwbodg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
        $(document).ready(function () {
            $('.total-price').each(function(i) {
                showGrandTotal(i);
            })

            let material = $('select[name="raw_material_id"]').find(':selected').text();
            @if(app('request')->input('start_date'))
                $('.material-name').html(material);
            @else
                $('.material-name').html('');
            @endif
        })

        //print report
        function printDiv() {
            $("#printable").printArea();
        }

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

        /**date picker init*/
        $('input[name=start_date], input[name=end_date]').pickadate({
                format: 'yyyy-mm-dd',
                drops: 'up',
            });
</script>
@endpush
