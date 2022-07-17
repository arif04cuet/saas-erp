@extends('accounts::layouts.master')
@section('title', 'Account Head List')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Account Heads</div>

                    <div class="card-body">

                        <div class="float-right">
                            <a href="{{ route('account-head.create') }}" class="btn btn-primary">Create Account Head</a>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">SL</th>
                                {{--<th scope="col">Parent</th>--}}
                                <th scope="col">Name</th>
                                <th scope="col">Code</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accountHeads as $accountHead)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    {{--<td>{{ $accountHead->parent_id }}</td>--}}
                                    <td>{{ $accountHead->name }}</td>
                                    <td>{{ $accountHead->code }}</td>
                                    <td>{{ $accountHead->description }}</td>
                                    <td>
                                        <a href="{{ route('account-head.edit', $accountHead->id) }}"
                                           class="btn btn-primary">Edit</a>
                                        {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => route('account-head.destroy', $accountHead->id),
                                                'style' => 'display:inline'
                                                ]) !!}
                                        {!! Form::button('Delete', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger',
                                        'title' => 'Delete the Account Head',
                                        'onclick'=>'return confirm("Confirm delete?")',
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="float-right">
                            {{ $accountHeads->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection