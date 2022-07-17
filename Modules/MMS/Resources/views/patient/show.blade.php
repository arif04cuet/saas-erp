@extends('mms::layouts.master')
@section('title', trans('mms::patient.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('mms::patient.patient_info')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements" style="top: 5px;">
                <ul class="list-inline mb-1">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <h4 class="form-section"><i class="la la-tag"></i> @lang('labels.details')</h4>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <table class="table">
                            <tr>
                                <th>@lang('labels.name')</th>
                                <td>{{ $patient->name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('mms::patient.age')</th>
                                <td>{{ $patient->age }}</td>
                            </tr>

                            <tr>
                                <th>@lang('mms::patient.mobile')</th>
                                <td>{{ $patient->mobile_no }}</td>
                            </tr>

                            <tr>
                                <th>@lang('mms::patient.gender')</th>
                                <td>{{ $patient->gender }}</td>
                            </tr>

                            <tr>
                                <th>@lang('mms::patient.type.title')</th>
                                <td>{{ $patient->type }}</td>
                            </tr>

                            <tr>
                                <th>@lang('mms::patient.id')</th>
                                <td>{{ $patient->patient_id }}</td>
                            </tr>

                            <tr>
                                <th>@lang('mms::patient.reg_date')</th>
                                <td>{{ date('d-m-Y', strtotime($patient->created_at)) }}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <a href="{{route('patients.index')}}" class="btn btn-danger">
                        <i class="la la-backward"></i> @lang('labels.back_page')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('page-js')
@endpush
