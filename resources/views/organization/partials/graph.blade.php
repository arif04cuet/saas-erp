<div class="card">
    <div class="card-header">
        <h4 class="card-title">@lang('attribute.graph')</h4>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show">
        <div class="card-body">
            <h4 class="form-section"><i class="ft-bar-chart-2"></i> @lang('attribute.attribute_chart_filters')</h4>
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="attribute_id">@lang('attribute.attribute')</label>

                            {{ Form::select('attribute_id', $organization->attributes->pluck('name', 'id'), null, ['class' => 'form-control select2']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="chart_type">@lang('attribute.chart_types')</label>

                            <div class="row">
                                <div class="col">
                                    <div class="skin skin-flat">
                                        {!! Form::radio('chart_type', 'line', 'line') !!}
                                        <label>@lang('attribute.line')</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="skin skin-flat">
                                        {!! Form::radio('chart_type', 'horizontalBar') !!}
                                        <label>@lang('attribute.bar')</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="skin skin-flat">
                                        {!! Form::radio('chart_type', 'bar') !!}
                                        <label>@lang('attribute.column')</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="skin skin-flat">
                                        {!! Form::radio('chart_type', 'polarArea') !!}
                                        <label>@lang('attribute.area')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body chartjs">
                <canvas id="chart" height="500"></canvas>
            </div>
        </div>
    </div>
</div>
