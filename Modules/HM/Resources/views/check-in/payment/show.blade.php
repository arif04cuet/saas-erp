@extends('hm::layouts.master')
@section('title', trans('hm::bill.title') .' '.trans('labels.details'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('hm::bill.title') @lang('labels.details')</h4>
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
                                            <th>@lang('labels.serial')</th>
                                            <th>Room No</th>
                                            <th>@lang('hm::booking-request.check_in')</th>
                                            <th>@lang('hm::booking-request.check_out')</th>
                                            <th># of Day</th>
                                            <th>Cost/Night</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $count = 0 @endphp
                                        @for($i = rand(2, 5); $i > 1; $i--)
                                            <tr>
                                                <td>{{ ++$count }}</td>
                                                <td>RMC00{{$i}}</td>
                                                <td>{{ date('d.m.Y',strtotime("-1 days")) }}</td>
                                                <td>{{ date('d.m.Y') }}</td>
                                                <td>1</td>
                                                <td>Tk. 500</td>
                                                <td>Tk. 500</td>
                                            </tr>
                                        @endfor
                                        <tr>
                                            <td colspan="6">Total</td>
                                            <td>Tk. {{ 500 * $count }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions text-center no-print">
                                        <button type="button" class="btn btn-primary print pull-left">
                                            <i class="la la-print"></i> Print
                                        </button>
                                        <a class="btn btn-warning mr-1 pull-right" role="button"
                                           href="{{ route('bill.index') }}">
                                            <i class="ft-x"></i> Cancel
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
        // $('.print').click(function() {
        //     $('.print-view').print();
        // });

    </script>

@endpush