@extends('accounts::layouts.master')
@section('title', trans('accounts::pension.nominee.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('accounts::pension.nominee.show') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>

                </div>
                <div class="card-body">
                    <div id="invoice-items-details" class="">
                        <h4 class="form-section"><i
                                class="la la-tag"></i>@lang('accounts::pension.nominee.employee_details')</h4>

                        <!-- Date  and  Journal Dropdown -->
                        <div class="row">
                            <!-- Employees -->
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::label('employee_id', trans('accounts::pension.lump_sum.form_elements.employee'),
                ['class' => 'form-label']) !!}
                                    {!! Form::label('employee_id', $nominee->employee->getName(), ['class' => 'form-control']) !!}
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Journal Items Details -->
                        <h4 class="form-section"><i
                                class="la la-tag"></i>@lang('accounts::pension.nominee.nominee_details')</h4>
                        <div class="row">
                            <div class="table-responsive col-sm-12">
                                <table class="table table-bordered text-center repeater-nominee-items">
                                    <thead>
                                    <tr>
                                        <th>@lang('accounts::pension.nominee.nominee_name')</th>
                                        <th>@lang('labels.name') (বাংলা)</th>
                                        <th>@lang('accounts::pension.nominee.birth_date')</th>
                                        <th>@lang('accounts::pension.nominee.relation')</th>
                                        <th>@lang('accounts::pension.nominee.age_limit')</th>
                                        <th>@lang('labels.remarks')</th>
                                    </tr>

                                    </thead>
                                    <tbody data-repeater-list="nominee_entries">
                                    @foreach($nominee->nominees as $eachNominee)
                                        <tr data-repeater-item>
                                            <!-- account dropdown -->
                                            <td width="25%">
                                                {!! Form::label('name', $eachNominee->name, ['class' => "form-control"])!!}
                                            </td>
                                            <td>
                                                {!! Form::label('bangla_name', $eachNominee->bangla_name, ['class' => 'form-control'])!!}
                                            </td>
                                            <td>
                                                {!! Form::label('birth_date',
                \Carbon\Carbon::parse($eachNominee->birthdate)->format('d F, Y'),['class' => 'form-control'])!!}
                                            </td>
                                            <td>
                                                {!! Form::label('relation', $eachNominee->relation,['class' => 'form-control'])!!}
                                            </td>
                                            <td>
                                                {!! Form::label('age_limit', $eachNominee->age_limit, ['class' => 'form-control'])!!}
                                            </td>
                                            <td>
                                                {!! Form::label('remark', $eachNominee->remark,['class' => 'form-control', 'rows' => 2])!!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/ Pension Nominee Details -->
                    </div>

                    <!-- Save & Cancel Button -->
                    <div class="form-actions text-center">
                        <a href="{{route('pension-nominees.edit', $nominee->id)}}" class="btn btn-success">
                            <i class="la la-check-square-o"></i>
                            @lang('labels.edit')
                        </a>
                        <a class="btn btn-warning mr-1" role="button" href="{{route('pension-nominees.index')}}">
                            <i class="ft-x"></i> @lang('labels.cancel')
                        </a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
