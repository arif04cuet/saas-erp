@extends('pms::layouts.master')
@section('title', trans('labels.PMS'))
@push('page-css')
    <link type="text/css" href="{{ asset('theme/vendors/css/tables/datatable/dataTables.checkboxes.css') }}" rel="stylesheet"/>
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h1>{{trans('labels.PMS')}}</h1>
            </div>
        </div>
        <form method="post" action="{{route('project-proposal-submitted.review-bulk')}}"  id="frm-example">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if(!is_null($shareConversations))
                            <div class="card-body">
                                <h5>{{__('labels.pending_items')}}</h5>
                                <table @if($bulkAction)id="example" @endif class="table table-bordered">
                                    <thead>
                                    @if($bulkAction)<th></th>@endif
                                    <th>@lang('labels.feature')</th>
                                    <th>@lang('labels.message')</th>
                                    <th>@lang('labels.details')</th>
                                    <th>@lang('labels.action')</th>
                                    </thead>
                                    <tbody>
                                    @foreach($shareConversations as $shareConversation)
                                        <tr>
                                            @if($bulkAction)<td>{{$shareConversation['id'].'-'.$shareConversation['ref_table_id'].'-'.$shareConversation['feature_id']}}</td>@endif
                                            <td>{{ $shareConversation['feature_name'] }}</td>
                                            <td>{{$shareConversation['message']}}</td>
                                            <td>Proposal Title: {{$shareConversation['proposal_title']}}<br>
                                                Project Title: {{$shareConversation['project_title']}}<br>
                                                Submitted By: {{$shareConversation['project_submitted_by']}}
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ url($shareConversation['review_url']) }}">
                                                    @lang('labels.details')
                                                </a>
                                                {{--<a href="{{ route('research-workflow-close-reviewer', [$item->workFlowMasterId, $item->dynamicValues['id']]) }}"--}}
                                                {{--class="btn btn-danger btn-sm">@lang('labels.closed')</a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($bulkAction)
                                <div class="form" id="approval-item">
                                    <div class="card-footer">
                                        <div class="form-group">
                                            <button  type="submit" name="status" value="APPROVED" class="btn btn-success">@lang('pms::project.approve_selected')</button>
                                            <button type="submit" name="status" value="REJECTED" class="btn btn-danger">@lang('pms::project.reject_selected')</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                        @foreach($pendingTasks as $pendingTask)
                            @if(!empty($pendingTask->dashboardItems))
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>{{trans('pms::project_proposal.'.$pendingTask->dashboardItems[0]->featureName)." ".trans('labels.pending_items')}}</h5>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                            <th>{{__('labels.message')}}</th>
                                            <th>{{__('labels.details')}}</th>
                                            {{--<th>{{__('labels.select')}} <input id="select_all" type="checkbox" name="select_all"></th>--}}
                                            <th>{{__('labels.check')}}</th>
                                            </thead>
                                            <tbody>
                                            @foreach($pendingTask->dashboardItems as $item)
                                                <tr>
                                                    <td>{{$item->message}}</td>
                                                    <td>
                                                        <span class="label">Proposal Title</span>: {{$item->dynamicValues['project_title']}}
                                                        <br>
                                                        <span class="label">Project Title</span>: {{$item->dynamicValues['project_request_title']}}
                                                        <br>
                                                        <span class="label">Submitted By</span>: {{$item->dynamicValues['requested_by']}}
                                                    </td>
                                                    {{--<td><input type="checkbox" class="wf-item-checkbox" name="pending_select[]"></td>--}}
                                                    <td>
                                                        <a href="{{ url($item->checkUrl )}}"
                                                           class="btn btn-primary btn-sm">@lang('labels.details')</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        @foreach($rejectedTasks as $rejectedTask)
                            @if(!empty($rejectedTask->dashboardItems))
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>{{trans('pms::project_proposal.'.$rejectedTask->dashboardItems[0]->featureName).' '.__('labels.rejected_items')}}</h5>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                            <th>{{__('labels.feature_name')}}</th>
                                            <th>{{__('labels.message')}}</th>
                                            <th>{{__('labels.details')}}</th>
                                            <th>{{__('labels.action')}}</th>
                                            </thead>
                                            <tbody>
                                            @foreach($rejectedTask->dashboardItems as $item)
                                                <tr>
                                                    <td>{{$item->featureName}}</td>
                                                    <td>{{$item->message}}</td>
                                                    <td>
                                                        <span class="label">Proposal Title</span>: {{$item->dynamicValues['project_title']}}
                                                        <br>
                                                        <span class="label">Project Title</span>: {{$item->dynamicValues['project_request_title']}}
                                                        <br>
                                                        <span class="label">Submitted By</span>: {{$item->dynamicValues['requested_by']}}
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                           href="{{url($item->checkUrl)}}">{{__('labels.resubmit')}}</a>
                                                        <a class="btn btn-danger btn-sm"
                                                           href="{{url($item->closeUrl)}}"
                                                           title="Close the item forever">{{__('labels.closed')}}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </form>
    </div>

    {{--<section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('pms::project_proposal.project_proposal_status_graph')</h4>
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
                        <div class="card-body" >
                            <canvas id="myChart" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    {{--<section>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('pms::project_proposal.project_request_by_last_submission_date')</h4>
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
                                        <th scope="col">@lang('pms::project_proposal.last_sub_date')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invitations as $invitation)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <a href="{{route('project-request.show', $invitation->id)}}">{{ $invitation->title }}</a>
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
                        <h4 class="card-title">@lang('pms::project_proposal.menu_title')</h4>
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
                                        <th scope="col">@lang('pms::project_proposal.submission_date')</th>
                                        <th scope="col">@lang('pms::project_proposal.submitted_by')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($proposals as $proposal)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>

                                            <td>
                                                <a href="{{ route('project-proposal-submitted.view', [$proposal->id]) }}">{{ $proposal->title }}</a>
                                            </td>
                                            <td>{{ date('d/m/y hi:a', strtotime($proposal->created_at)) }}</td>
                                            <td>{{ $proposal->ProposalSubmittedBy->name }}</td>
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

@push('page-js')
    <script type="text/javascript" src="{{ asset('theme/vendors/js/charts/chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/vendors/js/tables/datatable/dataTables.checkboxes.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $("#approval-item").hide();
            $("#remark").hide();
            $("#message").hide();
            var table = $('#example').DataTable({
                'paging': false,
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
            $('#frm-example').on('click', function (e) {
                if (table.rows('.selected').count() > 0) {


                    $("#approval-item").show();
                    $("#remark").show();
                    $("#message").show();

                } else {
                    $("#approval-item").hide();
                    $("#remark").hide();
                    $("#message").hide();
                }
            });

            $(":checkbox").click(function (event) {
                if ($(this).is(":checked")) {
                    $("#approval-item").show();
                    $("#remark").show();
                    $("#message").show();
                } else {
                    $("#approval-item").hide();
                    $("#remark").hide();
                    $("#message").hide();
                }

            });
            // Handle form submission event
            $('#frm-example').on('submit', function (e) {
                var form = this;
                var rows_selected = table.column(0).checkboxes.selected();
                $.each(rows_selected, function (index, rowId) {
                    $(form).append(
                        $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', 'id[]')
                            .val(rowId)
                    );
                });
                $('#example-console-rows').text(rows_selected.join(","));
                $('#example-console-form').text($(form).serialize());
                // $('input[name="id\[\]"]', form).remove();
                // e.preventDefault();



            });

        });

        $("#select_all").change(function ()
        {
            if(this.checked) $(".wf-item-checkbox").attr('checked' ,true); else $(".wf-item-checkbox").attr('checked',false);
        });

        $(".wf-item-checkbox").change(function () {
                console.log($('.wf-item-checkbox:checked').length);
            }
        );

        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["{{ __('pms::project_proposal.pending') }}", "{{ __('pms::project_proposal.in_progress') }}", "{{ __('pms::project_proposal.reviewed') }}"],
                datasets: [{
                    label: 'Pending',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                        }
                    }]
                }
            }
        });
    </script>
@endpush
