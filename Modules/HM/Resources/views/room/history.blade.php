@extends('hm::layouts.master')
@section('title', 'Room History')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{ trans('hm::hostel.room')}} {{ trans('labels.history') }}</h4>
                        <p>
                            ROOMSHORTCODE, HOSTEL 2 , Level-3, AC / 2
                        </p>
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
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>State</th>
                                                <th>Descriptions</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>12-10-2018</td>
                                                <td>Booked</td>
                                                <td>Booked by LICT Tranning Team 2018</td>
                                                <td><a href="javascript:;" class="text-lg-center">Details</a></td>
                                            </tr>
                                            <tr>
                                                <td>08-08-2018</td>
                                                <td>Booked</td>
                                                <td>Booked by BARD Guest 2018</td>
                                                <td><a href="javascript:;" class="text-lg-center">Details</a></td>
                                            </tr>
                                            <tr>
                                                <td>08-08-2018</td>
                                                <td>Booked</td>
                                                <td>Booked by BARD Guest 2018</td>
                                                <td><a href="javascript:;" class="text-lg-center">Details</a></td>
                                            </tr>
                                            <tr>
                                                <td>08-08-2018</td>
                                                <td>Booked</td>
                                                <td>Booked by BARD Guest 2018</td>
                                                <td><a href="javascript:;" class="text-lg-center">Details</a></td>
                                            </tr>
                                            <tr>
                                                <td>08-08-2018</td>
                                                <td>Booked</td>
                                                <td>Booked by BARD Guest 2018</td>
                                                <td><a href="javascript:;" class="text-lg-center">Details</a></td>
                                            </tr>
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
    </div>
@endsection
@push('page-js')

@endpush