@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::report.sales.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    @include('cafeteria::report.sales.search-form')
                </div>
            </div>
            @if (app('request')->input('start_date'))
                <div class="col-md-12">
                    <div class="card" id="printable">
                        <div class="card-header">
                            <h4>@lang('cafeteria::report.sales.title') @lang('labels.show')</h4>
                        </div>
                        <div class="card-content collapse show">
                            @if (app('request')->input('raw_material_id'))
                                @include('cafeteria::report.sales.product-report')
                            @else
                                @include('cafeteria::report.sales.employee-training-report')
                            @endif

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('page-css')
    <!-- date-picker css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
@endpush

@push('page-js')
    <!-- pickadate -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('js/utility/NumberConverter.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('.total-paid').each(function(i) {
                showPaidGrandTotal(i);
            })

            $('.total-due').each(function(i) {
                showDueGrandTotal(i);
            })

            $('.total-product').each(function(i) {
                showProductGrandTotal(i);
            })

            let biller_type = $('select[name="biller_type"]').val();
            changeVisibility(biller_type)

            let material = $('select[name="raw_material_id"]').find(':selected').text();
            let employee_name = $('select[name="employee_id"]').find(':selected').text();
            let training_name = $('select[name="training_id"]').find(':selected').text();
            $('.material-name').html(material);
            @if (app('request')->input('employee_id'))
                $('.biller-name').html(employee_name);
            @elseif (app('request')->input('training_id'))
                $('.biller-name').html(training_name);
            @else
                $('.biller-name').html('N/A');
            @endif
        });

        function showPaidGrandTotal(index) {
            let grandTotal = 0;
            $('.total-paid').each(function() {
                let eachTotal = Number($(this).eq(index).html());
                if (!isNaN(eachTotal)) {
                    grandTotal += eachTotal;

                    @if (app()->isLocale('en'))
                        $('.paid-total-taka').html(bnToEnNumber(`${grandTotal} @lang('cafeteria::cafeteria.taka')`));
                    @else
                        $('.paid-total-taka').html(enToBnNumber(`${grandTotal} @lang('cafeteria::cafeteria.taka')`));
                    @endif
                }
            })
        }

        function showDueGrandTotal(index) {
            let grandTotal = 0;
            $('.total-due').each(function() {
                let eachTotal = Number($(this).eq(index).html());
                if (!isNaN(eachTotal)) {
                    grandTotal += eachTotal;

                    @if (app()->isLocale('en'))
                        $('.due-total-taka').html(bnToEnNumber(`${grandTotal} @lang('cafeteria::cafeteria.taka')`));
                    @else
                        $('.due-total-taka').html(enToBnNumber(`${grandTotal} @lang('cafeteria::cafeteria.taka')`));
                    @endif
                }
            })
        }

        function showProductGrandTotal(index) {
            let grandTotal = 0;
            $('.total-product').each(function() {
                let eachTotal = Number($(this).eq(index).html());
                if (!isNaN(eachTotal)) {
                    grandTotal += eachTotal;

                    @if (app()->isLocale('en'))
                        $('.product-total-taka').html(bnToEnNumber(`${grandTotal} @lang('cafeteria::cafeteria.taka')`));
                    @else
                        $('.product-total-taka').html(enToBnNumber(`${grandTotal} @lang('cafeteria::cafeteria.taka')`));
                    @endif
                }
            })
        }

        function changeVisibility(value) {
            if (value == 'training') {
                $('.training').show();
                $('.employee, .raw-material').hide();
                $('select[name="employee_id"], select[name="raw_material_id"]').prop('selectedIndex', 0);
            } else if (value == 'employee') {
                $('.employee').show();
                $('.training, .raw-material').hide();
                $('select[name="training_id"], select[name="raw_material_id"]').prop('selectedIndex', 0);
            } else {
                $('.raw-material').show();
                $('.employee, .training').hide();
                $('select[name="employee_id"], select[name="training_id"]').prop('selectedIndex', 0);
            }
        }

        /**date picker init*/
        $('input[name=start_date], input[name=end_date]').pickadate({
            format: 'yyyy-mm-dd',
            drops: 'up',
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js"
        integrity="sha512-mPA/BA22QPGx1iuaMpZdSsXVsHUTr9OisxHDtdsYj73eDGWG2bTSTLTUOb4TG40JvUyjoTcLF+2srfRchwbodg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // Print The page 
        function printDiv() {
            $("#printable").printArea();
        }
    </script>
@endpush
