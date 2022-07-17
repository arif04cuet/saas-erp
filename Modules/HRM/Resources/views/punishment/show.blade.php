@extends('hrm::layouts.master')
@section('title', trans('labels.details'))


@section('content')
    {{--{{ dd($employee) }}--}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form">@lang('hrm::employee.show_punishment')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                </ul>
            </div>
        </div>
        <div class="card-content collapse show" style="">
            <div class="card-body">

                <div class="tab-content ">
                    <div class="tab-pane active show" role="tabpanel" id="general" aria-labelledby="general-tab"
                         aria-expanded="true">
                        <table class="table ">
                            <tbody>

                            <tr>
                                <th class="">@lang('hrm::employee_general_info.employee_name')</th>
                                <td>Test Name</td>
                            </tr>
                            <tr>

                                <th class="">@lang('hrm::employee.employee_punishment_type')</th>
                                <td>Suspended</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::employee.punishment_start')</th>
                                <td>2019-01-12</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::employee.punishment_end')</th>
                                <td>2019-02-20</td>
                            </tr>

                            </tbody>
                        </table>
                        <a class="btn btn-small btn-danger" href="{{route('employee-punishment.list')}}">@lang('labels.back_page') </a>
                     {{--   <a class="btn btn-small btn-info" href="{{ url('/hrm/designation/' . $designation->id . '/edit') }}">@lang('labels.edit') </a>--}}

                    </div>


                </div>
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">


            </div>
        </div>
    </div>

@endsection
