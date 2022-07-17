@extends('accounts::layouts.master')
@section('title',trans('accounts::invoice.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::receipt-payment.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{url(route('receipt-payment.create'))}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('labels.new') @lang('accounts::receipt-payment.title')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr class="text-center">
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('labels.date')</th>
                                    <th>@lang('accounts::receipt-payment.payment_type')</th>
                                    <th>@lang('accounts::receipt-payment.amount')</th>
                                    <th>@lang('labels.status')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i=1;$i<10;$i++)
                                    <tr class="text-center">
                                        <th scope="row">{{$i}}</th>
                                        <td> {{\Carbon\Carbon::yesterday()->subDays($i)->format('d/m/Y')}} </td>
                                        <td>@if($i%2) Receipt @else Payment @endif</td>
                                        <td>{{ 100*$i + $i }}</td>
                                        <td class="badge badge-success">Approved</td>
                                        <td>
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <span aria-labelledby="btnSearchDrop2"
                                                  class="dropdown-menu mt-1 dropdown-menu-right">
                                            <!-- Variance -->
                                            <a href="{{route('journal-entry.show',1)}}"
                                               class="dropdown-item"><i class="ft-eye"></i>
                                                {{trans('accounts::configuration.journal.view')}}</a>
                                        </span>
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

