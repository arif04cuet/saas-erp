@extends('accounts::layouts.master')
@section('title',trans('accounts::invoice.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::invoice.invoice_list') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{url(route('accounts.bill.create'))}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('labels.new') @lang('accounts::bill.title')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th>Date</th>
                                    <th width="25%">Invoice #</th>
                                    <th width="25%">Vendor Name</th>
                                    <th>Due Date</th>
                                    <th width="15%">Amount</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <th scope="row">1</th>
                                    <td> {{\Carbon\Carbon::now()->format('d/m/Y')}} </td>
                                    <td><a href="#">INV-001001</a></td>
                                    <td>Vendor-A</td>
                                    <td>{{\Carbon\Carbon::now()->addDay(1)->diffForHumans()}}</td>
                                    <td>
                                        <a href=""
                                           class="btn btn-primary btn-sm">
                                            <i class="la la-pencil-square"></i>
                                        </a>
                                        {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => "#",
                                                'style' => 'display:inline'
                                                ]) !!}
                                        {!! Form::button('<i class="la la-trash-o"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => 'Delete Economy Code',
                                        'onclick'=> 'return confirm("Confirm delete?")',
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

