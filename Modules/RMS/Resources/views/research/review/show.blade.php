@extends('rms::layouts.master')
@section('title', trans('rms::research.title') . ' '. trans('labels.details'))

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('rms::research.title') @lang('labels.details')
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
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="black">@lang('labels.title'): </label>
                                            <p class="card-text">{{ $research->title }}</p>

                                            <label class="black">@lang('rms::research_proposal.submission_date'): </label>
                                            <p> {{ date('d/m/y', strtotime($research->created_at)) }} </p>
                                            <label class="black">@lang('rms::research_proposal.submitted_by'): </label>
                                            <p> {{ $research->researchSubmittedByUser->name }} </p>
                                        </div>
                                        @if(count($remarks)>0)
                                            <div class="col-md-12">
                                                <label class="black">@lang('labels.remarks'): </label>
                                                <div class="media">
                                                    <div class="media-body">

                                                        @foreach($remarks as $remark)
                                                            {{--{{ dd($remark) }}--}}
                                                            <hr/>
                                                            <p class="text-bold-600 mb-0">
                                                                {{ $remark->user->name }}
                                                            </p>
                                                            <p class="small m-0 comment-time">{{ date("j F, Y, g:i a",strtotime($remark->created_at)) }}</p>
                                                            <p class="m-0 comment-text">{{ $remark->remarks }}</p>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="card-title">{{trans('rms::research.research_publication_info')}}</h4>
                                    @if(is_null($research->publication))
                                        <dl class="row">
                                            <dt class="col-sm-3"></dt>
                                            <dd class="col-sm-9">{{ trans('labels.empty_table') }}</dd>
                                        </dl>
                                    @else
                                        <dl class="row">
                                            <dt class="col-sm-3">@lang('rms::research.research_publication_short_desc')</dt>
                                            <dd class="col-sm-9">{{ $research->publication->description }}</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-3">@lang('rms::research.research_publication_attachment')</dt>
                                            <dd class="col-sm-9">
                                                @if(is_null($research->publication->attachments))
                                                    {{trans('labels.no_doc_available')}}
                                                @else
                                                    <ul class="list-inline">
                                                        @foreach($research->publication->attachments as $attachment)
                                                            <li class="list-group-item">
                                                                <a href="{{ route('file.download', ['filePath' => $attachment->path, 'displayName' => $research->title.'-publication.'.$attachment->ext]) }}" class="badge bg-info white" style="overflow: hidden; max-width: 80px;" title="{{ $attachment->name }}">{{ $attachment->name  }}</a><br><label class="label"><strong>{{$attachment->ext}}</strong>file</label></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </dd>
                                        </dl>
                                    @endif
                                </div>
                                @if($isValidUser)
                                    <div class="col-md-12">
                                        {!! Form::open(['route' =>  'research.reviewUpdate',  'enctype' => 'multipart/form-data','id' => 'review_form', 'novalidate']) !!}
                                        <hr/>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="share">@lang('rms::research.share_to')</label>
                                                <select class="select2 form-control required" name="employee_id">
                                                    <option value=""></option>
                                                    @foreach($ruleDesignations as $key=>$designation)
                                                        <option value="{{$key}}">{{$designation}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('employee_id'))
                                                    <div class="help-block red">{{ trans('labels.This field is required') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                {!! Form::label('remarks', trans('labels.remarks'), ['class' => 'black']) !!}
                                                {!! Form::textarea('remarks', null, ['class' => 'form-control comment-input', 'rows' => 2, 'required', 'data-validation-required-message' => trans('labels.This field is required'), 'placeholder' => 'Remarks in max 250 chars']) !!}
                                                <div class="help-block" ></div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                {!! Form::label('message', trans('labels.message_to_receiver'), ['class' => 'black']) !!}
                                                {!! Form::textarea('message', null, ['class' => 'form-control comment-input', 'rows' => 2]) !!}
                                            </div>
                                        </div>


                                        {!! Form::hidden('feature', $feature->name) !!}
                                        {!! Form::hidden('feature_id', $feature->id) !!}
                                        {!! Form::hidden('workflow_master_id', $workflowMasterId) !!}
                                        {!! Form::hidden('workflow_conversation_id', $workflowConversationId) !!}
                                        {!! Form::hidden('item_id', $researchId) !!}
                                        <input name="share_rule_id" type="hidden" value="{{$ruleDetails->share_rule_id}}">
                                        {{--                                    {!! Form::button(' <i class="ft-skip-back"></i> Back', ['type' => 'submit', 'class' => 'btn btn-warning mr-1', 'name' => 'type', 'value' => 'publish'] ) !!}--}}
                                        {{--<a class="btn btn-warning mr-1" role="button" href="{{ route('rms.index') }}">--}}
                                        {{--<i class="ft-x"></i> @lang('labels.cancel')</a>--}}
                                        <div class="col-md-10">
                                            <div class="form-group review_buttons">
                                                {!! Form::button(' <i class="ft-check"></i> '.trans('labels.approve'), ['type' => 'submit', 'class' => 'btn btn-success mr-1', 'name' => 'status', 'value' => 'APPROVED'] ) !!}
                                                @if($ruleDetails->is_shareable)
                                                    {!! Form::button(' <i class="ft-share"></i> '.trans('rms::research.share_btn'), ['type' => 'submit', 'class' => 'btn btn-success mr-1', 'name' => 'status', 'value' => 'SHARE', 'id' => 'share_btn'] ) !!}
                                                @endif
                                                {!! Form::button('  <i class="ft-skip-back"></i> '. trans('labels.send_back'), ['type' => 'submit', 'class' => 'btn btn-info mr-1', 'name' => 'status', 'value' => 'REJECTED'] ) !!}
                                                {{--{!! Form::button('  <i class="ft-x"></i>'.trans('labels.reject'), ['type' => 'submit', 'class' => 'btn btn-danger mr-1', 'name' => 'status', 'value' => 'REJECTED'] ) !!}--}}
                                                <a href="{{ route('research-workflow-close-reviewer', [$workflowMasterId, $researchId]) }}" class="btn btn-danger "> <i class="ft-x"></i> @lang('labels.reject')</a>

                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                @endif
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
        $('#review_form').submit(function(){
            // $(this).find(':input[type=submit]').css('display', 'none');
            $(this).find('.review_buttons').css('display', 'none');
        });
    </script>
@endpush
