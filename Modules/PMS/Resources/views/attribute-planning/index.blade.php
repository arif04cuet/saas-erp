@extends('pms::layouts.master')
@section('title', trans('pms::attribute_planning.planning_list'))

@section('content')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a
                                    href="{{ route('project.show', $project->id) }}">{{ $project->title }}</a>
                            - {{ $attribute->name }} - @lang('pms::attribute_planning.planning_list')</h4>
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
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped alt-pagination">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('pms::attribute_planning.month_year')</th>
                                        <th>@lang('pms::attribute_planning.total_planned_value')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($monthlyAttributePlannings as $monthlyAttributePlanning)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $monthlyAttributePlanning->monthYear }}</td>
                                            <td>{{ $monthlyAttributePlanning->total_planned_value }}</td>
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