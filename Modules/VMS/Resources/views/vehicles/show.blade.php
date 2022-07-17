@extends('vms::layouts.master')

{{--@section('title', trans('labels.HRM'))--}}
@section('title', 'VMS')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h1>VMS -</h1>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <h4 class="form-section"><i class="la la-tag"></i>
                    @lang('vms::vehicle.details')
                </h4>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <td>v023</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>Baby Carriage</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>12,000</td>
                            </tr>
                            <tr>
                                <th>Seat</th>
                                <td>29</td>
                            </tr>
                            <tr>
                                <th>Year</th>
                                <td>2018</td>
                            </tr>
                            <tr>
                                <th>Driver Name</th>
                                <td>--</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 col-md-6">
                        <table class="table">
                            <tr>
                                <th>Type</th>
                                <td>Bus</td>
                            </tr>
                            <tr>
                                <th>Model</th>
                                <td>V-087</td>
                            </tr>
                            <tr>
                                <th>CC</th>
                                <td>G-855</td>
                            </tr>
                            <tr>
                                <th>Chesis No</th>
                                <td>29</td>
                            </tr>
                            <tr>
                                <th>Registration No</th>
                                <td>2018</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>-</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
