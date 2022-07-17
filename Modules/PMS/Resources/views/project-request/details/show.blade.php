@extends('pms::layouts.master')
@section('title', trans('pms::project-request-detail.show.title'))
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
    <section>
        <div class="row match-height">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('pms::project-request-detail.show.title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-text">
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.title')</dt>
                                    <dd class="col-sm-9">{{ $projectRequestDetail->title }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('pms::project_proposal.receiver')</dt>
                                    <dd class="col-sm-9">
                                        <ul>
                                            <li>{{ $projectRequestDetail->projectApprovedProposal->proposalSubmittedBy->employee->first_name }} {{ $projectRequestDetail->projectApprovedProposal->proposalSubmittedBy->employee->last_name }}</li>
                                        </ul>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('pms::project_proposal.last_sub_date')</dt>
                                    <dd class="col-sm-9">{{ date('d/m/Y', strtotime($projectRequestDetail->end_date)) }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.attachments')</dt>
                                    <dd class="col-sm-9">
                                        <ul>
                                            @foreach($projectRequestDetail->projectRequestDetailAttachments as $file)
                                                <li>
                                                    <a href="{{url('pms/project-requests-details/file-download/'.$file->id)}}">{{ $file->file_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <ul>
                                            <li>
                                                <b><a href="{{url('pms/project-requests-details/attachment-download/'.$projectRequestDetail->id)}}">@lang('pms::project_proposal.download_all_attachments')</a></b>
                                            </li>
                                        </ul>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.remarks')</dt>
                                    <dd class="col-sm-9"><p
                                                style="font-size: 15px;text-align: justify">{{ $projectRequestDetail->remarks }}</p>
                                    </dd>
                                </dl>
                                <div class="form-actions text-center">
                                    @if(\Carbon\Carbon::today()->lessThanOrEqualTo(Carbon\Carbon::parse($projectRequestDetail->end_date->format('Y-m-d'))))
                                        @if(auth()->user()->employee->employeeDepartment->department_code == "PMS")
                                            <a href="{{ route('project-request-details.edit', $projectRequestDetail->id) }}"
                                               class="btn btn-primary mr-1">
                                                <i class="ft-plus white"></i> @lang('labels.edit')
                                            </a>
                                        @endif
                                    @endif
                                    @if(can_submit_detail_project_proposal($projectRequestDetail))
                                        <a class="btn btn-success mr-1" role="button"
                                           href="{{route('project-details-proposal-submission.create', $projectRequestDetail->id)}}">
                                            <i class="ft-fast-forward"></i> @lang('pms::project_proposal.proposal_submission')
                                        </a>
                                    @endif
                                    <a class="btn btn-warning mr-1" role="button"
                                       href="{{route('project-request-details.index')}}">
                                        <i class="ft-x"></i> @lang('labels.cancel')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

