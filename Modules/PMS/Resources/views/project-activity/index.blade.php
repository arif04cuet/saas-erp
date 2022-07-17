<section id="role-list">
    <!-- activity list -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('pms::project-activity.activity.list') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{route('pms-activity.create', $project->id)}}" class="btn btn-primary btn-sm">
                            <i class="ft-plus white"></i> @lang('pms::project-activity.activity.create')
                        </a>

                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('tms::budget.sector.form.title_bangla')</th>
                                    <th>@lang('labels.title')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($project->projectActivities as $activity)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>
                                            <a href="{{route('pms-activity.show', [$project->id, $activity->id])}}">
                                                {{$activity->name}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$activity->title_english}}
                                        </td>
                                        <td>
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <span aria-labelledby="btnSearchDrop2"
                                                  class="dropdown-menu mt-1 dropdown-menu-right">
                                                <!-- Details -->
                                                    <a href="{{route('pms-activity.show', [$project->id, $activity->id])}}"
                                                       class="dropdown-item"><i class="ft-eye"></i>
                                                        {{trans('labels.details')}}
                                                    </a>
                                                <div class="dropdown-divider"></div>
                                                <!-- Edit -->
                                                 <a href="{{route('pms-activity.edit',[$project->id, $activity->id])}}"
                                                    class="dropdown-item"><i class="ft ft-edit"></i>
                                                        {{trans('labels.edit')}}
                                                    </a>
                                                <div class="dropdown-divider"></div>
                                                {!! Form::open([
                                                 'method'=>'DELETE',
                                                 'url' => route('tms-sectors.destroy', $activity->id),
                                                 'style' => 'display:inline'
                                                 ]) !!}
                                                {!! Form::button('<i class="la la-trash-o"></i> '.__('labels.delete'), array(
                                                'type' => 'submit',
                                                'class' => 'dropdown-item',
                                                'onclick'=> 'return confirm("'.__('labels.confirm_delete').'")',
                                                )) !!}
                                                {!! Form::close() !!}
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
    <!-- fiscal year list -->
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('pms::project_budget.title') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('tms::budget.sector.form.title_bangla')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projectFiscalYears as $projectFiscalYear)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>
                                            {{$projectFiscalYear->name ?? trans('labels.not_found')}}
                                        </td>
                                        <td>
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <span aria-labelledby="btnSearchDrop2"
                                                  class="dropdown-menu mt-1 dropdown-menu-right">
                                                <!-- Details -->
                                                    <a href="#"
                                                       class="dropdown-item"><i class="ft-eye"></i>
                                                        {{trans('labels.details')}}
                                                    </a>
                                                <div class="dropdown-divider"></div>
                                                <!-- Edit -->
                                                 <a href="#"
                                                    class="dropdown-item"><i class="ft ft-edit"></i>
                                                        {{trans('labels.edit')}}
                                                    </a>
                                                {!! Form::close() !!}
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
 --}}

</section>
