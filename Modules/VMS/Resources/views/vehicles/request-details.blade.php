@extends('vms::layouts.master')

@section('title', 'Request Details')

@push('page-css')
    <style>
        .table thead th {
            border-top-color: #626E82 ;
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h1>Request Details</h1>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <table class="table">
                            <tr>
                                <th>Date</th>
                                <td>02/03/2019</td>
                            </tr>
                            <tr>
                                <th>Destination</th>
                                <td>Comilla to Dhaka</td>
                            </tr>
                            <tr>
                                <th>Previous use</th>
                                <td>0</td>
                            </tr>
                            <tr>
                                <th>Purpose of use</th>
                                <td>Official</td>
                            </tr>
                            <tr>
                                <th>Receive Location</th>
                                <td>Bahdursa</td>
                            </tr>
                            <tr>
                                <th>Receive Time</th>
                                <td>29:00</td>
                            </tr>
                            <tr>
                                <th>Return Date</th>
                                <td>20/03/2019</td>
                            </tr>
                            <tr>
                                <th>Return Time</th>
                                <td>10:50</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 col-md-6">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Id</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Model</th>
                                <th>Seat</th>
                                <th>Cost</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>1</th>
                                <td>vu-09</td>
                                <td>Bus</td>
                                <td>Baby Carriage</td>
                                <td>V-087</td>
                                <td>5</td>
                                <td>12,000</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>vu-07</td>
                                <td>Bus</td>
                                <td>Baby Carriage</td>
                                <td>V-077</td>
                                <td>8</td>
                                <td>19,000</td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
