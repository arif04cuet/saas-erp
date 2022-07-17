<section>
    <div class="row">
        <div class="col-md-12">
            <label for="">@lang('attribute.attribute')</label>
            {{ Form::select('project_attribute_id', $project->projectAttributes->pluck('name', 'id'), null, ['class' => 'form-control']) }}
            @include('pms::project.attribute.graph')
        </div>
    </div>
</section>
{!! Form::open(['route' =>  ['filter.value.bydaterange',$project->id],'id' =>'value-filter-form','class' => 'form']) !!}
{{-- DateRanger Section --}}
<section>
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('period_from', trans('labels.start'), ['class' => 'form-label']) !!}
                {!! Form::text('period_from', \Carbon\Carbon::now()->format('d/m/Y'),
                        ['class' => 'form-control period_from']
                    )
                 !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('period_to', trans('labels.end'), ['class' => 'form-label']) !!}
                {!! Form::text('period_to', \Carbon\Carbon::now()->format('d/m/Y'),
                        ['class' => 'form-control period_to']
                    )
                 !!}
            </div>
        </div>


            <!--Select Employee-->
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('project_attribute_id',
                        trans('attribute.attribute'),
                        ['class' => 'form-label'])
                !!}
                {!!
                    Form::select('project_attribute_id',  $projectAttributes, null,
                    ['class'=>'form-control select2','placeholder'=>trans('labels.all')])
            !!}
            </div>
    </div>

       
    </div>

    


        
    
    <!-- button -->
    <div class="text-center">
        <!-- Search Button -->
        <a class="ft ft-search btn btn-success" id="search_in_project">
            @lang('accounts::payroll.payslip_report.form_elements.search')
        </a>
    </div>    
</section>
{!! Form::close() !!}


<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('attribute.attribute_tabular_view')
                    </h4>
                </div>
                {{-- Print Button --}}
                <div style="text-align: center">
                    <a class="btn btn-success" style="color: #fff;" onclick="printDiv('printable')">
                        @lang('labels.print')
                    </a>
                </div>    
                <div id="printable" class="card-content">
                    <div class="card-body">
                        <div class="table-resposive">
                            <div class="card-text">
                                <dl class="row">
                                    <dd style="font-weight: bold">{{ $project->title }}</dd>
                                </dl>
                            </div>  
                            <table class="table table-bordered table-striped project-attribute">
                                <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th id="column1">@lang('attribute.attribute')</th>
                                        <th id="column2">@lang('labels.unit')</th>
                                        <th id="column3">@lang('attribute.planned_value')</th>
                                        <th id="column4">@lang('attribute.achieved_value')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project->projectAttributes as $attribute)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $attribute->name }}</td>
                                            <td>{{ $attribute->unit }}</td>
                                            <td>{{ $attribute->planned->sum('planned_value') }}
                                            </td>
                                            <td>{{ $attribute->achieved->sum('achieved_value') }}
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
</section>