@extends('publication::layouts.master')
@section('title', trans('rms::research_proposal.research_details'))

@section('content')

    <section>
        <div class="row match-height">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="card-title">{{ trans('rms::research_proposal.research_details') }}</h4>
                            </div>
                            <div class="col-md-4">
                                <h4 class="card-title">{{ trans('rms::research.research_publication_info') }}</h4>
                            </div>
                            <div class="col-md-4">
                                <h4 class="card-title">{{ trans('publication::published-research-paper.workorder_info') }}
                                </h4>
                            </div>
                        </div>
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <dl class="row">
                                            <dt class="col-sm-3">@lang('labels.title')</dt>
                                            <dd class="col-sm-9">{{ $details->publicationRequest->research->title }}</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">@lang('rms::research_proposal.submitted_by')</dt>
                                            <dd class="col-sm-9">
                                                {{ $details->publicationRequest->research->researchSubmittedByUser->name }}
                                            </dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">@lang('rms::research_proposal.submission_date')</dt>
                                            <dd class="col-sm-9">
                                                {{ date('d/m/Y,  h:mA', strtotime($details->created_at)) }}</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">@lang('labels.status')</dt>
                                            <dd class="col-sm-9"> <span
                                                    class="badge badge-primary">@lang('publication::publication-request.status.'
                                                    .strtolower($details->status))</span></dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-4">
                                        @if (is_null($details->publicationRequest->research->publication))
                                            <dl class="row">
                                                <dt class="col-sm-3"></dt>
                                                <dd class="col-sm-9">{{ trans('labels.empty_table') }}</dd>
                                            </dl>
                                        @else
                                            <dl class="row">
                                                <dt class="col-sm-3">@lang('rms::research.research_publication_short_desc')
                                                </dt>
                                                <dd class="col-sm-9">{{ $details->publicationRequest->research->title }}
                                                </dd>
                                            </dl>
                                            <dl class="row">
                                                <dt class="col-sm-3">@lang('rms::research.research_publication_attachment')
                                                </dt>
                                                <dd class="col-sm-9">
                                                    @if (is_null($details->publicationRequest->research->publication->attachments))
                                                        {{ trans('labels.no_doc_available') }}
                                                    @else
                                                        <ul class="list-inline">
                                                            @foreach ($details->publicationRequest->research->publication->attachments as $attachment)
                                                                <li class="list-group-item">
                                                                    <a href="{{ route('file.download', ['filePath' => $attachment->path, 'displayName' => $details->publicationRequest->research->title . '-publication.' . $attachment->ext]) }}"
                                                                        class="badge bg-info white"
                                                                        style="overflow: hidden; max-width: 80px;"
                                                                        title="{{ $attachment->name }}">
                                                                        {{ $attachment->name }}</a><br><label
                                                                        class="label"><strong>{{ $attachment->ext }}</strong>
                                                                        file</label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </dd>
                                            </dl>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <dl class="row">
                                            <dt class="col-sm-3">
                                                @lang('publication::published-research-paper.workorder_attachment')</dt>
                                            <dd class="col-sm-9">
                                                <a href="{{ route('file.download', ['filePath' => $details->publishedWorkOrderAttachment->attachment]) }}"
                                                    class="badge bg-info white" style="overflow: hidden; max-width: 80px;"
                                                    title="{{ $details->publishedWorkOrderAttachment->file_name }}">
                                                    {{ $details->publishedWorkOrderAttachment->file_name }}</a><br>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    @include('publication::published-research-paper.form.proof-request-form')
                                    @include('publication::published-research-paper.form.proof-request-comments')
                                    @include('publication::published-research-paper.form.final_research_attachment')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <script>
        $(document).ready(function() {
            validateForm('.review-request-form');

            // datepicker
            $('#last_date').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                startDate: moment().startOf('hour'),
                timePicker: true,
                locale: {
                    format: 'YYYY-MM-DD HH:mm:ss'
                }
            });
        })
    </script>
@endpush
