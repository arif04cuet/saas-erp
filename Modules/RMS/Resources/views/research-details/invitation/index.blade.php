@extends('rms::layouts.master')
@section('title',  trans('rms::research_details.research_detail_invitation_list') )

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('rms::research_details.research_detail_invitation_list')</h4>
                        {{--<div class="heading-elements">--}}
                        {{--<a href="" class="btn btn-primary btn-sm"><i--}}
                        {{--class="ft-plus white"></i> </a>--}}

                        {{--</div>--}}
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
                                    @foreach($detailsInvitations as $invitation)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $invitation->title }}</td>
                                            <td>{{ $invitation->remarks }}</td>
                                            <td><a href="{{url('rms/research-proposal-details/invitations/attachment-download/'.$invitation->id)}}">@lang('labels.attachments')</a></td>


                                            <td>{{ $invitation->end_date->format('d/m/Y') }}</td>
                                            <td>{{ $invitation->created_at }}</td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="{{ route('research-proposal-details.invitation.show', $invitation->id) }}"
                                                   class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.show')}}</a>
                                                 <a href="{{ route('research-proposal-details.invitation.edit', $invitation->id) }}"
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
