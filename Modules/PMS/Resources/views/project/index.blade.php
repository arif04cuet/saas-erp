@extends('pms::layouts.master')
@section('title', trans('pms::project_proposal.project_list'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('pms::project_proposal.project_list') }}</h4>

                        <div class="heading-elements">
                            <a href="{{ route('project.create') }}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> {{ trans('pms::project_proposal.new_project_create') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                        <tr>
                                            <th scope="col">@lang('labels.serial')</th>
                                            <th scope="col">@lang('labels.title')</th>
                                            <th scope="col">@lang('pms::project_proposal.project_budget')</th>
                                            <th scope="col">@lang('pms::project_proposal.fund_source')</th>
                                            <th scope="col">{{ trans('pms::project.project_director_id') }}</th>
                                            <th scope="col">{{ trans('pms::project.project_sub_director_id') }}</th>
                                            <th scope="col">@lang('pms::project_proposal.project_duration')</th>
                                            <th scope="col">{{ trans('labels.status') }}</th>
                                            <th scope="col">{{ trans('labels.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($projects as $project)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    <a
                                                        href="{{ route('project.show', $project->id) }}">{{ $project->title }}</a>
                                                </td>
                                                <td>

                                                    @if (isset($project->budget))
                                                        {{ $project->budget }}
                                                    @else
                                                        <p class="text-danger">Not Added</p>
                                                    @endif

                                                </td>
                                                <td>{{ $project->fund_source ?? trans('labels.not_found') }}</td>
                                                <td>{{ is_null($project->projectAssignedRole) ? trans('labels.not_found') : optional($project->projectAssignedRole)->projectDirector->getName() }}
                                                </td>
                                                <td>
                                                    {{ is_null($project->projectAssignedRole) ? trans('labels.not_found') : optional($project->projectAssignedRole)->projectSubDirector->getName() }}
                                                </td>
                                                <td>
                                                    {{ $project->duration ?? 0 }}
                                                    ({{ \Carbon\Carbon::parse($project->created_at)->format('Y') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($project->created_at)->addYear($project->duration)->format('Y') }}
                                                    )
                                                </td>
                                                <td>@lang('pms::project_proposal.in_progress')</td>
                                                <td>
                                                    <span class="dropdown">
                                                        <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            class="btn btn-info dropdown-toggle">
                                                            <i class="la la-cog"></i>
                                                        </button>
                                                        <span aria-labelledby="btnSearchDrop2"
                                                            class="dropdown-menu mt-1 dropdown-menu-right">
                                                            <div class="dropdown-divider"></div>
                                                            <a href="{{ route('project.show', $project->id) }}"
                                                                class="dropdown-item"><i
                                                                    class="ft-eye"></i>@lang('labels.details')</a>

                                                            <div class="dropdown-divider"></div>
                                                            <a href="{{ route('project.edit', $project) }}"
                                                                class="dropdown-item"><i class="ft-edit-2"></i>
                                                                @lang('labels.edit')</a>

                                                            <a href="{{ route('project-budget.index', $project->id) }}"
                                                                class="dropdown-item"><i
                                                                    class="ft-folder"></i>@lang('pms::project_budget.title')
                                                                @lang('labels.details')</a>
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
