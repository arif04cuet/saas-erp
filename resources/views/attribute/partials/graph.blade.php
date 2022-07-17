<div class="card">
    <div class="card-header"><h4 class="card-title">@lang('attribute.graph')</h4></div>
    <div class="card-content">
        <div class="card-body">
            <h4 class="form-section"><i
                        class="ft-bar-chart-2"></i> @lang('attribute.attribute_chart_filters')</h4>
            <div class="form-body">
                <div class="row">
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
        </div>
        <div class="card-body chartjs">
            <canvas id="chart" height="500"></canvas>
        </div>
    </div>
</div>