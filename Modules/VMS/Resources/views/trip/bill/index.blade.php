@extends('vms::layouts.master')
@section('title',trans('vms::trip.bill.title'))

@section('content')

    <section id="">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('vms::trip.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination text-center"
                                       id="journal_entry_table">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.title')</th>
                                        <th>@lang('vms::trip.form_elements.requester_id')</th>
                                        <th>@lang('vms::trip.form_elements.start_date_time')</th>
                                        <th>@lang('vms::trip.form_elements.end_date_time')</th>
                                        <th>@lang('labels.status')</th>
                                        <th>@lang('vms::trip.bill.labels.payment')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($trips as $trip)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$trip->title ?? trans('labels.not_found')}}</td>
                                            <td>{{ optional($trip->requester)->getName() ?? trans('labels.not_found')}}</td>
                                            <td>{{$trip->start_date_time->format('d F,Y g:i A') ?? trans('labels.not_found')}}</td>
                                            <td>{{$trip->end_date_time->format('d F,Y g:i A') ?? trans('labels.not_found')}}</td>
                                            <td>
                                                <p class="btn btn-{{$statusCssArray[$trip->status]}} btn-sm">
                                                    {{trans('vms::trip.status.'.$trip->status)}}
                                                </p>
                                            </td>
                                            <td>
                                                @if(!is_null($trip->tripBillPayment))
                                                    <p class="btn btn-{{$statusCssArray[optional($trip->tripBillPayment)->status]}} btn-sm">
                                                        {{trans('vms::trip.bill.payment_status.'.optional($trip->tripBillPayment)->status)}}
                                                    </p>
                                                @else
                                                    <p class="btn btn-{{$statusCssArray['pending']}} btn-sm">
                                                        {{trans('vms::trip.bill.payment_status.pending')}}
                                                    </p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('vms.trip.bill.show',$trip)}}"
                                                   class="btn btn-primary btn-sm">
                                                    {{trans('vms::trip.bill.show')}}
                                                </a>
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
        </div>
    </section>
@endsection



@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

@endpush
