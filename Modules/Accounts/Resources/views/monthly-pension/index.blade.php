@extends('accounts::layouts.master')
@section('title',trans('accounts::pension.monthly.title'))
@section('content')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::pension.monthly.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('monthly-pensions.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('labels.new') @lang('accounts::pension.monthly.title')
                            </a>
                        </div>
                    </div>
                    {{--<div class="card-content collapse show">--}}
                    {{--{!! Form::open(['route' => 'monthly-pensions.index', 'method' => 'get']) !!}--}}
                    {{--<div class="card-body card-dashboard">--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-md-4">--}}
                    {{--<div class="form-group">--}}
                    {{--{!! Form::label('month', __('accounts::employee-contract.month')) !!}--}}
                    {{--{!! Form::text('month', '', ['class' => 'form-control'] ) !!}--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4">--}}
                    {{--<div class="form-group">--}}
                    {{--{!! Form::label('employees', __('accounts::employee-contract.employee_name')) !!}--}}
                    {{--{!! Form::select('employees[]', $employeeHavingContracts, null,--}}
                    {{--['class' => 'form-control select2', 'id' => 'employees', 'multiple'] ) !!}--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--</div>--}}
                    {{--{!! Form::close() !!}--}}
                    {{--</div>--}}
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th width="20%">@lang('labels.name')</th>
                                    <th>@lang('accounts::pension.contract.ppo_no')</th>
                                    <th>@lang('accounts::pension.contract.receiver')</th>
                                    <th>@lang('accounts::pension.monthly.bill_receivable')</th>
                                    <th width="18%">@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($monthlyPensions as $pension)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a href="{{route('monthly-pensions.show', $pension['pension_id'])}}">
                                                {{$pension['employee_name']}}
                                            </a>
                                        </td>
                                        <td>{{$pension['ppo_number']}}</td>
                                        <td>{{$pension['receiver']}}</td>
                                        <td>{{$pension['receivable_amount']}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{route('monthly-pensions.show',
                                            $pension['pension_id'])}}">
                                                <i class="la la-eye"></i>
                                            </a>
                                            <a href="{{route('monthly-pensions.bill', $pension['employee_id'])}}"
                                               class="btn btn-sm btn-info"
                                               title="{{__('accounts::pension.monthly.download_bill')}}">
                                                <i class="la la-download"></i>
                                            </a>
                                            {!! Form::open([
                                                     'method'=>'DELETE',
                                                     'url' => route('monthly-pensions.destroy', $pension['pension_id']),
                                                     'style' => 'display:inline'
                                                     ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => __('labels.delete'),
                                            'onclick'=> 'return confirm("'.__('labels.confirm_delete').'")',
                                            )) !!}
                                            {!! Form::close() !!}
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
    </section>
@endsection
@push('page-css')

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">

@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>

    <script>
        $('input[name=month]').pickadate({
            format: 'mmmm yyyy',
            selectYears: true,
            selectMonths: true,
        });
    </script>
@endpush
