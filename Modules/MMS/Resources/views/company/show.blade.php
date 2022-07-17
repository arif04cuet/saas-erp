@extends('mms::layouts.master')
@section('title', trans('mms::company.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('mms::company.company_info')</h4>
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
                                <th>@lang('mms::company.company_name')</th>
                                <td>{{ $company->name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('mms::company.address')</th>
                                <td>{{ $company->address }}</td>
                            </tr>

                            <tr>
                                <th>@lang('mms::company.contact_person_name')</th>
                                <td>{{ $company->contact_person_name }}</td>
                            </tr>

                            <tr>
                                <th>@lang('mms::company.mobile')</th>
                                <td>{{ $company->contact_person_mobile }}</td>
                            </tr>

                            <tr>
                                <th>@lang('mms::patient.reg_date')</th>
                                <td>{{ date('d-m-Y', strtotime($company->created_at)) }}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <a href="{{route('company.index')}}" class="btn btn-danger">
                        <i class="la la-backward"></i> @lang('labels.back_page')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('page-js')
@endpush
