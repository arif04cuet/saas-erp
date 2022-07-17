@extends('pms::layouts.master')
@section('title', trans('attribute.attribute'))

@section('content')
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('attribute.attribute') @lang('labels.details')
                            - {{ $attribute->name }}</h4>
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
                                    <dt class="col-sm-3">@lang('member.member')</dt>
                                    <dd class="col-sm-9"><a
                                                href="{{ route('organization-members.show', [$project->id, $organization->id, $member->id]) }}">{{ $member->name }}</a>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.name')</dt>
                                    <dd class="col-sm-9">{{ $attribute->name }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('attribute.initial_balance')</dt>
                                    <dd class="col-sm-9">{{ number_format($attributeValue->initial_value, 2) }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('attribute.current_balance')</dt>
                                    <dd class="col-sm-9">{{ number_format($attributeValue->current_balance, 2) }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('member-attribute-values.create', [
                                    $project->id,
                                    $organization->id,
                                    $member->id,
                                ]) }}" class="btn btn-outline-primary"><i
                                        class="la la-money"></i>
                                @if($attributeType == 'share')
                                    @lang('attribute.share_exchange')
                                @else
                                    @lang('attribute.make_transaction')
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection