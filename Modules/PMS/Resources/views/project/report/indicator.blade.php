@extends('pms::layouts.master')
@section('title', trans('pms::report.indicator.title'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ trans('pms::report.indicator.title') }}
                    </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        {!! Form::open(['route' =>  ['project.report.indicator.load',$project],'class' => 'form indicator-report-form']) !!}
                        @include('pms::project.report.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($method == 'POST')
        <div class="row">
            <div class="col-12">
                <!-- Summary -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">
                            ({{\App\Utilities\MonthNameConverter::en2bn($fromDate->format('F'))}}
                            {{\App\Utilities\EnToBnNumberConverter::en2bn($fromDate->format('Y'),false)}})
                            -
                            ({{\App\Utilities\MonthNameConverter::en2bn($toDate->format('F'))}}
                            {{\App\Utilities\EnToBnNumberConverter::en2bn($toDate->format('Y'),false)}})
                            @lang('attribute.attribute_tabular_view')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>@lang('labels.serial')</th>
                                                <th>@lang('pms::member.member')</th>
                                                <th>@lang('attribute.planned_value')</th>
                                                <th>@lang('attribute.achieved_value')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($project->attributes as $attribute)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $attribute->name ?? trans('labels.not_found') }}</td>
                                                    <td>{{ $projectAttributeSummary[$attribute->id]['planned_value'] ?? 0}}</td>
                                                    <td>{{ $projectAttributeSummary[$attribute->id]['achieved_value'] ?? 0 }}</td>
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

                <!-- Member wise data -->
                <div class="card">
                    <div class="card-header">
                        ({{\App\Utilities\MonthNameConverter::en2bn($fromDate->format('F'))}}
                        {{\App\Utilities\EnToBnNumberConverter::en2bn($fromDate->format('Y'),false)}})
                        -
                        ({{\App\Utilities\MonthNameConverter::en2bn($toDate->format('F'))}}
                        {{\App\Utilities\EnToBnNumberConverter::en2bn($toDate->format('Y'),false)}})
                        @lang('pms::report.indicator.member_table_title')
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered text-center alt-pagination">
                                        <thead>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>@lang('attribute.attribute')</th>
                                            @foreach($project->attributes as $attribute)
                                                <th>{{ $attribute->name ?? trans('labels.not_found') }}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($members as $member)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $member->name ?? trans('labels.not_found')}}</td>
                                                @foreach($project->attributes as $attribute)
                                                    <td>{{ $membersMonthlyData[$member->id][$attribute->id]['achieved_value'] ?? 0  }}</td>
                                                @endforeach
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
        </div>
    @endif
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
    <!-- pickadate -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>

    <script type="text/javascript">
        validateForm('.indicator-report-form');
        $('.month').pickadate({
            max: new Date(),
            format: 'yyyy-mmmm-d',
            selectMonths: true,
            selectYears: true,
        });
    </script>

@endpush
