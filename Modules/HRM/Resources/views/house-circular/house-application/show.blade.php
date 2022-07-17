@extends('hrm::layouts.master')
@section('title', trans('hrm::house-circular.application.details'))

@section('content')
    <section id="role-list">
        <div class="col-xl-11 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('hrm::house-circular.application.details')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="col-md-8">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>@lang('labels.name')</th>
                                    <td>{{ $applicant->name }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.designation')</th>
                                    <td>{{ $applicant->designation }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.category')</th>
                                    <td>{{ $applicant->department }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::house-circular.application.salary_grade')</th>
                                    <td>{{ $applicant->salary_grade }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::house-circular.application.salary_scale')</th>
                                    <td>{{ $applicant->salary_scale }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::house-circular.application.salary')</th>
                                    <td>{{ $applicant->salary }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::house-circular.application.birth_date')</th>
                                    <td>{{ $applicant->birth_date }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::house-circular.application.current_position_date')</th>
                                    <td>{{ $applicant->current_position_date }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::house-circular.application.present_address_only')</th>
                                    <td>{{ $applicant->present_address }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::house-circular.application.house_no')</th>
                                    <td>
                                        @foreach($applicant->houseDetails as $houseDetail)
                                            {{ optional($houseDetail->houseDetail)->house_id ?? trans('labels.not_found') }}
                                            ,
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::house-circular.application.dp_head_recommand')</th>
                                    <td>{{ $applicant->dp_head_recommand }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-actions text-center">
                            <a class="btn btn-warning" href="{{route('house-applications.print',$applicant)}}">
                                <i class="la la-print"></i> {{trans('labels.print')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
