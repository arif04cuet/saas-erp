@extends('hrm::layouts.master')
@section('title', trans('hrm::house-circular.list'))

@section('content')
    <section id="role-list">
        <div class="col-xl-11 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('hrm::house-circular.list')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    @can('hrm-user-access')
                        <div class="heading-elements">
                            <a href="{{ route('house-circulars.create') }}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> @lang('labels.add')
                            </a>
                        </div>
                    @endcan
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered alt-pagination">
                                <thead>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('hrm::house-circular.reference_no')</th>
                                    <th>@lang('hrm::house-circular.apply_from')</th>
                                    <th>@lang('hrm::house-circular.apply_to')</th>
                                    <th>@lang('labels.status')</th>
                                    <th>@lang('labels.action')</th>
                                </thead>
                                <tbody>
                                    @foreach ($circulars as $circular)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $circular->reference_no }}</td>
                                            <td>{{ $circular->apply_from }}</td>
                                            <td>{{ $circular->apply_to }}</td>
                                            <td><span class="badge badge-primary">{{ $circular->status }}</span></td>
                                            <td> 
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                        class="dropdown-menu mt-1 dropdown-menu-right">
                                                    @can('hrm-user-access')
                                                        @if ($circular->status != 'completed')
                                                            <a href="{{ route('house-circulars.edit', $circular->id) }}"
                                                                class="dropdown-item"><i class="ft-edit"></i> {{trans('labels.edit')}}</a>
                                                            <div class="dropdown-divider"></div>
                                                        @endif
                                                    @endcan
                                                    @if($circular->status == "active")
                                                        <a href="{{ route('house-applications.create', $circular->id) }}"
                                                            class="dropdown-item"><i class="ft-check-square"></i> {{trans('labels.apply')}}</a>
                                                        <div class="dropdown-divider"></div>
                                                        @can('hrm-user-access')
                                                            <a href="{{ route('house-applications.index', $circular->id) }}"
                                                                class="dropdown-item"><i class="ft-grid"></i> {{trans('hrm::house-circular.application.list')}}</a>
                                                            <div class="dropdown-divider"></div>
                                                        @endcan
                                                    @endif
                                                    <a href="{{ route('house-circulars.show', $circular->id) }}"
                                                        class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.show')}}</a>
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
    </section>

@endsection
