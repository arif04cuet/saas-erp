<div class="card">
    <div class="card-header">
        <h4 class="card-title" id="basic-layout-form">
            {{\App\Utilities\MonthNameConverter::en2bn(\Carbon\Carbon::now()->format('F'))}}
            {{\App\Utilities\EnToBnNumberConverter::en2bn(\Carbon\Carbon::now()->format('Y'),false)}},
            @lang('attribute.attribute_tabular_view')
        </h4>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a href="{{route('project.report.indicator.show',$project)}}"
                       class="btn btn-sm btn-primary"><i
                            class="ft ft-eye"></i> @lang('labels.report')</a>
                </li>
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>@lang('labels.serial')</th>
                                <th>@lang('attribute.attribute')</th>
                                <th>@lang('attribute.planned_value')</th>
                                <th>@lang('attribute.achieved_value')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($project->attributes as $attribute)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $attribute->name ?? trans('labels.not_found') }}</td>
                                    <td>{{ $projectAttributeSummary[$attribute->id]['planned_value'] ?? 0}}</td>
                                    <td>{{ $projectAttributeSummary[$attribute->id]['achieved_value'] ?? 0 }}</td>
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
