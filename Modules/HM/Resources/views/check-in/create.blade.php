@extends('hm::layouts.master')
@section('title', 'Guest Check-in')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{--<h4 class="card-title" id="basic-layout-form">Booking Request List</h4>--}}
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
                                <div class="col-md-6 offset-3">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <a href="{{ route('check-in.approved-booking-requests') }}" class="btn btn-lg btn-block font-medium-1 btn-outline-cyan mb-1 block-without-msg">Aproved Booking Request</a>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12" style="text-align: center;">
                                            <h2>OR</h2>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <a href="{{ route('booking-requests.create', ['bookingType' => 'internal']) }}" class="btn btn-lg btn-block font-medium-1 btn-outline-warning mb-1 block-without-overlay">New Check-in</a>
                                            </div>
                                        </div>
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
