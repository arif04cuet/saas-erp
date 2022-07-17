@extends('hm::layouts.master')
@section('title', __('hm::booking-request.check_in'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
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
                                                <a href="{{ route('check-in.approved-booking-requests') }}"
                                                   class="btn btn-lg btn-block font-medium-1 btn-outline-cyan mb-1 block-without-msg">
                                                    @lang('hm::checkin.from_approved_booking')
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12" style="text-align: center;">
                                            <h2></h2>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <a href="{{ route('check-in.approved-training.create') }}"
                                                   class="btn btn-lg btn-block font-medium-1 btn-outline-danger mb-1 block-without-msg">
                                                    @lang('hm::checkin.from_approved_training_booking')
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12" style="text-align: center;">
                                            <h2></h2>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <a href="{{ route('check-in.create') }}"
                                                   class="btn btn-lg btn-block font-medium-1 btn-outline-warning mb-1 block-without-overlay">
                                                    @lang('hm::checkin.walking_checkin')
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
        </div>
    </div>
@endsection
