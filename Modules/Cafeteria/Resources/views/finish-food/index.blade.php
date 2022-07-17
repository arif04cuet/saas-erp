@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::finish-food.index'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-xl-12 ">
            <div class="card">
                <div class="card-header">
                {!! Form::open(['route' =>  'finish-foods.filter', 'id' =>'finish-food-form','class' => 'form novalidate']) !!}
                <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::finish-food.title')</h4>
                    <div class="row">
                        <!-- Food Menu -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('food_menu_id',
                                            trans('cafeteria::food-menu.title'),
                                        ['class' => 'form-label ']) !!}

                                {!! Form::select('food_menu_id', $foodMenus, null,
                                    [ 'class'=>'form-control select2',
                                        'placeholder'=>trans('labels.all')])  !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div style="margin-top: 2rem !important">
                                    <!-- Search Button -->
                                    <a class="ft ft-search btn btn-success" id="search">
                                        @lang('cafeteria::cafeteria.search')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                    <a class="heading-elements-toggle" href=""><i
                            class="la la-ellipsis-v font-medium-3"></i></a>
                    @can('cafeteria-menu-access')
                    <div class="heading-elements">
                        {!! Form::open(['route' =>  'unsold-foods.move-unsold-food', 'class' => 'd-inline']) !!}
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i
                                    class="ft-trash-2"></i> {{ trans('cafeteria::unsold-food.move_food') }}
                            </button>
                        {!! Form::close() !!}
                        <a href="{{route('finish-foods.create')}}" class="btn btn-primary btn-sm"><i
                                class="ft-plus white"></i> {{ trans('cafeteria::finish-food.create') }}
                        </a>
                    </div>
                    @endcan
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="finish-food-table">
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
                                    @foreach($finishFoods as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $item->getName() ?? trans('labels.not_found') }}
                                            </td>
                                            <td>
                                                {{ $item->inventories->available_amount }}
                                            </td>
                                            <td>
                                                {{ $item->unit->getName() ?? trans('labels.not_found') }}
                                            </td>
                                            <td>
                                                @php
                                                    $price = $item->unitPrices[0]->price;
                                                @endphp
                                                {{ $price }}
                                            </td>
                                            <td class="total-price">
                                                {{ ($item->inventories->available_amount * $price) }}
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
            </div>
        </div>
    </div>
</div>
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

        let myInterval;

        let table = $('#finish-food-table').dataTable({});

        $("#search").click(function (e) {
            e.preventDefault();
            loadData();
        });

        function loadData() {
            let buttonRef = $('#search').text(`{{trans('cafeteria::cafeteria.search')}}`);
            buttonRef.removeClass("btn-success").addClass("btn-warning");
            let url = `{{route('finish-foods.filter')}}`;
            let data = $("#finish-food-form").serialize();
            loadingInfo();
            $.post(url, data, function (data) {
                table.DataTable().clear().draw();
                populateDatatable(data);
                reCalculateGrandTotal();
                stopLoadingInfo(buttonRef);
             });
        }

        function loadingInfo() {
            let placeholder = `{{trans('cafeteria::cafeteria.searching')}}`;
            let buttonRef = $('#search').html(placeholder);
            let counter = 1;
            myInterval = setInterval(function () {
            if (counter > 0 && counter < 4) {
                buttonRef.append('.')
            } else {
                     counter=0; buttonRef.html(placeholder);
                }
                counter++;
            }, 200);
        }

        function stopLoadingInfo(buttonRef) {
            buttonRef.removeClass("btn-warning").addClass("btn-success");
            buttonRef.text(`{{trans('cafeteria::cafeteria.search')}}`);
            clearInterval(myInterval);
        }


        function reCalculateGrandTotal()
        {
            $('tbody tr').each(function(i) {
                /*
                * added class after regenerate tbody
                */
                $(this).find('td').eq(5).addClass('total-price');

                /*
                * re-calculate grand total
                */
                $('.total-price').each(function(i) {
                      showGrandTotal(i);
                })
            });
        }

        function populateDatatable(data) {
            for (let row = 0; row < data.length; row++) {
                obj = data[row];
                table.fnAddData([
                    row + 1,
                    obj.raw_material_name,
                    obj.quantity,
                    obj.unit_name,
                    obj.unit_price,
                    obj.total_price,
                ]);
            }
        }
    </script>
@endpush
