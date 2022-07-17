@extends('vms::layouts.master')
@section('title', trans('vms::requisition.title'))
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('vms::requisition.title')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <a href="{{route('vms.requisition.create')}}" class="btn btn-info btn-sm"><i
                            class="ft-plus white"></i> {{ trans('vms::maintenanceItem.items.create') }}
                    </a>
                </div>
            </div>
            <div class="card-content ">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="company-list-table table table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">{{ trans('labels.serial') }}</th>
                                <th width="8%">{{trans('vms::requisition.form.requisition_id')}}</th>
                                <th width="8%">{{trans('vms::requisition.table.requester')}}</th>
                                <th width="15%">{{trans('vms::requisition.form.transport')}}</th>
                                <th width="15%">{{trans('vms::requisition.form.driver')}}</th>

                                <th width="20%">@lang('labels.date')</th>
                                <th width="10%">@lang('vms::requisition.table.total_amount')</th>
                                <th width="8%">@lang('labels.status')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($requisition as $info)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$info->requisition ?? trans('labels.not_found')}}</td>
                                    <td>{{$info->requester->first_name.' '.$info->requester->last_name ?? trans('labels.not_found')}}</td>
                                    <td>{{$info->vehicle->name ?? trans('labels.not_found')}}</td>
                                    <td>{{$info->driver->name_english ?? trans('labels.not_found')}}</td>


                                    <td>{{  date('d M Y', strtotime($info->date)) }}</td>
                                    <td>{{ $info->total_amount ?? trans('labels.not_found')}}</td>
                                    <td>
                                        <p class="btn btn-{{$statusCssArray[$info->status]}} btn-sm">
                                            @lang("vms::requisition.status.$info->status")
                                        </p>
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
@endsection

@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.company-list-table').DataTable({
                'stateSave': true
            });
        });
    </script>
@endpush
