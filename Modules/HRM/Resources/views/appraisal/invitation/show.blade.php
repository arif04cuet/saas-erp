@extends('hrm::layouts.master')
@section('title', trans('hrm::appraisal.invitation.title'). ' ' .trans('labels.details'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="repeat-form">@lang('hrm::appraisal.title') @lang('hrm::appraisal.invitation.title')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li>
                                <a href="{{ route('appraisal.invitation.index') }}" class="btn btn-sm btn-info">
                                    <i class="ft ft-list"></i> @lang('hrm::appraisal.invitation.list')
                                </a>
                            </li>
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <table class="table">
                                    <tr>
                                        <th>@lang('hrm::appraisal.invitation.memorandum_no')</th>
                                        <td>{{ $appraisalInvitation->memorandum_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.title')</th>
                                        <td>{{ $appraisalInvitation->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.created_at')</th>
                                        <td>{{ \Carbon\Carbon::parse($appraisalInvitation->created_at)->format('j F, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('hrm::appraisal.reporting_officer_employee')</th>
                                        <td>{{ $appraisalInvitation->appraisalSetting->getRevieweeNames() }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('hrm::appraisal.reporter_officer')</th>
                                        <td>{{ $appraisalInvitation->appraisalSetting->reporter->getName() }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('hrm::appraisal.signer_officer')</th>
                                        <td>{{ $appraisalInvitation->appraisalSetting->signer->getName() }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('hrm::appraisal.final_commenter_officer')</th>
                                        <td>{{ $appraisalInvitation->appraisalSetting->commenter->getName() }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('hrm::appraisal.invitation.deadline_for_signer')</th>
                                        <td>{{ \Carbon\Carbon::parse($appraisalInvitation->deadline_to_signer)->format('j F, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('hrm::appraisal.invitation.deadline_for_final_commenter')</th>
                                        <td>{{ \Carbon\Carbon::parse($appraisalInvitation->deadline_to_final_commenter)->format('j F, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('hrm::appraisal.invitation.deadline_for_final_commenter_sign')</th>
                                        <td>{{ \Carbon\Carbon::parse($appraisalInvitation->deadline_final_commenter_sign)->format('j F, Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
