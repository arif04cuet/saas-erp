@php
    define('APPRAISAL_SETTING_LOCAL', 'hrm::appraisal_setting')
@endphp

@extends('hrm::layouts.master')
@section('title', trans(constant('APPRAISAL_SETTING_LOCAL') . '.appraisal_setting_create'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="repeat-form">@lang(constant('APPRAISAL_SETTING_LOCAL') . '.appraisal_setting_create')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
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
                                {{ Form::open(['route' => 'appraisals.settings.store', 'method' => 'post']) }}
                                @include('hrm::appraisal.setting.partials.form')
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script>
        $(document).ready(function () {
            $('select').select2({
                placeholder: '{{ trans('labels.select') }}'
            });
        });
    </script>
@endpush