@extends('hrm::layouts.master')


@section('title', trans('hrm::appraisal.appraisal_list'))


@section('content')

    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::appraisal.appraisal_list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>


                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <table class="appraisals-table table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('hrm::appraisal.reporting_officer_employee')</th>
                                    <th>@lang('hrm::appraisal.reporter')</th>
                                    <th>@lang('hrm::appraisal.signer_officer')</th>
                                    <th>@lang('hrm::appraisal.final_commenter')</th>
                                    <th>@lang('labels.status')</th>
                                    <th>@lang('labels.status')</th>
                                    <th>@lang('labels.status')</th>
                                    <th>@lang('labels.date')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($appraisals as $appraisal)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @if($appraisal->reportingEmployee)
                                                <td>{{ $appraisal->reportingEmployee->first_name  . ' ' . $appraisal->reportingEmployee->last_name }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if($appraisal->reporter)
                                                <td>{{ $appraisal->reporter->first_name  . ' ' . $appraisal->reporter->last_name  }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if($appraisal->signer)
                                                <td>{{ $appraisal->signer->first_name . ' ' . $appraisal->signer->last_name  }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if($appraisal->finisher)
                                                <td>{{ $appraisal->finisher->first_name . ' ' . $appraisal->finisher->last_name }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>{{ trans('hrm::appraisal.status.' . $appraisal->status) }}</td>
                                            <td>{{ $appraisal->status }}</td>
                                            <td>{{ $appraisal->type }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appraisal->created_at)->format('j F, Y') }}</td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i></button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('appraisals.show', ['appraisal' => $appraisal->id]) }}" class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                                        @if(current_user_has_state($appraisal) && $appraisal->status != "completed")
                                                            <a href="{{route('appraisals.edit', ['appraisal'=>$appraisal->id])}}" class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>
                                                        @endif
                                                </span>
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
@push('page-css')

@endpush
@push('page-js')
    <script type="text/javascript">
        let table = $('.appraisals-table').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": 1},
                {
                    "targets" : [6, 7],
                    "visible" : false
                }
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

        $('div.dataTables_length').append(`
            <label style="margin-left: 20px;">
                    <select style="display: inline; width: 200px" class="statusList form-control form-control-sm select2">
                            <option value="all">@lang('hrm::appraisal.all_appraisals')</options>
                            <option value="initialized">@lang('hrm::appraisal.status.initialized')</options>
                            <option value="verified">@lang('hrm::appraisal.status.verified')</options>
                            <option value="reported">@lang('hrm::appraisal.status.reported')</options>
                            <option value="signed">@lang('hrm::appraisal.status.signed')</options>
                            <option value="completed">@lang('hrm::appraisal.status.completed')</options>
                    </select>
            </label>`).append(`
            <label style="margin-left: 20px;">
                    <select style="display: inline; width: 200px" class="classList form-control form-control-sm select2">
                            <option value="all">@lang('hrm::appraisal.all_classes')</options>
                            <option value="first">@lang('hrm::appraisal.first_class')</options>
                            <option value="second">@lang('hrm::appraisal.second_class')</options>
                            <option value="third">@lang('hrm::appraisal.third_class')</options>
                            <option value="fourth">@lang('hrm::appraisal.fourth_class')</options>
                    </select>
            </label>`);


        let appraisalStatusList = $('.statusList'),
            appraisalClassList = $('.classList'),
            selectedStatus = "all",
            selectedClass = "all";


        appraisalStatusList.on('change', function (e) {

            selectedStatus = $(this).val();

            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                let appraisalStatus = data[6],
                    appraisalClass = data[7],
                    status = false;

                if (selectedStatus === "all" || selectedStatus === appraisalStatus) {
                    status = true;
                }

                if(selectedClass === "all" && status === true) {
                    return true;
                }

                if(selectedClass === appraisalClass && status === true) {
                    return true;
                }

                return false;
            });

            table.draw();
            $.fn.dataTable.ext.search.pop();

        });

        appraisalClassList.on('change', function (e) {

            selectedClass = $(this).val();

            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                let appraisalStatus = data[6],
                    appraisalClass = data[7],
                    status = false;

                if (selectedClass === "all" || selectedClass === appraisalClass) {
                    status = true;
                }


                if(selectedStatus === "all" && status === true) {
                    return true;
                }

                if(selectedStatus === appraisalStatus && status === true) {
                    return true;
                }

                return false;
            });

            table.draw();
            $.fn.dataTable.ext.search.pop();

        });

        $(document).ready(function () {
            $('.statusList, .classList').select2({
                width: "300px"
            });
        });
    </script>
@endpush