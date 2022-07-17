@extends('hm::layouts.master')
@section('title', trans('hm::bill.bill_generate'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('hm::bill.bill_generate')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show print-view">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Billing Time:</td>
                                            <td>{{ date('d M, Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Bill Number:</td>
                                            <td>BILLXXXXXXX</td>
                                        </tr>
                                        <tr>
                                            <td>Booking ID:</td>
                                            <td>BKXXXXXXXX</td>
                                        </tr>
                                        <tr>
                                            <td>Bill For:</td>
                                            <td>Name</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Booking Type:</td>
                                            <td>Single / Family / Training</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="2%">SL</th>
                                                <th>Room</th>
                                                <th>Check In</th>
                                                <th width="20%">Check Out</th>
                                                <th width="20%"># of Day</th>
                                                <th width="20%">Cost/Night</th>
                                                <th width="10%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="item-list">
                                            <tr>
                                                <td class="text-center"><i class="ft-x text-danger remove-item"></i></td>
                                                <td>RMC00</td>
                                                <td>{{ date('d-m-Y') }}</td>
                                                <td>
                                                    <input type="date" name="check_out">
                                                </td>
                                                <td>
                                                    <input type="number" name="no_of_day">
                                                </td>
                                                <td>
                                                    <input type="number" name="room_rate">
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="text-warning">
                                                <th class="text-center">
                                                    <a id="add-row"><i class="la la-plus text-info" aria-hidden="true"></i></a>
                                                </th>
                                                <th colspan="5">Total</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions text-center no-print">
                                        <a class="btn btn-warning mr-1 pull-left" role="button"
                                           href="{{ route('bill.index') }}">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="button" class="btn btn-primary pull-right">
                                            <i class="ft-save"></i> Save
                                        </button>
                                        <a class="btn btn-info mr-1 pull-left" role="button"
                                           href="{{ route('bill.payment') }}">
                                            <i class="ft-credit-card"></i> Payment
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('js/jquery.print.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        $(".remove-item").css('cursor', 'pointer').click(function(){
            $(this).parents('tr').remove();
        });

        let today = '{{ date('d-m-Y') }}';

        $('#add-row').click(function (e) {
            let row = '<tr>' +
                    '<td class="text-center"><i class="ft-x text-danger remove-item"></i></td>' +
                    '<td>RMC00</td>' +
                    '<td>' + today + '</td>' +
                    '<td>' +
                        '<input type="date" name="check_out">' +
                    '</td>' +
                    '<td>' +
                        '<input type="number" name="no_of_day">' +
                    '</td>' +
                    '<td>' +
                        '<input type="number" name="room_rate">' +
                    '</td>' +
                    '<td></td>' +
                '</tr>';
            $('.item-list').append(row);

            $(".remove-item").off();
            $(".remove-item").css('cursor', 'pointer').click(function(){
                $(this).parents('tr').remove();
            });

        });
        // $('.print').click(function() {
        //     $('.print-view').print();
        // });

    </script>

@endpush