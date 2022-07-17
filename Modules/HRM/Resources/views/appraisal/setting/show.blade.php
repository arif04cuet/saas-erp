@php
    define('APPRAISAL_SETTING_LANG', 'hrm::appraisal_setting.')
@endphp

@extends('hrm::layouts.master')
@section('title', trans(constant('APPRAISAL_SETTING_LANG') . 'appraisal_setting'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="repeat-form">@lang(constant('APPRAISAL_SETTING_LANG') . 'appraisal_setting')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li>
                                <a href="{{ route('appraisals.settings.index') }}" class="btn btn-sm btn-info">
                                    <i class="ft ft-list"></i> @lang('hrm::appraisal_setting.appraisal_setting_list')
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
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <th>@lang(constant('APPRAISAL_SETTING_LANG') . 'reviewees')</th>
                                        <td>{{ $appraisalSetting->getRevieweeNames() }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang(constant('APPRAISAL_SETTING_LANG') . 'reporter')</th>
                                        <td>{{ $appraisalSetting->reporter->getName() }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang(constant('APPRAISAL_SETTING_LANG') . 'signer')</th>
                                        <td>{{ $appraisalSetting->signer->getName() }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang(constant('APPRAISAL_SETTING_LANG') . 'commenter')</th>
                                        <td>{{ $appraisalSetting->commenter->getName() }}</td>
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