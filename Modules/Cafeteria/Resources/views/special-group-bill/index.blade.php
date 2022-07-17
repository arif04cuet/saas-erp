@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::special-service.bill.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">
                <div class="card">
                    <div class="card-header">
                        {!! Form::open(['route' => 'get-special-group-bill', 'id' => 'special-bill-form', 'class' => 'form novalidate']) !!}
                        <h4 class="form-section"><i
                                class="la la-tag"></i>@lang('cafeteria::special-service.bill.title')
                            @lang('cafeteria::cafeteria.list')</h4>
                        <div class="row">
                            <!-- Food Menu -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('group_id', trans('cafeteria::special-service.special_group.title'), ['class' => 'form-label ']) !!}

                                    {!! Form::select('group_id', $groups, null, ['class' => 'form-control select2']) !!}
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

                        <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('special-group-bills.create') }}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('cafeteria::special-service.bill.bill_make') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="special-bill-table">
                                    <thead>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>{{ trans('labels.date') }}</th>
                                            <th>{{ trans('cafeteria::special-service.special_group.advance_amount') }}
                                            </th>
                                            <th>{{ trans('cafeteria::special-service.bill.payment') }}</th>
                                            <th>{{ trans('cafeteria::special-service.bill.due_total') }}</th>
                                            <th>{{ trans('labels.total') }}</th>
                                            <th>{{ trans('labels.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>@lang('labels.grand_total')</th>
                                            <th></th>
                                            <th class="advance-payment"></th>
                                            <th class="total-payment"></th>
                                            <th class="total-due"></th>
                                            <th class="grand-total"></th>
                                            <th></th>
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
    <script src="{{ asset('js/utility/NumberConverter.js') }}" type="text/javascript"></script>
    <script>
        let myInterval;

        let table = $('#special-bill-table').dataTable({
            "stateSave": true
        });

        $("#search").click(function(e) {
            e.preventDefault();
            loadData();
        });

        function loadData() {
            let buttonRef = $('#search').text(`{{ trans('cafeteria::cafeteria.search') }}`);
            buttonRef.removeClass("btn-success").addClass("btn-warning");
            let url = `{{ route('get-special-group-bill') }}`;
            let data = $("#special-bill-form").serialize();
            loadingInfo();
            $.post(url, data, function(data) {
                table.DataTable().clear().draw();
                populateDatatable(data);
                stopLoadingInfo(buttonRef);
            }).fail(function() {
                table.DataTable().clear().draw();
                $('.payment, .due_total').html('');
                stopLoadingInfo(buttonRef);
            });
        }

        function loadingInfo() {
            let placeholder = `{{ trans('cafeteria::cafeteria.searching') }}`;
            let buttonRef = $('#search').html(placeholder);
            let counter = 1;
            myInterval = setInterval(function() {
                if (counter > 0 && counter < 4) {
                    buttonRef.append('.')
                } else {
                    counter = 0;
                    buttonRef.html(placeholder);
                }
                counter++;
            }, 200);
        }

        function stopLoadingInfo(buttonRef) {
            buttonRef.removeClass("btn-warning").addClass("btn-success");
            buttonRef.text(`{{ trans('cafeteria::cafeteria.search') }}`);
            clearInterval(myInterval);
        }

        function populateDatatable(data) {
            let totalPayment = 0;
            let totalDue = 0;
            let grandTotal = 0;
            let advanceAmount = 0;
            console.log(data);
            for (let row = 0; row < data.length; row++) {
                obj = data[row];
                url = `{!! route('special-group-bills.show', ':special_group_bill_id') !!}`;
                url = url.replace(':special_group_bill_id', obj.id);
                table.fnAddData([
                    row + 1,
                    $.datepicker.formatDate("dd-mm-yy", new Date(obj.created_at)),
                    obj.advance_amount,
                    obj.payment,
                    obj.due_total,
                    obj.payment + obj.due_total + obj.advance_amount,
                    '<a class="btn btn-info btn-sm" href="' + url + '"><i class="la la-eye"></i></a>',
                ]);

                advanceAmount += obj.advance_amount;
                totalPayment += obj.payment;
                totalDue += obj.due_total;
                grandTotal += obj.payment + obj.due_total + obj.advance_amount;
            }

            let taka = "@lang('cafeteria::cafeteria.taka')";
            $('.advance-payment').html(`${advanceAmount} ${taka}`);
            $('.total-payment').html(`${totalPayment} ${taka}`);
            $('.total-due').html(`${totalDue} ${taka}`);
            $('.grand-total').html(`${grandTotal} ${taka}`);
        }
    </script>
@endpush
