@extends('rms::layouts.master')
@section('title', trans('rms::research_proposal.invited_research_proposal_details'))

@push('page-css')
    <style>
        .card-body{
            font-size: 15px;
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
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">@lang('labels.title')</h5>
                        <p>{{ $researchRequest->title }}</p>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">@lang('rms::research_proposal.receiver') </h5>
                        <ul>
                            @foreach($researchRequest->researchRequestReceivers as $receiver)
                                <li>{{ $receiver->employeeDetails->first_name }} {{ $receiver->employeeDetails->last_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ trans('rms::research_proposal.last_sub_date') }}</h5>
                        <p>{{ date('d/m/Y', strtotime($researchRequest->end_date)) }}</p>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ trans('labels.attachments') }}</h5>
                        <ul>
                            @foreach($researchRequest->researchRequestAttachments as $file)
                                <li><a href="{{url('rms/research-requests/file-download/'.$file->id)}}">{{ $file->file_name }}</a></li>
                            @endforeach
                        </ul>
                        <ul>
                            <li><b><a href="{{url('rms/research-requests/attachment-download/'.$researchRequest->id)}}">@lang('pms::project_proposal.download_all_attachments')</a></b></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ trans('labels.remarks') }}</h5>
                        <p style="font-size: 15px;text-align: justify">{{ $researchRequest->remarks }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

