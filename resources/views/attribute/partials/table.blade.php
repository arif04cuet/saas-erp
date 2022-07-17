<div class="card">
    <div class="card-header">
        <h4 class="card-title">@lang('attribute.attribute_list')</h4>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a href="{{ route($module . '-attributes.create', $organization->id) }}"
                       class="btn btn-sm btn-primary"><i
                                class="ft-plus"></i> @lang('attribute.create_attribute')</a>
                </li>
                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body card-body-min-height">
        <div class="table-responsive">
            <table class="attribute-table table table-striped table-bordered">
                <thead>
                <th>@lang('labels.serial')</th>
                <th>@lang('attribute.attribute')</th>
                <th>@lang('attribute.unit')</th>
                <th>@lang('labels.action')</th>
                </thead>
                <tbody>
                @foreach($organization->attributes as $attribute)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route($module . '-attributes.show', [$organization->id, $attribute->id]) }}">{{ $attribute->name }}</a>
                        </td>
                        <td>{{ $attribute->unit }}</td>
                        <td class="text-center">
                                            <span class="dropdown">
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info btn-sm dropdown-toggle"><i
                                                        class="la la-cog"></i></button>
                                              <span aria-labelledby="btnSearchDrop2"
                                                    class="dropdown-menu mt-1 dropdown-menu-right">
                                                  <a href="{{ route($module . '-attribute-values.create', $attribute->id) }}"
                                                     class="dropdown-item"><i
                                                              class="la la-keyboard-o"></i>@lang('attribute.enter_value')</a>
                                                <a href="{{ route($module . '-attributes.edit', [$organization->id, $attribute->id]) }}"
                                                   class="dropdown-item"><i
                                                            class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
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
