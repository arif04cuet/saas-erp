<div class="table-responsive">
    <div class="pull-left">
        <h4 class="card-title">@lang('attribute.indicator_list')</h4>
    </div>
    <div class="pull-right">
        <a href="{{ route('project-attributes-achieved.create', $project->id) }}"
            class="btn btn-sm btn-primary"><i class="ft-plus"></i>
            @lang('pms::attribute_planning.enter_achieved')
        </a>
        <a href="{{ route('project-attributes-planned.create', $project->id) }}"
            class="btn btn-sm btn-primary"><i class="ft-plus"></i>
            @lang('pms::attribute_planning.enter_planning')
        </a>
        <a href="{{ route('project-attributes.create', $project->id) }}"
            class="btn btn-sm btn-primary"><i class="ft-plus"></i>
            @lang('attribute.create_attribute')
        </a>
    </div>
    <br><br>
    <table class="table table-bordered table-striped alt-pagination">
        <thead>
            <tr>
                <th>@lang('labels.serial')</th>
                <th>@lang('labels.serial')</th>
                <th>@lang('labels.unit')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($project->projectAttributes as $attribute)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attribute->name }}</td>
                    <td>{{ $attribute->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>