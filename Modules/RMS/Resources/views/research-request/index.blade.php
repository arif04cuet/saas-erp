@extends('rms::layouts.master')
@section('title', trans('rms::research_proposal.invitation_list'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('rms::research_proposal.invitation_list') }}</h4>
                        <div class="heading-elements">
                            @if(auth()->user()->employee->employeeDepartment->department_code == "RMS")
                                <a href="{{route('research-request.create')}}" class="btn btn-primary btn-sm">
                                    <i class="ft-plus white"></i> {{ trans('rms::research_proposal.new_proposal_request') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="proposal-request-table table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('labels.title')</th>
                                        <th scope="col">@lang('labels.remarks')</th>
                                        <th scope="col">@lang('rms::research_proposal.attached_file')</th>
                                        <th scope="col">@lang('rms::research_proposal.last_sub_date') </th>
                                        <th scope="col">@lang('labels.created_at')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($research_requests as $research_request)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td><a href="{{ route('research-request.show', $research_request->id) }}">{{ $research_request->title }}</a></td>
                                            <td>{{ substr($research_request->remarks, 0,100) }} {{ strlen($research_request->remarks)>100 ? "..." : "" }}</td>
                                            <td><a href="{{url('rms/research-requests/attachment-download/'.$research_request->id)}}">@lang('labels.attachments')</a></td>
                                            <td>{{ date('d/m/Y', strtotime($research_request->end_date)) }}</td>
                                            <td>{{ date('d/m/Y', strtotime($research_request->created_at)) }}</td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="{{ route('research-request.show', $research_request->id) }}"
                                                   class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.show')}}</a>
                                                 <a href="{{ route('research-request.edit', $research_request->id) }}"
                                                    class="dropdown-item"><i class="ft-edit"></i> {{trans('labels.edit')}}</a>
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
        </div>
    </section>
@endsection
@push('page-js')
    <script>
        $(document).ready(function () {
            let table = $('.proposal-request-table').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 5}
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
                }
            });

        });
    </script>
@endpush
