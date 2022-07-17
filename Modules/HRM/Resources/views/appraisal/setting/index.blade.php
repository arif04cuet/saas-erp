@php
    define('APPRAISAL_SETTING_LOCAL', 'hrm::appraisal_setting')
@endphp

@extends('hrm::layouts.master')
@section('title', trans(constant('APPRAISAL_SETTING_LOCAL') . '.appraisal_setting_list'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="repeat-form">@lang(constant('APPRAISAL_SETTING_LOCAL') . '.appraisal_setting_list')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li>
                                <a class="btn btn-sm btn-primary" href="{{ route('appraisals.settings.create') }}">
                                    <i class="ft ft-plus"></i> @lang(constant('APPRAISAL_SETTING_LOCAL') . '.appraisal_setting_create')
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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang(constant('APPRAISAL_SETTING_LOCAL') . '.reviewees')</th>
                                    <th>@lang(constant('APPRAISAL_SETTING_LOCAL') . '.reporter')</th>
                                    <th>@lang(constant('APPRAISAL_SETTING_LOCAL') . '.signer')</th>
                                    <th>@lang(constant('APPRAISAL_SETTING_LOCAL') . '.commenter')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appraisalSettings as $setting)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>
                                            <a href="{{ route('appraisals.settings.show', $setting->id) }}">
                                                {{ $setting->getRevieweeNames() }}
                                            </a>
                                        </td>
                                        <td>{{ optional($setting->reporter)->getName() }}</td>
                                        <td>{{ optional($setting->signer)->getName() }}</td>
                                        <td>{{ optional($setting->commenter)->getName() }}</td>
                                        <td class="text-center">
                                            <span class="dropdown">
                                                 <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                         aria-haspopup="true"
                                                         aria-expanded="false" class="btn btn-info dropdown-toggle"><i
                                                             class="la la-cog"></i></button>
                                                 <span aria-labelledby="btnSearchDrop2"
                                                       class="dropdown-menu mt-1 dropdown-menu-right">
                                                     <a href="{{ route('appraisals.settings.show', $setting->id) }}"
                                                        class="dropdown-item">
                                                         <i class="ft-eye"></i> @lang('labels.details')
                                                     </a>
                                                     <a href="{{ route('appraisals.settings.edit', $setting->id) }}"
                                                        class="dropdown-item">
                                                         <i class="ft-edit-2"></i> @lang('labels.edit')
                                                     </a>
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
@endsection
