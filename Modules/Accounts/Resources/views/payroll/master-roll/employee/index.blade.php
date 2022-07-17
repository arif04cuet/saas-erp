@extends('accounts::layouts.master')
@section('title',trans('accounts::payroll.master_roll.contract'))
@section('content')
    <section id="payslip-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::payroll.master_roll.contract')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>

                    </div>
                    {!! Form::open(['route' =>  'master-roll.employee.store', 'class' => 'form', 'novalidate', 'id'=>'master-roll-contract-form']) !!}
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="master-roll-contract-table"
                                   class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('accounts::payroll.payslip.create_form_elements.employee')</th>
                                    <th>@lang('accounts::payroll.master_roll.form_elements.designation')</th>
                                    <th>@lang('accounts::payroll.master_roll.form_elements.payment_per_day')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <a href="{{ route('employee.show', $employee->id) }}">{{ $employee->getName() }}</a>
                                        </td>
                                        <td>{{ $employee->employee_id  ?? trans('labels.not_found')}}</td>
                                        {!! Form::hidden('employee_id[]',$employee->employee_id) !!}
                                        <td width="10%">
                                            {!! Form::number('payment_per_day[]',
                                                $employee->masterRoll->payment_per_day ?? 0,
                                                    ['class'=>'form-control',
                                                    'min'=>0 ,
                                                    'required',
                                                    ])
                                                !!}</td>
{{--                                        'oninput'=>"validity.valid||(value='0');"--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Save / Cancel -->
                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-success" id="search">
                                    <i class="la la-check-square-o"></i>
                                    @lang('labels.save')
                                </button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-js')
    <script type="text/javascript">
        let table = $('#master-roll-contract-table').dataTable();
        $('#master-roll-contract-form').submit(function (eventObj) {
                if (confirm("Are you sure ?")) {
                    table.api().rows().nodes().page.len(-1).draw(false);
                    return true;
                } else {
                    return false;
                }
            }
        );
    </script>
@endpush

