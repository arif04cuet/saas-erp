@extends('hm::layouts.master')
@section('title', trans('hm::report.collection_register_report'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' =>  'collection-report.filter', 'id' =>'cash-book-entry-form','class' => 'form novalidate']) !!}
                            <h4 class="form-section"><i
                                    class="la la-tag"></i>@lang('hm::report.collection_register_report')</h4>

                            <!-- Employee and Structure -->
                            <div class="row">
                                <!-- Fiscal Year -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('period_month', trans('hm::report.date_from'), ['class' => 'form-label']) !!}
                                        {!! Form::text('period_from', isset($fromDate) ? $fromDate : null,
                                                ['class' => 'form-control required',
                                                        'data-validation-required-message'=>trans('validation.required',
                                                        ['attribute' => trans('labels.start')])
                                                ]
                                            )
                                         !!}
                                    </div>
                                </div>

                                <!-- Period To  -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('period_to', trans('hm::report.date_to'), ['class' => 'form-label']) !!}
                                        {!! Form::text('period_to', isset($toDate) ? $toDate: date('Y-m-t'),
                                                ['class' => 'form-control required',
                                                       'data-validation-required-message'=>trans('validation.required',
                                                        ['attribute' => trans('labels.start')])
                                                ]
                                            )
                                         !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 25px">
                                            <i class="la la-search"></i> @lang('hm::report.search')
                                        </button>

                                    </div>
                                </div>
                                @if(isset($reports) && count($reports)>0)
                                    <div class="col-md-2">
                                        <div class="text-center">
                                            <a style="margin-top: 25px" class="form-control btn btn-default"
                                               href="{{ route('collection-report.print-view', [$fromDate, $toDate]) }}"><i
                                                    class="la la-print"></i>
                                                @lang('hm::report.print_view')
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">
                            <section id="payslip-list">
                                <div class="row">
                                    <div class="col-xl-12 ">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">@lang('hm::report.collection_register_list')</h4>
                                                <a class="heading-elements-toggle"><i
                                                        class="la la-ellipsis-h font-medium-3"></i></a>

                                            </div>
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">
                                                    <table
                                                        class="table">
                                                        <tbody>
                                                        <tr>
                                                            <th>@lang('hm::report.total_bill')</th>
                                                            <td>
                                                                @enToBnNumber($reports['grand_bill'] ?? 0)
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th>
                                                                @lang('labels.total') @lang('hm::report.paid_amount')
                                                            </th>
                                                            <td>
                                                                @enToBnNumber($reports['grand_paid_amount'] ?? 0)
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th>@lang('labels.total') @lang('hm::report.due_amount')</th>
                                                            <td>
                                                                @enToBnNumber($reports['grand_due_amount'] ?? 0)
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                    <table
                                                        class="table table-striped table-bordered text-center alt-pagination">
                                                        <thead>
                                                        <tr>
                                                            <th>@lang('labels.serial')</th>
                                                            <th>@lang('hm::report.check_in_id')</th>
                                                            <th>@lang('hm::report.total_bill')</th>
                                                            <th>@lang('hm::report.paid_amount')</th>
                                                            <th>@lang('hm::report.due_amount')</th>
                                                            <th>@lang('hm::report.training')</th>
                                                        </tr>

                                                        </thead>
                                                        <tbody>
                                                        @if(isset($reports['data']))
                                                            @foreach($reports['data'] as $report)
                                                                <tr>
                                                                    <td scope="row">{{$loop->iteration}}</td>
                                                                    <td>
                                                                        <a href="{{ route('check-in.show', $report['id']) }}">{{ $report['shortcode'] }}</a>
                                                                    </td>
                                                                    <td width="10%">
                                                                        {{
                                                                            $report['total_bill']
                                                                        }}
                                                                    </td>
                                                                    <td>{{  $report['paid_amount'] }}</td>
                                                                    <td>{{  $report['due_amount'] }}</td>
                                                                    <td>{{  $report['training_title'] }}</td>

                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

@endpush

@push('page-js')

    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script type="text/javascript">

        let title = "";

        let year = new Date().getFullYear();
        let month = new Date().getMonth();

        let periodFrom = $('input[name=period_from]').pickadate({
            // min: new Date(year, month, 2),
            format: "yyyy-mm-dd",
        });

        let periodTo = $('input[name=period_to]').pickadate({
            // min: new Date(year, month, 1),
            format: "yyyy-mm-dd",
        });

    </script>

@endpush
