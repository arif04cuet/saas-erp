@extends('accounts::layouts.master')
@section('title', 'Account Ledger List')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Account Ledger</div>

                    <div class="card-body">

                        <div class="float-right">
                            <a href="{{ route('account-ledger.create') }}" class="btn btn-primary">Create Account Ledger</a>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Head Name</th>
                                <th scope="col">Name</th>
                                <th scope="col">Code</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accountLedgers as $accountLedger)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $accountLedger->account_head_id }}</td>
                                    <td>{{ $accountLedger->name }}</td>
                                    <td>{{ $accountLedger->code }}</td>
                                    <td>{{ $accountLedger->description }}</td>
                                    <td>
                                        <a href="{{ route('account-ledger.edit', $accountLedger->id) }}"
                                           class="btn btn-primary">Edit</a>
                                        {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => route('account-ledger.destroy', $accountLedger->id),
                                                'style' => 'display:inline'
                                                ]) !!}
                                        {!! Form::button('Delete', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger',
                                        'title' => 'Delete the Account Ledger',
                                        'onclick'=>'return confirm("Confirm delete?")',
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="float-right">
                            {{ $accountLedgers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection