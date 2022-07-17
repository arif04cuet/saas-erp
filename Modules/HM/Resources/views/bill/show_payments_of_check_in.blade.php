@extends('hm::layouts.master')
@section('title', 'Payments Details of Check In')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">Payments Details of Check In</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body" style="padding-left: 20px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><span class="text-bold-600">Check In Information</span></p>
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-bordered mb-0">
                                            <tbody>
                                            <tr>
                                                <td class="width-150">Request ID</td>
                                                <td class="width-300">BARDXXXXXX</td>
                                            </tr>
                                            <tr>
                                                <td>Booking Type</td>
                                                <td>Single</td>
                                            </tr>
                                            <tr>
                                                <td>Check In</td>
                                                <td>03-12-2018</td>
                                            </tr>
                                            <tr>
                                                <td>Check Out</td>
                                                <td>03-12-2018</td>
                                            </tr>
                                            <tr>
                                                <td>No. of Guest</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td>No. of Room</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>Room Details</td>
                                                <td>2 (AC)</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p><span class="text-bold-600">Payments Details</span></p>
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-bordered mb-0">
                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Bill Number</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Payment Method</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $count = 0 @endphp
                                            @for($i = rand(2, 8); $i > 1; $i--)
                                                <tr>
                                                    <td>{{ ++$count }}</td>
                                                    <td><a href="{{ route('bill.show', $i) }}" >BILLXXXXX{{$i}}</a></td>
                                                    <td>{{ date('d.m.Y',strtotime("-".$i." days")) }}</td>
                                                    <td>Tk. {{ 500 * $i }}</td>
                                                    <td>
                                                        @if($i%$count)
                                                            Cash
                                                        @else
                                                            Check
                                                        @endif
                                                    </td>
                                                    <td><a href="javascript:;"><i class="la la-eye"></i></a></td>
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding-left: 20px;">
                            <div class="form-actions">
                                <a class="btn btn-warning mr-1" role="button" href="{{ route('bill.index') }}">
                                    <i class="ft-x"></i> Cancel
                                </a>
                                <a class="btn btn-success mr-1" role="button" href="{{ route('bill.payment') }}">
                                    <i class="ft-credit-card"></i> Make Payment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





