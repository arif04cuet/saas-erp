@extends('rms::layouts.master')
@section('title', trans('rms::research_proposal.title') . ' '. trans('labels.details'))

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/js/charts/jsgantt-improved/docs/jsgantt.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('rms::research_proposal.title') @lang('labels.details')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content collapse show print-view">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <ul>
                                        @foreach($research->researchProposalSubmissionAttachments as $file)
                                            <li><a href="{{url('rms/research-proposal-submission/file-download/'.$file->id)}}">{{ $file->file_name }}</a></li>
                                        @endforeach
                                    </ul>
                                    <ul>
                                        <li><b><a href="{{url('rms/research-proposal-submission/attachment-download/'.$research->id)}}">@lang('rms::research_proposal.download_all_attachments')</a></b></li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="black">@lang('labels.title'): </label>
                                            <p class="card-text">{{ $research->title }}</p>

                                            <label class="black">@lang('rms::research_proposal.submission_date'): </label>
                                            <p> {{ date('d/m/y', strtotime($research->created_at)) }} </p>

                                            <label class="black">@lang('rms::research_proposal.submitted_by'): </label>
                                            <p> {{ $research->submittedBy->name }} </p>
                                        </div>
                                        <div class="col-md-12">
                                            <hr/>
                                            <div class="form-group">
                                                <label class="black">Comments</label>
                                                <textarea name="message" class="form-control comment-input" placeholder="Write here..." rows="1"></textarea>
                                            </div>
                                            <div class="form-group comment-action-btns" style="display: none">
                                                <button class="btn btn-primary btn-sm comment-save">Save</button>
                                                <button class="btn btn-outline-danger btn-sm comment-reset">Cancel</button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="media">
                                                <div class="media-left pr-1">
                                                    <a href="javascript:;">
                                                        <span class="avatar avatar-online comment-user-avatar">
                                                          <img src="{{ asset('theme/images/portrait/small/avatar-s-1.png') }}" alt="avatar">
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p class="text-bold-600 mb-0">
                                                        <a href="javascript:;" class="comment-user-name">Md. Junayed Hassan</a>

                                                        <a href="javascript:;" class="pull-right comment-delete">
                                                            <i class="ft-trash text-danger"></i>
                                                        </a>
                                                        <a href="javascript:;" class="pull-right comment-edit" style="padding-right: 5px">
                                                            <i class="ft-edit"></i>
                                                        </a>
                                                    </p>
                                                    <p class="small m-0 comment-time">20/06/2018 04:55:00</p>
                                                    <p class="m-0 comment-text">Some modification needed in time management section</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <a class="btn btn-warning mr-1" role="button" href="{{ route('research-proposal-submission.index') }}">
                                        <i class="ft-x"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('page-js')
    <script type="text/javascript">
        $('.comment-input').focus(function (e) {
            $('.comment-action-btns').show();
        });
        $('.comment-reset').click(function (e) {
            $('.comment-input').val('');
            $('.comment-action-btns').hide();
        });
    </script>
@endpush
