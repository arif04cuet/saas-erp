@extends('pms::layouts.master')
@section('title', trans('pms::project_proposal.menu_title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @lang('organization.organization')
                    </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline ">
                            <li>

                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <dl class="row">
                            <dt class="col-sm-3">@lang('pms::project.title')</dt>
                            <dd class="col-sm-9"><a
                                    href="{{ route('project.show', $project->id) }}">{{ $project->title }}</a></dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">@lang('pms::project_proposal.organization_name')</dt>
                            <dd class="col-sm-9">{{ $organization->name }}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">@lang('labels.email_address')</dt>
                            <dd class="col-sm-9">{{ $organization->email }}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">@lang('labels.mobile')</dt>
                            <dd class="col-sm-9">{{ $organization->mobile }}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">@lang('labels.address')</dt>
                            <dd class="col-sm-9">{{ $organization->address }}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">@lang('division.division')</dt>
                            <dd class="col-sm-9">{{ $organization->division->getName() ?? trans('labels.not_found') }}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">@lang('district.district')</dt>
                            <dd class="col-sm-9">{{ $organization->district->getName() ?? trans('labels.not_found') }}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">@lang('thana.thana')</dt>
                            <dd class="col-sm-9">{{ $organization->thana->getName() ?? trans('labels.not_found') }}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">@lang('union.union')</dt>
                            <dd class="col-sm-9">{{ $organization->union->getName() ?? trans('labels.not_found') }}</dd>
                        </dl>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('pms-organizations.edit',[$project,$organization])}}"
                       class="btn btn-sm btn-primary">
                        <i class="ft-edit">{{trans('labels.edit')}}</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('attribute.attribute_list')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="attribute-table table table-striped table-bordered">
                            <thead>
                            <th>@lang('labels.serial')</th>
                            <th>@lang('attribute.attribute')</th>
                            <th>@lang('attribute.achieved_value')</th>
                            </thead>
                            <tbody>
                            <!-- Default indicator/attribute of project in relation to organisation -->
                            @foreach($project->attributes->take(3) as $attribute)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $attribute->name }}</td>
                                    <td>{{ $organization->attributeValues->where('attribute_id', $attribute->id)->sum('achieved_value') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('pms::organization-member.partials.table')
        </div>
    </div>
@endsection

@push('page-css')
    <style>
        .card-body-min-height {
            min-height: 465px;
            height: auto;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
@endpush
