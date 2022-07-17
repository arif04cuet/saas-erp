@extends('hm::layouts.master')
@section('title', trans('hm::bill.list'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{trans('hm::bill.list')}}</h4>
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered alt-pagination">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Bill Number</th>
                                            <th>Booking ID</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th># of Day</th>
                                            <th>Total</th>
                                            <th>Payment</th>
                                            <th>Payment Method</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $count = 0 @endphp
                                        @for($i = rand(2, 20); $i > 1; $i--)
                                            <tr>
                                                <td>{{ ++$count }}</td>
                                                <td><a href="{{ route('bill.show', $i) }}" >BILLXXXXX{{$i}}</a></td>
                                                <td>BK{{$i}}XXX</td>
                                                <td>{{ date('d.m.Y',strtotime("-1 days")) }}</td>
                                                <td>{{ date('d.m.Y') }}</td>
                                                <td>1</td>
                                                <td>Tk. {{ 500 * $i }}</td>
                                                <td>Tk. {{ 500 * $i }}</td>
                                                <td>
                                                    @if($i%$count)
                                                        Cash
                                                    @else
                                                        Check
                                                    @endif
                                                </td>
                                            </tr>
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection