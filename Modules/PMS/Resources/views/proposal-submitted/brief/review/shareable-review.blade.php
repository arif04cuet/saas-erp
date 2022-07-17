@extends('pms::layouts.master')
@section('title', trans('pms::project_proposal.menu_title'). ' '. trans('labels.details'))
@section('content')
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">@lang('pms::project_proposal.menu_title') @lang('labels.details')</h4>
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
                                                        {{--{{ dd($remark) }}--}}
                                                        <hr>
                                                        <p class="text-bold-600 mb-0">
                                                            {{ $remark->user->name }}
                                                        </p>
                                                        <p class="small m-0 comment-time">{{date("j F, Y, g:i a",strtotime($remark->created_at))}}</p>
                                                        <p class="m-0 comment-text">{{$remark->remarks}}</p>
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
                                @if(Request()->viewOnly != 1 && $isValidUser)
                                    @include('pms::proposal-submitted.brief.review.reviewer-add-attachments')
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        @if($isValidUser)
                            @if($proposal->status == 'PENDING' && Request()->viewOnly != 1)
                                {!! Form::open(['url'=> route('project-proposal-submission.feedback',$shareConversationId), 'novalidate', 'class' => 'form', 'id' => 'review_form', 'enctype' => 'multipart/form-data']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--<div class="form-group">--}}
                                        {{--<label>{{__('labels.remarks')}}</label>--}}
                                        {{--<textarea class="form-control" name="approval_remark"></textarea>--}}
                                        {{--</div>--}}

                                        <input name="feature_id" type="hidden" value="{{$feature->id}}">
                                        <input name="ref_table_id" type="hidden" value="{{$proposal->id}}">
                                        <input name="item_id" type="hidden" value="{{$proposal->id}}">

                                        <input name="share_rule_id" type="hidden" value="{{$shareConversation->shareRuleDesignation->share_rule_id}}">
                                        <input name="request_ref_id" type="hidden" value="{{$shareConversation->request_ref_id}}">
                                        <input name="department_id" type="hidden" value="2">

                                        <div class="form-group">
                                            <label>@lang('pms::approved-proposal.share_to')</label>
                                            <select name="designation_id" class="form-control">
                                                @foreach($ruleDesignations as $designation)
                                                    @if($designation->designation_id != $authDesignation)
                                                        <option value="{{$designation->designation_id}}">{{$designation->getDesignation->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                        {{--<div class="form-group">--}}
                                        {{--{{__('labels.message_to_receiver')}}--}}
                                        {{--<textarea name="message" class="form-control"></textarea>--}}
                                        {{--</div>--}}

                                        <div class="form-group">
                                            {!! Form::label('remarks', trans('labels.remarks'), ['class' => 'black']) !!}
                                            {!! Form::textarea('remarks', null, ['class' => 'form-control comment-input', 'rows' => 2,  'placeholder' => '', 'data-validation-required-message'=>trans('labels.This field is required')]) !!}
                                            <div class="help-block"></div>
                                            @if ($errors->has('remarks'))
                                                <div class="help-block red">{{ $errors->first('remarks') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('message') ? 'error' : '' }}">
                                            {!! Form::label('message', trans('labels.message_to_receiver'), ['class' => 'black']) !!}
                                            {!! Form::textarea('message', null, ['class' => 'form-control comment-input', 'rows' => 2, 'placeholder' => '']) !!}
                                            <div class="help-block"></div>
                                            @if ($errors->has('message'))
                                                <div class="help-block">{{ $errors->first('message') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group review_buttons">
                                            @if($shareConversation->shareRuleDesignation->can_approve==true)
                                                <button value="APPROVED" name="status" type="submit" class="btn btn-success">{{trans(('labels.approve'))}}</button>
                                            @endif
                                            <button type="submit" name="status" value="REVIEW" class="btn btn-info">@lang('pms::approved-proposal.share_btn')</button>
                                            @if($shareConversation->shareRuleDesignation->can_reject)
                                                <button type="submit" value="REJECTED" name="status" class="btn btn-warning"><i class="ft-x white"></i> @lang('labels.reject')</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            @endif
                        @endif

                        @if($proposal->status == 'APPROVED')
                            @if(auth()->user()->employee->employeeDepartment->department_code == "PMS")
                                <a href="{{route('project-request-details.create', ['projectProposal'=>$proposal->id]) }}" class="btn btn-primary mr-sm-1">
                                    <i class="ft-file-plus white"></i> @lang('pms::approved-proposal.links.ask_for_details.title')
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
                {{--@else--}}
                {{--<div class="col-md-10">--}}
                {{--<div class="alert bg-danger">--}}
                {{--Error! Either you have submitted your feedback  already or you're not the valid user to access this--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                {{--<a href="{{route('pms')}}" class="btn btn-primary">Back to PMS Dashboard</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--@endif--}}
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script type="text/javascript">
        $('#review_form').submit(function(){
            // $(this).find(':input[type=submit]').css('display', 'none');
            $(this).find('.review_buttons').css('display', 'none');
        });
    </script>

@endpush