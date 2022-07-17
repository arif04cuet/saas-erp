<?php
/**
 * Created by PhpStorm.
 * User: bs130
 * Date: 9/5/19
 * Time: 12:09 PM
 */
?>
@extends('accounts::layouts.master')
@section('title', trans('accounts::payroll.payslip.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('accounts::payroll.payslip.title') @lang('accounts::payroll.payslip.title')</h4>
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
                        <center>

                            <h3 class="form-section center">@lang('labels.bard_title')</h3>
                        </center>

                        <div class="card-body">
                            <form class="">
                                <h4 class="form-section"><i
                                        class="la la-tag"></i>@lang('accounts::payroll.payslip.title')
                                </h4>
                            </form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('code', trans('accounts::payroll.code_no'), ['class' => 'form-label']) !!}
                                        <span class="danger">*</span>
                                        {!! Form::label('code', $payslip['reference'], ['class' => 'form-control']) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('reference'))
                                            <span class="invalid-feedback">{{ $errors->first('reference') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('e_tin', trans('accounts::payroll.e_tin'), ['class' => 'form-label']) !!}
                                        <span class="danger">*</span>
                                        {!! Form::label('employee_id', 84525895635, ['class'=>'form-control']) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('employee_id', trans('accounts::employee-contract.employee_name'), ['class' => 'form-label']) !!}
                                        <span class="danger">*</span>
                                        {!! Form::label('employee_id', $payslip['employee_name'], ['class'=>'form-control']) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('designation', trans('labels.designation'), ['class' => 'form-label']) !!}
                                        {!! Form::label('salary_structure', 'উপ পরিচালক', ['class'=>'form-control']) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('salary_category'))
                                            <span
                                                class="invalid-feedback">{{ $errors->first('salary_category') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table repeater-category-request table-bordered"
                                                   id="salary-rules-table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('accounts::payroll.payslip.title')</th>
                                                    <th>@lang('accounts::payroll.payslip.title')</th>
                                                    <th>@lang('accounts::payroll.payslip.title')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>{{$i=1}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td></td>
                                                    <td><strong>@lang('accounts::payroll.payslip.title')</strong></td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td><strong>@lang('accounts::payroll.payslip.title')</strong>
                                                    </td>
                                                    <td></td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::salary-rule.vehicle_advanced')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{rand(4000, 4999)}}</td>
                                                    <td>@lang('accounts::payroll.payslip.title')</td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <strong>@lang('accounts::payroll.payslip.title')</strong>
                                                    </td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <strong>@lang('accounts::payroll.payslip.title')</strong>
                                                    </td>
                                                    <td>34345</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <strong>@lang('accounts::payroll.payslip.title')</strong>
                                                    </td>
                                                    <td>34345</td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="form-actions text-center">
                                <a class="btn btn-warning mr-1" role="button" href="{{url(route('payslips.index'))}}">
                                    <i class="ft-skip-back"></i> @lang('labels.back_page')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

@endpush
