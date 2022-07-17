@extends('hrm::layouts.master')
@section('title', trans('labels.details'))


@section('content')
    {{--{{ dd($employee) }}--}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form"><i class="ft-eye"></i> @lang('labels.details')</h4>
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
                        <table class="master table">
                            <tbody>

                            <tr>
                                <th class="">@lang('labels.name')</th>
                                <td>{{$section->name}}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::department.section_code')</th>
                                <td>{{$section->section_code}}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::department.section_head')</th>
                                <td>{{@$sectionHead['first_name']. " ".@$sectionHead['last_name']}}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::department.department')</th>
                                <td>{{$section->department->name}}</td>
                            </tr>

                            </tbody>
                        </table>
                        {{--<a href="{{url('/hrm/employee/')}}"--}}
                        <a class="master btn btn-small btn-info" href="{{ route('sections.edit', $section->id) }}">@lang('labels.edit')</a>
                        <a class="master btn btn-small btn-danger" href="{{route('sections.index')}}">@lang('labels.back_page')</a>


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
