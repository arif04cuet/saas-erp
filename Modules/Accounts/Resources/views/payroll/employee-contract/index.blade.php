@extends('accounts::layouts.master')
@section('title',trans('accounts::employee-contract.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::employee-contract.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('employee-contracts.import')}}" class="btn btn-sm btn-info">
                                <i class="ft ft-plus white"></i>
                                @lang('accounts::employee-contract.import_contract_amount')
                            </a>
                            <a href="{{route('employee-contracts.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('labels.new') @lang('accounts::employee-contract.title')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-bo dy card-dashboard">
                            <table class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr class="text-center">
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th width="25%">@lang('labels.name')</th>
                                    <th>@lang('accounts::salary-structure.reference')</th>
                                    <th>@lang('accounts::salary-structure.title')</th>
                                    <th width="15%">@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contracts as $contract)
                                    @php
                                        $employee = $contract->employee;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{$employee->getName()  .' - '.$employee->employee_id ?? '' }}</td>
                                        <td>{{$contract->reference ?? ''}}</td>
                                        <td>{{ optional($contract->salaryStructure)->name ?? ''}}</td>
                                        <td width="20%">
                                            <a class="btn btn-sm btn-primary"
                                               href="{{route('employee-contracts.show', $contract->id)}}">
                                                <i class="la la-eye"></i>
                                            </a>
                                            <a class="btn btn-sm btn-info"
                                               href="{{route('employee-contracts.edit', $contract->id)}}">
                                                <i class="la la-pencil"></i>
                                            </a>
                                            {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => route('employee-contracts.destroy', $contract->id),
                                                    'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => trans('labels.delete'),
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

