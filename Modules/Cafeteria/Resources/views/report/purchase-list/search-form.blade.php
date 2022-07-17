<div class="card-header">
    {!! Form::open(['route' =>  'reports.purchase-list-report', 
        'method' => 'GET',
        'id' =>'purchase-report-form',
        'class' => 'form novalidate'
    ]) !!}
    <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::report.purchase_list.title')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('report_type',
                                trans('cafeteria::report.type.title'),
                            ['class' => 'form-label ']) !!}

                    {!! Form::select('report_type', $reportTypes, app('request')->input('report_type') ?? null,
                        [ 'class'=>'form-control select2',
                            ])  !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('raw_material_id',
                                trans('cafeteria::raw-material.title'),
                            ['class' => 'form-label ']) !!}

                    {!! Form::select('raw_material_id', $rawMaterials, app('request')->input('raw_material_id') ?? null,
                        [ 'class'=>'form-control select2',
                            'placeholder'=>trans('labels.all')])  !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Start Date',
                            trans('cafeteria::report.start_date'),
                            ['class' => 'form-label ']) !!}

                    {!! Form::date('start_date', app('request')->input('start_date') ?? date('Y-m-d'),
                            [ 'class'=>'form-control start-date',
                            'placeholder'=>trans('labels.all')])  !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('End Date',
                            trans('cafeteria::report.end_date'),
                            ['class' => 'form-label ']) !!}

                    {!! Form::text('end_date', app('request')->input('end_date') ?? date('Y-m-d'),
                            [ 'class'=>'form-control end-date',
                            'placeholder'=>trans('labels.all')])  !!}
                </div>
            </div>
        </div>
        <!-- Save -->
        <div class="text-center mb-3">
            <button type="submit" class="btn btn-success">
                <i class="ft-check-square"></i>
                @lang('labels.search')
            </button>
            <a class="ft ft-refresh-ccw btn btn-warning" href="{{ route('reports.purchase-list-report')}}">
                @lang('cafeteria::venue-selection.refresh')
            </a>
            <a class="btn btn-success" style="color: #fff;" onclick='printDiv()'>
                @lang('labels.print')
            </a>
        </div>
        {!! Form::close() !!}
    </div>