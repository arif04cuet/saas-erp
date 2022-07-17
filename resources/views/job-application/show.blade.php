@extends('hrm::layouts.master')
@section('title', trans('labels.details'))


@section('content')
    {{--{{ dd($employee) }}--}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form">@lang('labels.details')</h4>
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
                                <th class="">@lang('hrm::photocopy_management.list_table_title')</th>
                                <td>{{$request['title']}}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::photocopy_management.type')</th>
                                <td>{{$request['type']}}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::photocopy_management.priority')</th>
                                <td>{{$request['priority']}}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::photocopy_management.no_of_pages')</th>
                                <td>{{$request['pages']}}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::photocopy_management.requester')</th>
                                <td>{{$request['user']}}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('labels.remarks')</th>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        {{--<a href="{{url('/hrm/employee/')}}"--}}
                        <a class="btn btn-small btn-info" href="{{ route('photocopy-management.list') }}">@lang('labels.back_page') </a>
                        {{--<a class="btn btn-small btn-info" href="{{ route('photocopy-management.list') }}">@lang('labels.edit') </a>--}}

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
