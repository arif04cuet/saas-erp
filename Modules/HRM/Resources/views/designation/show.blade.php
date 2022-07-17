@extends('hrm::layouts.master')
@section('title', trans('labels.details'))


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
                                            <td>{{ $designation->name}}</td>
                                        </tr>
                                        <tr>
                                            <th class="">@lang('labels.name') (বাংলা)</th>
                                            <td>{{ $designation->bangla_name}}</td>
                                        </tr>
                                        <tr>
                                            <th class="">@lang('labels.short_name')</th>
                                            <td>{{ $designation->short_name}}</td>
                                        </tr>
                                        <tr>
                                            <th class="">@lang('hrm::designation.hierarchy_level')</th>
                                            <td>{{ $designation->hierarchy_level}}</td>
                                        </tr>
            
                                        </tbody>
                                    </table>
                                    {{--<a href="{{url('/hrm/employee/')}}"--}}
                                    <a class="master btn btn-small btn-info" href="{{ route('designation.index') }}">@lang('labels.back_page') </a>
                                    <a class="master btn btn-small btn-info" href="{{ route('designation.edit' , $designation->id) }}">@lang('labels.edit') </a>
            
                                </div>
            
            
                            </div>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
            
            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
