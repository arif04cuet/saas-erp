@extends('pms::layouts.master')
@section('title', trans('organization.organization') . ' ' . trans('member.member'))

@section('content')
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('member.member')</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-text">
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('pms::project.title')</dt>
                                    <dd class="col-sm-9"><a
                                                href="{{ route('project.show', $project->id) }}">{{ $project->title }}</a>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('organization.organization')</dt>
                                    <dd class="col-sm-9"><a
                                                href="{{ route('pms-organizations.show', [$project->id, $organization->id]) }}">{{ $organization->name }}</a>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.name')</dt>
                                    <dd class="col-sm-9">{{ $member->name }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.nid_number')</dt>
                                    <dd class="col-sm-9">{{ $member->nid }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.gender')</dt>
                                    <dd class="col-sm-9">@lang('labels.' . $member->gender)</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.mobile')</dt>
                                    <dd class="col-sm-9">{{ $member->mobile }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.address')</dt>
                                    <dd class="col-sm-9">{{ $member->address }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('attribute.attribute_value_list')</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.name')</th>
                                        <th>@lang('attribute.initial_balance')</th>
                                        <th>@lang('attribute.current_balance')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attributeValues as $attributeValue)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $attributeValue->name }}</td>
                                            <td>{{ $attributeValue->initial_value }}</td>
                                            <td>{{ number_format($attributeValue->total_achieved_value, 2) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('member-attributes.show', [
                                                    $project->id,
                                                    $organization->id,
                                                    $member->id,
                                                    $attributeValue->attribute_id
                                                ]) }}"
                                                   class="btn btn-sm btn-info"><i class="ft ft-eye"></i></a>
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