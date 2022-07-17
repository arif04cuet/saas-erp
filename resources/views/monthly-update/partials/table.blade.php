<div class="card">
    <div class="card-header">
        <h4 class="card-title">@lang('monthly-update.title')</h4>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a href="{{ route($module . '-monthly-updates.create', $monthlyUpdatable->id) }}"
                       class="btn btn-sm btn-primary"><i class="ft ft-plus"></i> @lang('monthly-update.create_button')</a>
                </li>
                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table class="monthly-update-table table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('labels.serial')</th>
                        <th>@lang('labels.date')</th>
                        <th>@lang('monthly-update.plannings')</th>
                        <th>@lang('monthly-update.achievement')</th>
                        <th>@lang('labels.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($monthlyUpdatable->monthlyUpdates->sortByDesc('date') as $monthlyUpdate)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($monthlyUpdate->date)->format('F Y') }}</td>
                            <td>{{ $monthlyUpdate->planning }}</td>
                            <td>{{ $monthlyUpdate->achievement }}</td>
                            <td class="text-center">
                                <span class="dropdown">
                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false" class="btn btn-info btn-sm dropdown-toggle"><i
                                                class="la la-cog"></i></button>
                                    <span aria-labelledby="btnSearchDrop2"
                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                      <a href="{{ route($module . '-monthly-updates.show', [$monthlyUpdatable->id, $monthlyUpdate->id])  }}"
                                         class="dropdown-item"><i
                                                  class="ft-eye"></i> {{trans('labels.details')}}</a>
                                      <a href="{{ route($module . '-monthly-updates.edit', [$monthlyUpdatable->id, $monthlyUpdate->id])  }}"
                                         class="dropdown-item"><i
                                                  class="ft-edit"></i> {{trans('labels.edit')}}</a>
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