@include('../../../organization.table', [
                                    'organizable' => $project,
                                    'url' => route('pms-organizations.create', $project->id),
                                    'organizationShowRoute' => function ($organizableId, $organizationId) {
                                    return route('pms-organizations.show', [$organizableId, $organizationId]);
                                    }
                                    ])
                                    <hr>
                                    <div class="table-responsive">
                                        <div class="pull-left">
                                            <h4 class="card-title">@lang('attribute.indicator_list')</h4>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('attribute-plannings.create', $project->id) }}"
                                                class="btn btn-sm btn-primary"><i class="ft-plus"></i>
                                                @lang('pms::attribute_planning.enter_planning')
                                            </a>
                                            <a href="{{ route('attributes.create', $project->id) }}"
                                                class="btn btn-sm btn-primary"><i class="ft-plus"></i>
                                                @lang('attribute.create_attribute')</a>
                                        </div>
                                        <br><br>
                                        <table class="table table-bordered table-striped alt-pagination">
                                            <thead>
                                                <tr>
                                                    <th>@lang('labels.serial')</th>
                                                    <th>@lang('attribute.attribute')</th>
                                                    <th>@lang('attribute.current_balance')</th>
                                                    <th>@lang('labels.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($project->attributes as $attribute)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $attribute->name }}</td>
                                                        <td>{{ $attribute->values->sum('achieved_value') }}</td>
                                                        <td class="text-center">
                                                            <span class="dropdown">
                                                                <button id="btnSearchDrop2" type="button"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                    class="btn btn-info btn-sm dropdown-toggle"><i
                                                                        class="la la-cog"></i></button>
                                                                <span aria-labelledby="btnSearchDrop2"
                                                                    class="dropdown-menu mt-1 dropdown-menu-right">
                                                                    <a href="{{ route('attribute-plannings.index', [$project->id, $attribute->id]) }}"
                                                                        class="dropdown-item"><i
                                                                            class="la la-list"></i>@lang('pms::attribute_planning.planning')</a>
                                                                    <!-- Details -->
                                                                    <a href="{{ route('attributes.show', [$project->id, $attribute->id]) }}"
                                                                        class="dropdown-item"><i
                                                                            class="la la-eye"></i>@lang('labels.details')</a>
                                                                    <!-- Edit -->
                                                                    <a href="{{ route('attributes.edit', [$project, $attribute]) }}"
                                                                        class="dropdown-item"><i
                                                                            class="ft-edit-2"></i>
                                                                        {{ trans('labels.edit') }}
                                                                    </a>
                                                                    <!-- delete -->
                                                                    {!! Form::open(['url' => route('attributes.destroy', [$project, $attribute]), 'method' => 'DELETE', 'class' => 'form', ' novalidate']) !!}
                                                                    {!! Form::button('<i class="ft-trash"></i> ' . trans('labels.delete'), [
    'type' => 'submit',
    'class' => 'dropdown-item',
    'title' => trans('labels.remove'),
    'onclick' => 'return confirm("' . __('labels.confirm_delete') . '")',
]) !!}
                                                                    {!! Form::close() !!}

                                                                </span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>