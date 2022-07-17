@extends('rms::layouts.master')
@section('title', trans('rms::research_proposal.invited_research_proposal_list'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('rms::research_proposal.invited_research_proposal_list') }}</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="researchProposalRequestList">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('labels.title')</th>
                                        <th scope="col">@lang('labels.attachments')</th>
                                        <th scope="col">@lang('labels.status')</th>
                                        <th scope="col">@lang('rms::research_proposal.last_sub_date')</th>
                                        <th scope="col">@lang('labels.created_at')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($research_requests as $research_request)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <a href="{{ route('invited-research-proposal.show', $research_request->id) }}">{{ $research_request->title }}</a>
                                            </td>
                                            <td>
                                                <a href="{{url('rms/research-requests/attachment-download/'.$research_request->id)}}">@lang('labels.attachments')</a>
                                            </td>
                                            <td>
                                                @if(\Carbon\Carbon::parse($research_request->end_date)->lessThan(\Carbon\Carbon::now()))
                                                    @lang('labels.closed')
                                                @else
                                                    @lang('labels.open')
                                                @endif
                                            </td>
                                            <td>{{ date('d/m/Y,  h:mA', strtotime($research_request->end_date)) }}</td>
                                            <td>{{ date('d/m/Y,  h:mA', strtotime($research_request->created_at)) }}</td>
                                            <td>
                                                <span class="dropdown">
                                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{route('research-proposal-submission.create',$research_request->id)}}"
                                                           class="dropdown-item"><i class="ft-fast-forward"></i>@lang('rms::research_proposal.research_proposal_submission')</a>
                                                    </span>
                                                </span>
                                            </td>
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
    </section>
@endsection


