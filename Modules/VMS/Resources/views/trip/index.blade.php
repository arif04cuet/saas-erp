@extends('vms::layouts.master')
@section('title',trans('vms::trip.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ trans('labels.search') }}
                    </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        {!! Form::open(['route' =>  ['vms.trip.load'],'class' => 'form trip-report-form']) !!}
                        @include('vms::trip.partial.trip-index-search-form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($method == 'POST' || !is_null($trips))
        <section id="">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('vms::trip.index')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{route('vms.trip.create')}}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i> {{ trans('vms::trip.apply.menu_title') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered text-center trip-table"
                                           id="trip-table">
                                        <thead>
                                        <tr>
                                            <th width="5%">@lang('labels.serial')</th>
                                            <th width="25%">@lang('labels.title')</th>
                                            <th width="20%">@lang('vms::trip.form_elements.requester_id')</th>
                                            <th width="10%">@lang('vms::trip.form_elements.start_date_time')</th>
                                            <th width="5%">@lang('vms::trip.form_elements.end_date_time')</th>
                                            <th width="5%">@lang('labels.status')</th>
                                            <th width="30%">@lang('labels.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($trips as $trip)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>
                                                    <a href="{{route('vms.trip.show',$trip)}}">
                                                        {{$trip->title ?? trans('labels.not_found')}}
                                                    </a>
                                                </td>
                                                <td>{{ optional($trip->requester)->getName() ?? trans('labels.not_found')}}</td>
                                                <td>{{$trip->start_date_time ?? trans('labels.not_found')}}</td>
                                                <td>{{$trip->end_date_time ?? trans('labels.not_found')}}</td>
                                                <td>
                                                    <p class="btn btn-{{$statusCssArray[$trip->status]}} btn-sm">
                                                        {{trans('vms::trip.status.'.$trip->status)}}
                                                    </p>
                                                </td>
                                                <td>
                                                    @include('vms::trip.partial.trip-index-action')
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
    @endif
@endsection



@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">

@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>
    <!-- pickadate -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <script>
        $(document).ready(function () {
            validateForm('.trip-report-form');

            $('.month').pickadate({
                max: new Date(),
                format: 'yyyy-mm-d',
                selectMonths: true,
                selectYears: true,
            });

            let statusFilterElementId = 'filter-status';

            let table = $('.trip-table').DataTable({
                "stateSave": true,
                "columnDefs": [
                    {"orderable": false, "targets": 1}
                ],
                "language": {
                    "search": "{{ trans('labels.search') }}",
                    "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                    "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                    "info": "{{trans('labels.showing')}} _START_ {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
                    "infoFiltered": "( {{ trans('labels.total')}} _MAX_ {{ trans('labels.infoFiltered') }} )",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "{{ trans('labels.next') }}",
                        "previous": "{{ trans('labels.previous') }}"
                    },
                },
            });


            $("div.dataTables_length").append(`
            <label style="margin-left: 20px">
                {{ trans('labels.filtered') }}
            <select id="${statusFilterElementId}" class="form-control form-control-sm" style="width: 100px">
                <option value="@lang('labels.all')">@lang('labels.all')</option>
                    <option value="@lang('vms::trip.status.pending')">@lang('vms::trip.status.pending')</option>
                    <option value="@lang('vms::trip.status.rejected')">@lang('vms::trip.status.rejected')</option>
                    <option value="@lang('vms::trip.status.cancelled')">@lang('vms::trip.status.cancelled')</option>
                    <option value="@lang('vms::trip.status.approved')">@lang('vms::trip.status.approved')</option>
                    <option value="@lang('vms::trip.status.ongoing')">@lang('vms::trip.status.ongoing')</option>
                    <option value="@lang('vms::trip.status.completed')">@lang('vms::trip.status.completed')</option>
                </select>
                {{ trans('labels.records') }}
            </label>
            `);


            $('#' + statusFilterElementId).on('change', function () {
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterType = $('#' + statusFilterElementId).val().trim();
                        let typeValue = data[5].trim();
                        return filterType === "@lang('labels.all')" || filterType === typeValue;
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });
        });
    </script>

@endpush
