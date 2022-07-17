@extends('rms::layouts.master')
@section('title', trans('rms::research-detail-invitation.show.title'))
@push('page-css')
    <style>
        .card-body {
            font-size: 15px;
        }

        ul {
            padding-left: 17px;
        }
    </style>
@endpush

@section('content')
    <section class="row">
        <div class=" col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('rms::research-detail-invitation.show.title')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="card-text">
                            <dl class="row">
                                <dt class="col-sm-3">@lang('labels.title')</dt>
                                <dd class="col-sm-9">{{ $researchDetailInvitation->title }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">@lang('rms::research_proposal.receiver')</dt>
                                <dd class="col-sm-9">
                                    <ul>
                                        <li>{{ $researchDetailInvitation->researchApprovedProposal->submittedBy->employee->first_name }} {{ $researchDetailInvitation->researchApprovedProposal->submittedBy->employee->last_name }}</li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">@lang('rms::research_proposal.last_sub_date')</dt>
                                <dd class="col-sm-9">{{ date('d/m/Y,  h:iA', strtotime($researchDetailInvitation->end_date)) }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">@lang('labels.attachments')</dt>
                                <dd class="col-sm-9">
                                    <ul>
                                        @foreach($researchDetailInvitation->researchDetailInvitationAttachments as $file)
                                            <li>
                                                <a href="{{ route('research-proposal-details.invitation.file-download', ['attachment' => $file->id]) }}">{{ $file->file_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul>
                                        <li>
                                            <b><a href="{{ route('research-proposal-details.invitation.attachment-download', ['researchDetailInvitation' => $researchDetailInvitation->id]) }}">@lang('pms::project_proposal.download_all_attachments')</a></b>
                                        </li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">@lang('labels.remarks')</dt>
                                <dd class="col-sm-9"><p
                                            style="font-size: 15px;text-align: justify">{{ $researchDetailInvitation->remarks }}</p>
                                </dd>
                            </dl>
                            <div class="form-actions text-center">
                                @if(Carbon\Carbon::today()->lessThanOrEqualTo(Carbon\Carbon::parse($researchDetailInvitation->end_date->format('Y-m-d'))))
                                    @if(auth()->user()->employee->employeeDepartment->department_code == "RMS")
                                        <a href="{{ route('research-proposal-details.invitation.edit', ['researchDetailInvitation'=>$researchDetailInvitation->id]) }}"
                                           class="btn btn-primary mr-1">
                                            <i class="ft-plus white"></i> @lang('labels.edit')
                                        </a>
                                    @endif
                                @endif
                                @if(can_submit_detail_research_proposal($researchDetailInvitation))
                                    <a class="btn btn-success mr-1" role="button"
                                       href="{{ route('details.create', [$researchDetailInvitation->id]) }}">
                                        <i class="ft-fast-forward"></i> @lang('rms::research_details.submit_detail')
                                    </a>
                                @endif
                                <a class="btn btn-warning mr-1" role="button" href="{{route('invitations')}}">
                                    <i class="ft-x"></i> @lang('labels.cancel')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

