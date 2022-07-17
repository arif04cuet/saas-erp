@extends('publication::layouts.master')
@section('title', trans('publication::organization.index'))


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('publication::organization.index') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('publication-organizations.create') }}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('labels.add') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('labels.serial') }}</th>
                                            <th>{{ trans('publication::organization.name_en') }}</th>
                                            <th>{{ trans('publication::organization.name_bn') }}</th>
                                            <th>{{ trans('publication::organization.organization_head') }}</th>
                                            <th>{{ trans('publication::organization.activation') }}</th>
                                            <th>{{ trans('labels.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($organizations as $organization)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    {{ $organization->name_en }}
                                                </td>
                                                <td>
                                                    {{ $organization->name_bn }}
                                                </td>
                                                <td>
                                                    @if ($organization->employee)
                                                        {{ $organization->employee->getName() }}
                                                    @else
                                                        <p>{{ trans('publication::research-paper-free-request.not_found') }}
                                                        </p>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($organization->status == 'active')
                                                        <span class="badge badge-success">
                                                            {{ trans('publication::organization.active') }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">
                                                            {{ trans('publication::organization.inactive') }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('publication-organizations.edit', $organization->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="la la-pencil-square"></i>
                                                    </a>
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
