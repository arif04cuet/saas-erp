<div class="card-header">
    {!! Form::open(['route' =>  'reports.sales-report', 
        'method' => 'GET',
        'id' =>'sales-form',
        'class' => 'form novalidate'
    ]) !!}
    <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::report.sales.title')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('payment_type',
                                trans('cafeteria::report.sales.payment_type'),
                            ['class' => 'form-label ']) !!}

                    {!! Form::select('payment_type', $paymentTypes, app('request')->input('payment_type') ?? null,
                        [ 'class'=>'form-control select2',
                          'placeholder' => trans('labels.all')
                            ])  !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('biller_type',
                                trans('cafeteria::report.sales.biller_type'),
                            ['class' => 'form-label ']) !!}

                    {!! Form::select('biller_type', $billerTypes, app('request')->input('biller_type') ?? null,
                        [ 'class'=>'form-control select2',
                          'placeholder' => trans('labels.all'),
                          'onchange' => 'changeVisibility(this.value)'
                        ])  !!}
                </div>
            </div>
            <div class="col-md-6 employee" style="display: none">
                <div class="form-group">
                    {!! Form::label('employee',
                                trans('cafeteria::report.sales.employee'),
                            ['class' => 'form-label ']) !!}

                    {!! Form::select('employee_id', $employees, app('request')->input('employee_id') ?? null,
                        [ 'class'=>'form-control select2',
                            'placeholder'=>trans('labels.all')])  !!}
                </div>
            </div>
            <div class="col-md-6 training" style="display: none">
                <div class="form-group">
                    {!! Form::label('training',
                                trans('cafeteria::report.sales.training'),
                            ['class' => 'form-label ']) !!}

                    {!! Form::select('training_id', $trainings, app('request')->input('training_id') ?? null,
                        [ 'class'=>'form-control select2',
                            'placeholder'=>trans('labels.all')])  !!}
                </div>
            </div>
            <div class="col-md-6 raw-material">
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
            <a class="ft ft-refresh-ccw btn btn-warning" href="{{ route('reports.sales-report-form')}}">
                @lang('cafeteria::venue-selection.refresh')
            </a>

            <a class="btn btn-success" style="color: #fff;" onclick='printDiv()'>
                @lang('labels.print')
            </a>
        </div>
        {!! Form::close() !!}
    </div>