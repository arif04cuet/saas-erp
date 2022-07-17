@extends('accounts::layouts.master')
@section('title', 'Chart of Account')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Chart of Account</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('account-head.create') }}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i> Create Account Head</a>
                            <a href="{{ route('account-ledger.create') }}" class="btn btn-warning btn-sm"> <i
                                        class="ft-plus white"></i> Create Account Ledger</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Accounts</th>
                                <th scope="col" width="10%">Type</th>
                                <th scope="col" width="5%">Opening Balance</th>
                                <th scope="col" width="5%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                {!! $chart_of_account !!}
                            </tbody>
                        </table>
                        <div class="float-right">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection