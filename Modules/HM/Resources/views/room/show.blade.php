@extends('hm::layouts.master')
@section('title', 'Room Details')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{trans('hm::hostel.room')}} {{trans('labels.details')}}</h4>
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
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td class="width-150">Shortcode</td>
                                            <td class="width-300">ROT*****</td>
                                        </tr>
                                        <tr>
                                            <td>Hostal</td>
                                            <td>HOSTAL 2</td>
                                        </tr>
                                        <tr>
                                            <td>Room Type</td>
                                            <td>AC/2</td>
                                        </tr>
                                        <tr>
                                            <td>Room Size</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>Level</td>
                                            <td>3</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <img src="{{asset('theme/images/portrait/small/avatar-s-26.png')}}" alt="" width="150"><br>
                                        <span> Room ID: RB****X </span>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{ trans('hm::hostel.room')}} {{ trans('labels.history') }}</label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>State</th>
                                                <th>Descriptions</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>12-10-2018</td>
                                                <td>Booked</td>
                                                <td>Booked by LICT Tranning Team 2018</td>
                                                <td><a href="javascript:;" class="text-lg-center"><i class="la la-eye"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>08-08-2018</td>
                                                <td>Booked</td>
                                                <td>Booked by BARD Guest 2018</td>
                                                <td><a href="javascript:;" class="text-lg-center"><i class="la la-eye"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <label>Room Items</label>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Descriptions</th>
                                            <th>Quantity</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>AC2100</td>
                                            <td>AC</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>BD5501</td>
                                            <td>Double Bed</td>
                                            <td>1</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('page-js')

@endpush