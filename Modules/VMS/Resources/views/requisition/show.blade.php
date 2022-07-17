@extends('vms::layouts.master')
@section('title', trans('vms::requisition.items.details'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                @if($requisition->status == 'rejected')
                                    <li><span class="badge badge-danger"
                                              style="padding: 8px;">{{ trans('hm::booking-request.rejected') }}</span>
                                    </li>
                                @elseif($requisition->status == 'approved')
                                    <li><span class="badge badge-success"
                                              style="padding: 8px;">{{ trans('hm::booking-request.approved') }}</span>
                                    </li>
                                @else

                                    <li><span class="badge badge-warning"
                                              style="padding: 8px;">{{ trans('hm::booking-request.pending') }}</span>
                                    </li>
                                @endif

                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                        <div class="card-title">
                            <h1>@lang('vms::trip.details')</h1>
                        </div>
                    </div>
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('vms::requisition.items.details')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="col-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>{{trans('vms::requisition.table.requester')}}</th>
                                    <td> {{$requisition->requester->first_name.' '.$requisition->requester->last_name ?? trans('labels.not_found')}}</td>
                                </tr>
                                <tr>
                                    <th>{{trans('vms::requisition.form.requisition_id')}}</th>
                                    <td>{{$requisition->requisition ?? trans('labels.not_found')}}</td>
                                </tr>

                                <tr>
                                    <th>{{trans('labels.date')}}</th>
                                    <td>{{  date('d M Y', strtotime($requisition->date)) }}</td>
                                </tr>
                                <tr>
                                    <th>{{trans('vms::requisition.form.transport')}}</th>
                                    <td>{{$requisition->vehicle->name  ?? trans('labels.not_found')}}</td>
                                </tr>
                                <tr>
                                    <th>{{trans('vms::requisition.form.driver')}}</th>
                                    <td>{{$requisition->driver->name_english  ?? trans('labels.not_found')}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('vms::requisition.table.total_amount')</th>
                                    <td>{{$requisition->total_amount ?? trans('labels.not_found')}}</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="col-12">
                            @if(empty($requisition->update_by))
                        @include('vms::requisition.edit.itemTable')
                            @else
                                @include('vms::requisition.edit.itemdetails')
                                {{-- @include('vms::requisition.edit.itemTable') --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('page-js')
    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>
    <script>
        $(`.repeater-medicine`).repeater({
            initEmpty: false,
            show: function () {
                $(this).find('.select2-container').remove();
                $(this).find('select').select2({
                    placeholder: 'Select a Option'
                });

                $(this).slideDown();
            },

        });

        $(document).ready(function () {
            validateForm('.maintenanceIteForm');

        });

        $('.select2').select2({
            allowClear: true
        });
        $('.datepicker').pickadate({
            selectMonths: true,
            selectYears: true,
            format: 'mmm yyyy'
        });
    </script>
@endpush
