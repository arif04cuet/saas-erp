@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.cv_evaluation'))

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('hrm::employee.cv_list')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <table class="cv-evaluation-table table table-striped table-bordered" id="cv-list">
                                <thead>
                                <tr>
                                    <th>{{trans('labels.serial')}}</th>
                                    <th>{{trans('hrm::employee.applicant_name')}}</th>
                                    <th>{{trans('hrm::employee.post_title')}}</th>
                                    <th>{{trans('hrm::employee.post_title')}}</th>
                                    <th>{{trans('labels.status')}}</th>
                                    <th>{{trans('labels.status')}}</th>
                                    <th>{{trans('labels.designation')}}</th>
                                    <th>{{trans('job-application.short_listed')}}</th>
                                    <th>{{trans('hrm::employee.apply_date')}}</th>
                                    <th>{{trans('labels.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($applications as $key => $application)
                                    <tr>
                                        {{ Form::hidden('job_application_id'.$key.'', $application->id) }}
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $application->applicant_name }}</td>
                                        <td>{{ $application->jobCircular->title }}</td>
                                        <td>{{ $application->jobCircular->id }}</td>
                                        <td>{{ $application->status }}</td>
                                        <td class="status{{$key}}">{{ trans('job-application.' . $application->status) }}</td>
                                        <td>
                                            @php
                                                // making sure it does not cause null object error
                                                $position = trans('labels.not_found');
                                                $designation = optional($application->jobCircularDetail)->designation;
                                                if(!is_null($designation))
                                                    {
                                                        $position = $designation->getName();
                                                    }
                                            @endphp
                                            {{ $position ?? trans('labels.not_found') }}
                                        </td>
                                        <td>{!! Form::checkbox('status'.$key.'', null,
                                                $application->status == "submitted" ? false : true,
                                                [
                                                    'class' => 'short-listed',
                                                    'disabled' => $application->status == "qualified" ? true : false,
                                                ]) !!}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($application->created_at)->format('j F, Y') }}</td>
                                        <td>
                                                <span class="dropdown">
                                                    <button id="cvEvaluationList" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    <span aria-labelledby="cvEvaluationList"
                                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('job-application.show', ['jobApplication' => $application->id]) }}"
                                                           class="dropdown-item"><i class="ft-eye"></i>@lang('labels.details')</a>
                                                    </span>
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
    <style type="text/css">
        .dataTables_length {
            width: 580px;
        }
    </style>
@endpush

@push('page-js')
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript">
        $('#cv-list').on('click', '.short-listed', function () {
            let name = $(this).attr('name');
            let index = name.match(/\d+/).toString();
            let applicantId = $("input[name='job_application_id" + index + "']").val();
            let status = $(`.status${index}`);
            let url = "{{ route('cv.short-listed') }}";
            let data = {
                "job_application_id": applicantId,
                "_token": "{{ csrf_token() }}",
            }
            $.post(url, data, function (response) {
                status.html(response);
            })
        })

        let table = $('.cv-evaluation-table').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": 1},
                {
                    "targets": [3, 4],
                    "visible": false
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
                    <select style="display: inline; width: 200px" class="job-circulars-list form-control form-control-sm select2">
                            <option value="all">@lang('hrm::job-circular.all_circulars')</options>
                            @foreach($circulars as $circular)
        <option value="{{ $circular->id }}">{{ $circular->title }}</option>
                            @endforeach
        </select>
</label>`).append(`
            <label style="margin-left: 20px;">
                    <select style="display: inline; width: 100%;" class="job-application-status-list form-control form-control-sm">
                        <option value="all">@lang('job-application.all_applications')</options>
                        <option value="short_listed">@lang('job-application.short_listed')</options>
                        <option value="submitted">@lang('job-application.submitted')</options>
                    </select>
            </label>`);


        let jobCircularList = $('.job-circulars-list'),
            jobApplicationStatusList = $('.job-application-status-list'),
            selectedCircular = "all",
            selectedStatus = "all";


        jobCircularList.on('change', function (e) {

            selectedCircular = $(this).val();

            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                let circularId = data[3],
                    applicationStatus = data[4],
                    status = false;

                if (selectedCircular === "all" || selectedCircular === circularId) {
                    status = true;
                }

                if (selectedStatus === "all" && status === true) {
                    return true;
                } else if (selectedStatus === applicationStatus && status === true) {
                    return true;
                }

                return false;

            });

            table.draw();
            $.fn.dataTable.ext.search.pop();

        });

        jobApplicationStatusList.on('change', function (e) {

            selectedStatus = $(this).val();

            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                let circularId = data[3],
                    applicationStatus = data[4],
                    status = false;

                if (selectedStatus === "all" || selectedStatus === applicationStatus) {
                    status = true;
                }

                if (selectedCircular === "all" && status === true) {
                    return true;
                } else if (selectedCircular === circularId && status === true) {
                    return true;
                }

                return false;

            });

            table.draw();
            $.fn.dataTable.ext.search.pop();

        });

        $(document).ready(function () {
            $('.job-circulars-list, .job-application-status-list').select2({
                width: "300px"
            });
        });
    </script>
@endpush
