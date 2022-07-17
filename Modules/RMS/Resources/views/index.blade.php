@extends('rms::layouts.master')
@section('title', trans('labels.RMS'))

@section('content')
    {{--<h1>@lang('rms::research_proposal.rms')</h1>--}}
    {{--Research Brief  share conversation items --}}
    @if(isset($shareConversations['research_brief_share']))
        <section id="shareConversation">
            <div class="card researchBriefCard">
                <div class="card-body">

                    <h2>@lang('rms::research.research_proposal_pending_items')</h2>
                    <form id="research_bulk_action_form" action="{{ route('research.bulk.action') }}" method="post"
                          name="test">
                        @csrf
                        <table id="{{ ($bulkActionForApprove) ? 'bulkApprove' : '' }}" class="table table-bordered">
                            <thead>
                            @if($bulkActionForApprove)
                                <th style="width: 20px;"></th>@endif
                            <th>@lang('labels.message')</th>
                            <th>@lang('labels.details')</th>
                            <th>@lang('labels.action')</th>
                            </thead>
                            <tbody>
                            {{--                            {{ dd($shareConversations) }}--}}
                            @foreach($shareConversations['research_brief_share'] as $shareConversation)
                                <tr>
                                    @if($bulkActionForApprove)

                                        <td>{{ $shareConversation->feature->name . '|' .   $shareConversation->id. '-' . $shareConversation->ref_table_id}}</td>@endif
                                    <td class="abc">{{$shareConversation->message}}</td>
                                    <td>
                                        {{--                                      dd($shareConversation->feature->name);--}}
                                        @php
                                            // working for research proposal (brief)
                                                $invitation_title =  isset($shareConversation->researchProposal->requester->title) ? $shareConversation->researchProposal->requester->title : '';
                                                $title =  isset($shareConversation->researchProposal->title) ? $shareConversation->researchProposal->title : '';
                                                $submittedBy = isset($shareConversation->researchProposal->submittedBy->name) ? $shareConversation->researchProposal->submittedBy->name : '';
                                                $reviewUrl = 'research-proposal-submission.review';

                                        @endphp
                                        Invitation Title :   {{ $invitation_title }}</br>
                                        Research Title : {{  $title }}<br/>
                                        Initiator Name: {{ $submittedBy }}
                                        <br/>
                                    </td>

                                    <td style="">
                                        <a class="btn btn-primary btn-sm"
                                           href="{{ route($reviewUrl, [$shareConversation->ref_table_id, $shareConversation->workflowDetails->workflow_master_id, $shareConversation->id]) }}">@lang('labels.details')</a>

                                        {{--<a href="{{ route('research-workflow-close-reviewer', [$item->workFlowMasterId, $item->dynamicValues['id']]) }}"--}}
                                        {{--class="btn btn-danger btn-sm">@lang('labels.closed')</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="form" id="approvalReject">
                            <div class="card-footer">
                                <div class="form-group">
                                    @if($bulkActionForApprove)
                                        <button type="submit" name="action_type" value="APPROVED"
                                                class="btn btn-success">@lang('rms::research_details.approved')</button>
                                        <button type="submit" name="action_type" value="REJECTED"
                                                class="btn btn-danger">@lang('rms::research_details.rejected')</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    @endif

    {{--Research  Detail share conversation items --}}
    @if(isset($shareConversations['research_detail_share']))
        <section id="shareConversation">
            <div class="card researchDetailCard">
                <div class="card-body">

                    <h2>@lang('rms::research_details.research_detail_pending_item')</h2>
                    <form id="research_detail_bulk_action_form" action="{{ route('research.bulk.action') }}"
                          method="post" name="test">
                        @csrf
                        <table id="{{ ($bulkActionForApprove) ? 'researchDetailBulk' : '' }}"
                               class="table table-bordered">
                            <thead>
                            @if($bulkActionForApprove)
                                <th style="width: 20px"></th>@endif
                            <th>@lang('labels.message')</th>
                            <th>@lang('labels.details')</th>
                            <th>@lang('labels.action')</th>
                            </thead>
                            <tbody>
                            {{--                            {{ dd($shareConversations) }}--}}
                            {{--4 = Research detail feature id--}}
                            @foreach($shareConversations['research_detail_share'] as $shareConversation)
                                <tr>
                                    @if($bulkActionForApprove)
                                        <td>{{ $shareConversation->feature->name . '|' .   $shareConversation->id. '-' . $shareConversation->ref_table_id}}</td>@endif
                                    <td>{{$shareConversation->message}}</td>
                                    <td>
                                        {{--                                      dd($shareConversation->feature->name);--}}
                                        @php
                                            // working for research detail proposal
                                               $invitation_title =  isset($shareConversation->researchDetail->researchDetailInvitation->title) ? $shareConversation->researchDetail->researchDetailInvitation->title : '';
                                               $title =  isset($shareConversation->researchDetail->title) ? $shareConversation->researchDetail->title : '';
                                               $submittedBy =  isset($shareConversation->researchDetail->user->name) ? $shareConversation->researchDetail->user->name : '';
                                               $reviewUrl = 'research-detail.review';

                                        @endphp
                                        Invitation Title :  {{ $invitation_title }}</br>
                                        Research Title : {{  $title }}<br/>
                                        Initiator Name: {{ $submittedBy }}
                                        <br/>
                                    </td>

                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                           href="{{ route($reviewUrl, [$shareConversation->ref_table_id, $shareConversation->workflowDetails->workflow_master_id, $shareConversation->id]) }}">@lang('labels.details')</a>

                                        {{--<a href="{{ route('research-workflow-close-reviewer', [$item->workFlowMasterId, $item->dynamicValues['id']]) }}"--}}
                                        {{--class="btn btn-danger btn-sm">@lang('labels.closed')</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="form" id="DetailApprovalReject">
                            <div class="card-footer">
                                <div class="form-group">
                                    @if($bulkActionForApprove)
                                        <button type="submit" name="action_type" value="APPROVED"
                                                class="btn btn-success">@lang('rms::research_details.approved')</button>
                                        <button type="submit" name="action_type" value="REJECTED"
                                                class="btn btn-danger">@lang('rms::research_details.rejected')</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    @endif

    @if(isset($shareConversations['research_workflow']))
        <section id="shareConversation">
            <div class="card researchBriefCard">
                <div class="card-body">

                    <h2>@lang('rms::research.research_pending_item')</h2>
                    <form id="research_bulk_action_form" action="{{ route('research.bulk.action') }}" method="post"
                          name="test">
                        @csrf
                        <table id="{{ ($bulkActionForApprove) ? 'bulkApprove' : '' }}" class="table table-bordered">
                            <thead>
                            @if($bulkActionForApprove)
                                <th style="width: 20px;"></th>@endif
                            <th>@lang('labels.message')</th>
                            <th>@lang('labels.details')</th>
                            <th>@lang('labels.action')</th>
                            </thead>
                            <tbody>
                            {{--                            {{ dd($shareConversations) }}--}}
                            @foreach($shareConversations['research_workflow'] as $shareConversation)
                                <tr>
                                    @if($bulkActionForApprove)
                                        <td>{{ $shareConversation->feature->name . '|' .   $shareConversation->id. '-' . $shareConversation->ref_table_id}}</td>@endif
                                    <td class="abc">{{$shareConversation->message}}</td>
                                    <td>
                                        {{--                                      dd($shareConversation->feature->name);--}}
                                        @php
                                            // working for research proposal (brief)
                                                $invitation_title =  isset($shareConversation->research->requester->title) ? $shareConversation->research->requester->title : '';
                                                $title =  isset($shareConversation->research->title) ? $shareConversation->research->title : '';
                                                $submittedBy = isset($shareConversation->research->researchSubmittedByUser->name) ? $shareConversation->research->researchSubmittedByUser->name : '';
                                                $reviewUrl = 'research.review';
                                        @endphp
                                        Invitation Title :   {{ $invitation_title }}</br>
                                        Research Title : {{  $title }}<br/>
                                        Initiator Name: {{ $submittedBy }}
                                        <br/>
                                    </td>

                                    <td style="">
                                        <a class="btn btn-primary btn-sm"
                                           href="{{ route($reviewUrl, [$shareConversation->ref_table_id, $shareConversation->workflowDetails->workflow_master_id, $shareConversation->id]) }}">@lang('labels.details')</a>

                                        {{--<a href="{{ route('research-workflow-close-reviewer', [$item->workFlowMasterId, $item->dynamicValues['id']]) }}"--}}
                                        {{--class="btn btn-danger btn-sm">@lang('labels.closed')</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="form" id="approvalReject">
                            <div class="card-footer">
                                <div class="form-group">
                                    @if($bulkActionForApprove)
                                        <button type="submit" name="action_type" value="APPROVED"
                                                class="btn btn-success">@lang('rms::research_details.approved')</button>
                                        <button type="submit" name="action_type" value="REJECTED"
                                                class="btn btn-danger">@lang('rms::research_details.rejected')</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    @endif

    {{--research proposal brief  pending item--}}
    @if(!empty($pendingTasks->dashboardItems))
        <section id="pending-tasks">
            <div class="card">
                <div class="card-body">
                    <h4>@lang('rms::research.research_proposal_pending_items')</h4>

                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>@lang('labels.message')</th>
                            <th>@lang('labels.details')</th>
                            <th>@lang('labels.action')</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pendingTasks->dashboardItems as $item)

                            <tr>
                                {{--<td>{{ $item->dynamicValues['id'] }}</td>--}}
                                <td>{{$item->message}}</td>
                                <td>
                                    Invitation Title : {{ $item->dynamicValues['research_title'] }}<br/>
                                    Research Title : {{ $item->dynamicValues['proposal_title'] }}<br/>
                                    Initiator Name : {{ $item->dynamicValues['initiator_name'] }}<br/>

                                    <br/>
                                </td>
                                <td><a href="{{url($item->checkUrl)}}"
                                       class="btn btn-primary btn-sm"> @lang('labels.details')</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--{!! Form::open(['route' =>  'research-proposal-submission.reviewUpdate',  'enctype' => 'multipart/form-data', 'novalidate', 'id' => 'ReviewForm']) !!}--}}


                </div>
            </div>
        </section>
    @endif

    {{--Research proposal brief rejected/getback items--}}
    @if(!empty($rejectedItems->dashboardItems))
        <section id="pending-tasks">
            <div class="card">
                <div class="card-body">

                    <h2>@lang('rms::research_proposal.research_brief_get_back_items')</h2>
                    <table class="table table-bordered">
                        <thead>
                        <th>@lang('labels.message')</th>
                        <th>@lang('labels.details')</th>
                        <th>@lang('labels.action')</th>
                        </thead>
                        <tbody>
                        @foreach($rejectedItems->dashboardItems as $item)

                            <tr>
                                <td>{{$item->message}}</td>
                                <td>
                                    Research proposal title : {{ $item->dynamicValues['proposal_title'] }}<br/>
                                    Invitation Title: {{ $item->dynamicValues['research_title'] }}<br/>
                                    Remarks: {{ $item->dynamicValues['remarks'] }}

                                </td>

                                <td>
                                    <a href="{{url($item->checkUrl)}}"
                                       class="btn btn-primary btn-sm">@lang('labels.resubmit')</a>
                                    <a href="{{ route('workflow-close', [$item->workFlowMasterId, $item->dynamicValues['id']]) }}"
                                       class="btn btn-danger btn-sm">@lang('labels.closed')</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    @endif

    {{-------------Research detail pending items from workflow----------------}}
    @if(!empty($researchDetailPendingItems->dashboardItems))
        <section id="pending-tasks">
            <div class="card">
                <div class="card-body">
                    <h4>@lang('rms::research_details.research_detail_pending_item')</h4>

                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>@lang('labels.message')</th>
                            <th>@lang('labels.details')</th>
                            <th>@lang('labels.action')</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($researchDetailPendingItems->dashboardItems as $item)
                            {{--{{ dd($item) }}--}}
                            <tr>
                                {{--<td>{{ $item->dynamicValues['id'] }}</td>--}}
                                <td>{{$item->message}}</td>
                                <td>
                                    Invitation Title: {{ $item->dynamicValues['invitation_title'] }}<br/>
                                    Research Title : {{ $item->dynamicValues['title'] }}<br/>
                                    Initiator Name : {{ $item->dynamicValues['initiator_name'] }}

                                </td>
                                <td>
                                    <a href="{{url($item->checkUrl)}}"
                                       class="btn btn-primary btn-sm"> @lang('labels.details')</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--{!! Form::open(['route' =>  'research-proposal-submission.reviewUpdate',  'enctype' => 'multipart/form-data', 'novalidate', 'id' => 'ReviewForm']) !!}--}}


                </div>
            </div>
        </section>
    @endif

    {{---------------Research Detail Rejected/sendback items from workflow ------------------}}
    @if(!empty($researchDetailRejectedItems->dashboardItems))
        <section id="pending-tasks">
            <div class="card">
                <div class="card-body">

                    <h2>@lang('rms::research_details.research_detail_send_back_item')</h2>
                    <table class="table table-bordered">
                        <thead>
                        <th>@lang('labels.message')</th>
                        <th>@lang('labels.details')</th>
                        <th>@lang('labels.action')</th>
                        </thead>
                        <tbody>
                        @foreach($researchDetailRejectedItems->dashboardItems as $item)

                            <tr>
                                <td>{{$item->message}}</td>
                                <td>
                                    Research Detail title : {{ $item->dynamicValues['detail_title'] }}<br/>
                                    Research Invitation title : {{ $item->dynamicValues['remarks'] }}

                                </td>

                                <td>
                                    <a href="{{url($item->checkUrl)}}"
                                       class="btn btn-primary btn-sm">@lang('labels.resubmit')</a>
                                    <a href="{{ route('detail-workflow-close', [$item->workFlowMasterId, $item->dynamicValues['id']]) }}"
                                       class="btn btn-danger btn-sm">@lang('labels.closed')</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    @endif


    {{--research paper rejected workflow dashboard items--}}
    @if(!empty($researchRejectedItems->dashboardItems))
        <section id="pending-tasks">
            <div class="card">
                <div class="card-body">

                    <h2>@lang('rms::research.research_back_from_director_research')</h2>
                    <table class="table table-bordered">
                        <thead>
                        <th>@lang('labels.feature')</th>
                        <th>@lang('labels.message')</th>
                        <th>@lang('labels.details')</th>
                        <th>@lang('labels.action')</th>
                        </thead>
                        <tbody>
                        @foreach($researchRejectedItems->dashboardItems as $item)
                            <tr>
                                <td>{{$item->featureName}}</td>
                                <td>{{$item->message}}</td>
                                <td>
                                    Research Title: {{ $item->dynamicValues['research_title'] }}<br/>
                                    Publication info: {{  $item->dynamicValues['publication_description'] }}<br/>
                                    Submitted by : {{  $item->dynamicValues['submitted_by'] }}
                                </td>

                                <td>
                                    <a href="{{url($item->checkUrl)}}"
                                       class="btn btn-primary btn-sm">@lang('labels.resubmit')</a>
                                    <a href="{{ route('research-workflow-close-reviewer', [$item->workFlowMasterId, $item->dynamicValues['id']]) }}"
                                       class="btn btn-danger btn-sm">@lang('labels.closed')</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    @endif

    {{--research paper workflow dashboard items--}}
    @if(!empty($researchPendingTasks->dashboardItems))
        <section id="pending-tasks">
            <div class="card">
                <div class="card-body">
                    <h4>@lang('rms::research.research__paper_pending_items')</h4>
                    <table class="table table-bordered">
                        <thead>
                        <th>@lang('labels.message')</th>
                        <th>@lang('labels.details')</th>
                        <th>@lang('labels.action')</th>
                        </thead>
                        <tbody>
                        @foreach($researchPendingTasks->dashboardItems as $item)

                            <tr>
                                <td>{{ $item->message }}</td>

                                <td>
                                    Research Title: {{ $item->dynamicValues['research_title'] }}<br/>
                                    Publication info: {{  $item->dynamicValues['publication_description'] }}<br/>
                                    Submitted by : {{  $item->dynamicValues['submitted_by'] }}
                                </td>
                                <td><a href="{{url($item->checkUrl)}}"
                                       class="btn btn-primary btn-sm"> @lang('labels.details')</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    @endif


    @if(Auth::user()->hasAnyRole('ROLE_DIRECTOR_GENERAL') || Auth::user()->hasAnyRole('ROLE_RESEARCH_DIRECTOR'))
        <section>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('rms::research_proposal.research_proposal_status_graph')</h4>
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
                                <canvas id="myChart" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('task.task_list')</h4>
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
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">@lang('labels.serial')</th>
                                            <th scope="col">@lang('task.task')</th>
                                            <th scope="col">@lang('rms::research.title')</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        {{--@foreach($tasks as $task)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>@lang('rms::research.' .$task->name)</td>
                                                <td>{{ isset($task->researches->title) ? $task->researches->title : '' }}</td>
                                            </tr>
                                        @endforeach--}}

                                        @if(count($tasks))

                                            @foreach($tasks as $task)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>@lang('rms::research.' .$task->name)</td>
                                                    <td>{{ isset($task->researches->title) ? $task->researches->title : '' }}</td>
                                                </tr>
                                            @endforeach
                                        @else

                                            <tr>
                                                <td colspan="3" class="text-center">@lang('rms::research.No started task is found')</td>
                                            </tr>
                                        @endif

                                        {{--<tr>
                                            <th scope="row">1</th>
                                            <td>{{ __('rms::research.review_of_literature') }}</td>
                                            <td>River Bank Erosion and its Effects on Rural Society in Bangladesh</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>{{ __('rms::research.proposal_writing') }}</td>
                                            <td>Micro Credit Operation by the Public Sector in BD: Origin, Performance and Replication</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>{{ __('rms::research.questionnaire_preparation') }}</td>
                                            <td>Value Chain Analysis of Poultry and Pineapple: Selected Cases of Bangladesh</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4</th>
                                            <td>{{ __('rms::research.questionnaire_pretesting') }}</td>
                                            <td>River Bank Erosion and its Effects on Rural Society in Bangladesh</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5</th>
                                            <td>{{ __('rms::research.data_collection') }}</td>
                                            <td>Micro Credit Operation by the Public Sector in BD: Origin, Performance and Replication</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">6</th>
                                            <td>{{ __('rms::research.data_tabulation') }}</td>
                                            <td>Value Chain Analysis of Poultry and Pineapple: Selected Cases of Bangladesh</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">7</th>
                                            <td>{{ __('rms::research.report_writing') }}</td>
                                            <td>River Bank Erosion and its Effects on Rural Society in Bangladesh</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">8</th>
                                            <td>{{ __('rms::research.draft_report_submission') }}</td>
                                            <td>Value Chain Analysis of Poultry and Pineapple: Selected Cases of Bangladesh</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">9</th>
                                            <td>{{ __('rms::research.incorporating_research_division_comments') }}</td>
                                            <td>Micro Credit Operation by the Public Sector in BD: Origin, Performance and Replication</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">10</th>
                                            <td>{{ __('rms::research.first_final_report_submission') }}</td>
                                            <td>River Bank Erosion and its Effects on Rural Society in Bangladesh</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">11</th>
                                            <td>{{ __('rms::research.received_final_report') }}</td>
                                            <td>Micro Credit Operation by the Public Sector in BD: Origin, Performance and Replication</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">12</th>
                                            <td>{{ __('rms::research.sending_external_reviewer') }}</td>
                                            <td>Value Chain Analysis of Poultry and Pineapple: Selected Cases of Bangladesh</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">13</th>
                                            <td>{{ __('rms::research.comments_from_external_reviewer') }}</td>
                                            <td>River Bank Erosion and its Effects on Rural Society in Bangladesh</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">14</th>
                                            <td>{{ __('rms::research.send_to_respective_researcher') }}</td>
                                            <td>Value Chain Analysis of Poultry and Pineapple: Selected Cases of Bangladesh</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">15</th>
                                            <td>{{ __('rms::research.accepted_final_report') }}</td>
                                            <td>Micro Credit Operation by the Public Sector in BD: Origin, Performance and Replication</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">16</th>
                                            <td>{{ __('rms::research.send_for_publication') }}</td>
                                            <td>River Bank Erosion and its Effects on Rural Society in Bangladesh</td>
                                        </tr>--}}

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{--<section>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('rms::research_proposal.research_request_by_last_submission_date')</h4>
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
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('labels.title')</th>
                                        <th scope="col">@lang('rms::research_proposal.last_sub_date')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invitations as $invitation)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td><a href=""><a
                                                            href="{{ route('research-request.show', $invitation->id) }}">{{ $invitation->title }}</a></a>
                                            </td>
                                            <td>{{ $invitation->end_date }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('rms::research_proposal.research_proposal_by_submitted_date')</h4>
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
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('labels.title')</th>
                                        <th scope="col">@lang('rms::research_proposal.submission_date')</th>
                                        <th scope="col">@lang('rms::research_proposal.submitted_by')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($proposals as $proposal)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            --}}{{--@php--}}{{--
                                            --}}{{--$wfMasterId = $proposal->workflowMasters->first()->id;--}}{{--
                                            --}}{{--$wfConvId = $proposal->workflowMasters->first()->workflowConversations->first()->id;--}}{{--
                                            --}}{{--// $featureName = $proposal->workflowMasters[1]->feature->name;--}}{{--
                                            --}}{{--$featureName = 'Research Proposal';--}}{{--
                                            --}}{{--@endphp--}}{{--
                                            <td>
                                                <a href="#">{{ $proposal->title }}</a>
                                            </td>
                                            <td>{{ date('d/m/y h:i:a', strtotime($proposal->created_at)) }}</td>
                                            <td>{{ $proposal->submittedBy->name }}</td>
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
    </section>--}}
@stop

@push('page-css')
    <link type="text/css" href="{{ asset('theme/vendors/css/tables/datatable/dataTables.checkboxes.css') }}"
          rel="stylesheet"/>
@endpush
@push('page-js')

    <script type="text/javascript" src="{{ asset('theme/vendors/js/charts/chart.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/tables/datatable/dataTables.checkboxes.min.js') }}"></script>

    <script>

        // testing new one
        $(document).ready(function () {

            // bulk action for research brief
            var table = $('#bulkApprove').DataTable({
                'columnDefs': [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true
                        }
                    }
                ],
                'select': {
                    'style': 'multi',
                },
                'order': [[1, 'asc']],

            });

            // Handle form submission event
            $('#research_bulk_action_form').on('submit', function (e) {
                var form = this;
                var rows_selected = table.column(0).checkboxes.selected();
                $.each(rows_selected, function (index, rowId) {
                    $(form).append(
                        $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', 'items[]')
                            .val(rowId)
                    );
                });
            });
            $('#approvalReject').hide();
            $('#research_bulk_action_form').on('click', function (e) {
                if (table.rows('.selected').count() > 0) {
                    $("#approvalReject").show();
                } else {
                    $("#approvalReject").hide();
                }
            });

            // $("#researchBriefCard:checkbox").click(function (event) {
            $('div.researchBriefCard input[type="checkbox"]').click(function (event) {
                if ($(this).is(":checked")) {
                    $("#approvalReject").show();
                } else {
                    $("#approvalReject").hide();
                }

            });



// bulk action for research details
            var detailTable = $('#researchDetailBulk').DataTable({
                'columnDefs': [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true
                        }
                    }
                ],
                'select': {
                    'style': 'multi'
                },
                'order': [[1, 'asc']],

            });
            // Handle form submission event
            $('#research_detail_bulk_action_form').on('submit', function (e) {
                var DetailForm = this;
                var DetailRows_selected = detailTable.column(0).checkboxes.selected();
                $.each(DetailRows_selected, function (index, rowId) {
                    $(DetailForm).append(
                        $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', 'items[]')
                            .val(rowId)
                    );
                });
            });
            $('#DetailApprovalReject').hide();
            $('#research_detail_bulk_action_form').on('click', function (e) {
                if (detailTable.rows('.selected').count() > 0) {
                    $("#DetailApprovalReject").show();
                } else {
                    $("#DetailApprovalReject").hide();
                }
            });

            $('div.researchDetailCard input[type="checkbox"]').click(function (event) {
                if ($(this).is(":checked")) {
                    $("#DetailApprovalReject").show();
                } else {
                    $("#DetailApprovalReject").hide();
                }

            });
        });

        $('#DetailApprovalReject').on('click', function () {
            $('.test1').hide();
        })


        // end bulk action
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    "{{ trans('rms::research.Review of literature') }}",
                    "{{ trans('rms::research.Proposal writing') }}",
                    "{{ trans('rms::research.Questionnaire preparation') }}",
                    "{{ trans('rms::research.Questionnaire pretesting') }}",
                    "{{ trans('rms::research.Data collection') }}",
                    "{{ trans('rms::research.Data tabulation') }}",
                    "{{ trans('rms::research.Report writing') }}",
                    "{{ trans('rms::research.Draft report submission') }}",
                    "{{ trans('rms::research.Incorporating research division comments') }}",
                    "{{ trans('rms::research.First final report submission') }}",
                    "{{ trans('rms::research.Received final report') }}",
                    "{{ trans('rms::research.Sending external reviewer') }}",
                    "{{ trans('rms::research.Comments from external reviewer') }}",
                    "{{ trans('rms::research.Send to respective researcher') }}",
                    "{{ trans('rms::research.Accepted final report') }}",
                    "{{ trans('rms::research.Send for publication') }}"
                ],

                datasets: [{
                    label: '{{ trans("rms::research.planned") }}',
                    data: JSON.parse('{!! json_encode($chartData[0] ) !!}'),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {

                    label: '{{ trans("rms::research.achieved") }}',

                    data: JSON.parse('{!! json_encode($chartData[1] ) !!}'),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: true
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                        }
                    }],
                    xAxes: [{
                        beginAtZero: true,
                        ticks: {
                            autoSkip: false
                        }
                    }]
                }
            }
        });


    </script>

@endpush
