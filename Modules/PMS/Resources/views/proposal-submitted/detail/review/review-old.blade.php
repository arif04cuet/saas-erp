@extends('pms::layouts.master')
@section('title', trans('pms::project_proposal.menu_title'). ' '. trans('labels.details'))

@section('content')
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('pms::project_proposal.menu_title') @lang('labels.details')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="black">@lang('labels.title'): </label>
                                        <p class="card-text">{{ $proposal->title }}</p>

                                        <label class="black">@lang('rms::research_proposal.submission_date'): </label>
                                        <p> {{ date('d/m/y', strtotime($proposal->created_at)) }} </p>
                                        <label class="black">@lang('rms::research_proposal.submitted_by'): </label>
                                        <p> {{ $proposal->proposalSubmittedBy->name }} </p>
                                    </div>
                                    @if(count($remarks))
                                        <div class="col-md-12">
                                            <label class="black">@lang('labels.remarks'): </label>
                                            <div class="media">
                                                <div class="media-body">
                                                    @foreach($remarks as $remark)
                                                        <p class="text-bold-600 mb-0">
                                                            {{ $remark->user->name }}
                                                        </p>
                                                        <p class="small m-0 comment-time">{{date("j F, Y, g:i a",strtotime($remark->created_at))}}</p>
                                                        <p class="m-0 comment-text">{{$remark->remarks}}</p>
                                                        <hr/>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    @foreach($proposal->distinctProjectProposalFiles->unique('file_name') as $file)
                                        <li>
                                            <a href="{{url('pms/project-proposal-submission/file-download/'.$file->id)}}">{{ $file->file_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul>
                                    <li>
                                        <b><a href="{{url('pms/project-proposal-submission/attachment-download/'.$proposal->id)}}">@lang('pms::project_proposal.download_all_attachments')</a></b>
                                    </li>
                                </ul>
                                @include('pms::proposal-submitted.review.reviewer-add-attachments')
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">


                        @if($ruleDetails->is_shareable)
                            {!! Form::open(['url'=> route('project-proposal.share'), 'novalidate', 'class' => 'form', 'method' => 'post']) !!}
                            <div class="col-md-6">
                                <input name="feature_id" type="hidden" value="{{$feature_id}}">
                                <input name="ref_table_id" type="hidden" value="{{$proposal->id}}">
                                <input name="request_ref_id" type="hidden" value="{{$wfDetailsId}}">
                                <input name="department_id" type="hidden" value="2">
                                <input name="status" type="hidden" value="ACTIVE">
                                <input name="from_user_id" type="hidden" value="{{Auth::user()->id}}">
                                <div class="form-group">
                                    <label>{{__('labels.share')}}</label>
                                    <select name="designation_id" class="form-control">
                                        @foreach($shareRule->rulesDesignation as $designation)
                                            <option value="{{$designation->designation_id}}">{{$designation->getDesignation->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                {{--<div class="form-group">--}}
                                {{--{{__('labels.message_to_receiver')}}--}}
                                {{--<textarea name="message" class="form-control"></textarea>--}}
                                {{--</div>--}}
                                <div class="form-group {{ $errors->has('message') ? 'error' : '' }}">
                                    {!! Form::label('message', trans('labels.message_to_receiver'), ['class' => 'black']) !!}
                                    {!! Form::textarea('message', null, ['class' => 'form-control comment-input', 'rows' => 2, 'placeholder' => '', 'data-validation-required-message'=>trans('labels.This field is required')]) !!}
                                    <div class="help-block"></div>
                                    @if ($errors->has('message'))
                                        <div class="help-block">{{ $errors->first('message') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="submit" value="SHARE" class="btn btn-info">Send for Review
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            @if($proposal->status != 'APPROVED')
                                {!! Form::open(['url'=> route('project-proposal-submitted-review-update', $proposal->id), 'novalidate', 'class' => 'form']) !!}
                                {!! Form::hidden('reviewUrl', url()->current()) !!}
                                <input type="hidden" name="wf_master" value="{{$wfData['wfMasterId']}}">
                                <input type="hidden" name="wf_conv" value="{{$wfData['wfConvId']}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('labels.remarks')}}</label>
                                            <textarea class="form-control" name="approval_remark"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('labels.message_to_receiver')}}</label>
                                            <textarea class="form-control" name="message_to_receiver"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success" name="status" value="APPROVED"><i
                                                        class="ft-check"></i> {{$ruleDetails->proceed_btn_label}}</button>
                                            @if($reviewButton)

                                                <button type="submit" class="btn btn-info" name="status" value="REJECTED"><i
                                                            class="ft-skip-back"></i> {{$ruleDetails->back_btn_label}}
                                                </button>

                                            @endif
                                            <button type="submit" class="btn btn-danger" name="status" value="CLOSED"><i
                                                        class="ft-x"></i> {{$ruleDetails->reject_btn_label}}</button>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            @else
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="{{ route('project-proposal-submission.index') }}" class="btn btn-warning"><i class="ft-x white"></i> @lang('pms::approved-proposal.links.cancel.title')</a>
                                        <a href="{{ route('project-request-details.create', ['projectProposal'=>$proposal->id]) }}" class="btn btn-primary mr-sm-1"><i class="ft-file-plus white"></i> @lang('pms::approved-proposal.links.ask_for_details.title')</a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('page-css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('theme/vendors/js/charts/jsgantt-improved/docs/jsgantt.css') }}">
@endpush

@push('page-js')

    <script src="{{ asset('theme/vendors/js/charts/jsgantt-improved/docs/jsgantt.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/charts/jsgantt-improved/chart.js') }}" type="text/javascript"></script>

@endpush
