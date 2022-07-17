@extends('rms::layouts.master')
@section('title', trans('rms::research_proposal.research_request_details'))
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
                    <h4 class="card-title">@lang('rms::research_proposal.research_request_details')</h4>
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
                                <dd class="col-sm-9">{{ $researchRequest->title }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">@lang('rms::research_proposal.receiver')</dt>
                                <dd class="col-sm-9">
                                    <ul>
                                        @foreach($researchRequest->researchRequestReceivers as $receiver)
                                            <li>{{ $receiver->employeeDetails->first_name }} {{ $receiver->employeeDetails->last_name }}</li>
                                        @endforeach
                                    </ul>
                                </dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">@lang('rms::research_proposal.last_sub_date')</dt>
                                <dd class="col-sm-9">{{ date('d/m/Y', strtotime($researchRequest->end_date)) }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">@lang('labels.attachments')</dt>
                                <dd class="col-sm-9">
                                    <ul>
                                        @foreach($researchRequest->researchRequestAttachments as $file)
                                            <li>
                                                <a href="{{url('rms/research-requests/file-download/'.$file->id)}}">{{ $file->file_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul>
                                        <li>
                                            <b><a href="{{url('rms/research-requests/attachment-download/'.$researchRequest->id)}}">@lang('pms::project_proposal.download_all_attachments')</a></b>
                                        </li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">@lang('labels.remarks')</dt>
                                <dd class="col-sm-9"><p
                                            style="font-size: 15px;text-align: justify">{{ $researchRequest->remarks }}</p>
                                </dd>
                            </dl>
                            <div class="form-actions text-center">
                                @if(Carbon\Carbon::today()->lessThanOrEqualTo(Carbon\Carbon::parse($researchRequest->end_date->format('Y-m-d'))))
                                    @if(auth()->user()->employee->employeeDepartment->department_code == "RMS")
                                        <a href="{{ route('research-request.edit', $researchRequest->id) }}"
                                           class="btn btn-primary mr-1">
                                            <i class="ft-plus white"></i> @lang('labels.edit')
                                        </a>
                                    @endif
                                @endif
                                @if(can_submit_brief_research_proposal($researchRequest))
                                    <a class="btn btn-success mr-1" role="button"
                                       href="{{route('research-proposal-submission.create',$researchRequest->id)}}">
                                        <i class="ft-fast-forward"></i> @lang('rms::research_proposal.research_proposal_submission')
                                    </a>
                                @endif
                                <a class="btn btn-warning mr-1" role="button"
                                   href="{{route('research-request.index')}}">
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

