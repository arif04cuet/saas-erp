@extends('pms::layouts.master')
@section('title', trans('pms::project.project_training'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('member.member_list')</h4>

                        <div class="heading-elements">
                            <a href="{{ route('project.show', $project->id) }}" class="btn btn-primary btn-sm">
                                <i class="ft-link"></i> @lang('organization.organization_list')
                            </a>
                            <a href="{{ route('projectTraining-members.index', [$project->id, $training->id]) }}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> @lang('member.add_member')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.name')</th>
                                        <th>@lang('labels.gender')</th>
                                        <th>@lang('labels.mobile')</th>
                                        <th>@lang('labels.address')</th>
                                        <th>@lang('labels.nid_number')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($members as $member)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td><a href="{{ route('organization-members.show', [$project->id, $member->memberDetails->organization_id, $member->member_id]) }}">{{ $member->memberDetails->name }}</a></td>
                                            <td>{{ $member->memberDetails->gender }}</td>
                                            <td>{{ $member->memberDetails->mobile }}</td>
                                            <td>{{ $member->memberDetails->address }}</td>
                                            <td>{{ $member->memberDetails->nid }}</td>
                                            <td>
                                                <span class="dropdown">
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <a href="{{ route('organization-members.show', [$project->id, $member->memberDetails->organization_id, $member->member_id]) }}"
                                                       class="dropdown-item"><i class="ft-eye"></i>@lang('labels.details')</a>
                                                    <a href=""
                                                       class="dropdown-item"><i class="ft-folder"></i>@lang('pms::project_budget.title')</a>
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