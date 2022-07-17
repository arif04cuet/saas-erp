@extends('accounts::layouts.master')
@section('title',trans('accounts::gpf.loan.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::gpf.loan.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('gpf-loans.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> @lang('accounts::gpf.loan.gpf_create')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination"
                                   style="text-align: center">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th>@lang('labels.name')</th>
                                    <th>@lang('labels.id')</th>
                                    <th>@lang('accounts::gpf.loan.no_of_loan')</th>
                                    <th>@lang('accounts::gpf.loan.current_balance')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($loans as $loan)
                                    @php
                                        $employee = $loan->employee;
                                        $loans = $loan->loans;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a href="{{route('gpf-loans.show', $loan->id)}}">
                                                {{$employee->first_name." ".$employee->last_name}}
                                            </a>
                                        </td>
                                        <td>{{$employee->employee_id}}</td>
                                        <td>{{count($loans)}}</td>
                                        <td>{{$loans->sum('current_balance')}}</td>
                                        <td>
                                            <a href="{{route('gpf-loans.edit', $loan->id)}}" title="Deposit"
                                               class="btn btn-primary btn-sm">
                                                <i class="la la-money"></i>
                                            </a>
                                            <a href="{{route('gpf-loans.edit', $loan->id)}}" title="@lang('labels.edit')"
                                               class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => route('gpf-loans.destroy', $loan->id),
                                                    'style' => 'display:inline'
                                                    ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete GPF Loan Record',
                                            'onclick'=> 'return confirm("Confirm delete?")',
                                            )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

