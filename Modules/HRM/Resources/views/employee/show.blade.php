@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.employee_details'))


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form"><i class="ft-tag black"></i> @lang('hrm::employee.employee_details')</h4>
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
                            <ul class="nav nav-tabs nav-underline nav-justified mb-1" id="tab-bottom-line-drag">
                                @include('hrm::employee.partial.tab')
            
                            </ul>
                            <div class="tab-content ">
                                {{--employee general information--}}
                                <div class="tab-pane active show" role="tabpanel" id="general" aria-labelledby="general-tab"
                                     aria-expanded="true">
                                    @include('hrm::employee.view.general_info_details')
                                </div>
            
                                {{--Employee Personal Info--}}
                                <div class="tab-pane " id="personal" role="tabpanel" aria-labelledby="personal-tab"
                                     aria-expanded="false">
                                    @if(!is_null($employee->employeePersonalInfo))
                                        @include('hrm::employee.view.personal_info_details')
                                    @else
                                        <h3 class="text-center">Personal info does not exist</h3>
                                        <a class="master btn btn-small btn-info"
                                           href="{{ route('employee.edit', $employee->id . '/edit#personal') }}">Add </a>
                                    @endif
            
                                </div>
            
                                {{--Employee Personal Info--}}
                                <div class="tab-pane " id="spouse-children" role="tabpanel" aria-labelledby="spouse-children-tab"
                                     aria-expanded="false">
                            @if(!$employeeSpouses->count() && !$employeeChildren->count())
                                        <h3 class="text-center">@lang('hrm::spouse_children_info.no_data')</h3>
                                        <a class="master btn btn-small btn-info"
                                           href="{{ route('employee.edit', $employee->id . '/edit#spouse-children') }}">@lang('labels.add') </a>
                                    @else
                                        @include('hrm::employee.view.spouse_children_info')
                                    @endif
            
                                </div>
            
                                {{--Employee Education info--}}
                                <div class="tab-pane" id="education" role="tabpanel" aria-labelledby="education-tab"
                                     aria-expanded="false">
                                    @if(count($employee->employeeEducationInfo)>0)
                                        @include('hrm::employee.view.education_info_details')
                                    @else
                                        <h3 class="text-center">@lang('hrm::employee.no_edu_info')</h3>
                                        <a class="master btn btn-small btn-info"
                                           href="{{ route('employee.edit', $employee->id . '/edit#education') }}">@lang('labels.add')</a>
                                    @endif
                                </div>
            
                                {{--Employee Training information--}}
                                <div class="tab-pane" id="training" role="tabpanel" aria-labelledby="training-tab"
                                     aria-expanded="false">
                                    @if(count($employee->employeeTrainingInfo)>0)
                                        @include('hrm::employee.view.training_info_details')
                                    @else
                                        <h3 class="text-center">@lang('hrm::employee.no_training_info')</h3>
                                        @can('hrm-user-access')
                                            <a class="master btn btn-small btn-info"
                                            href="{{ route('employee.edit', $employee->id . '/edit#training') }}">@lang('labels.add') </a>
                                        @endcan
                                    @endif
                                </div>
            
                                {{--Employee Publication --}}
                                <div class="tab-pane" id="publication" role="tabpanel" aria-labelledby="publication-tab"
                                     aria-expanded="false">
                                    @if(count($employee->employeePublicationInfo)>0)
                                        @include('hrm::employee.view.publication_details')
                                    @else
                                        <h3 class="text-center">Publication info does not exist</h3>
                                        <a class="master btn btn-small btn-info"
                                           href="{{ route('employee.edit', $employee->id . '/edit#publication') }}">Add </a>
            
                                    @endif
            
                                </div>
            
                                {{--Employee Research information--}}
                                <div class="tab-pane" id="research" role="tabpanel" aria-labelledby="research-tab"
                                     aria-expanded="false">
                                    @if(count($employee->employeeResearchInfo)>0)
                                        @include('hrm::employee.view.research_details')
                                    @else
                                        <h3 class="text-center">Research info does not exist</h3>
                                        <a class="btn btn-small btn-info"
                                           href="{{ url('/hrm/employee/' . $employee->id . '/edit#research') }}">Add </a>
            
                                    @endif
                                </div>
                                <div class="tab-pane" id="others" role="tabpanel" aria-labelledby="others-tab"
                                     aria-expanded="false">
                                    @if (count($employee->employeeInterestInfo) > 0)
                                        @include('hrm::employee.view.others_info_details')
                                    @else
                                        <h3 class="text-center">Info does not exist</h3>
                                        <a class="btn btn-small btn-info"
                                           href="{{ url('/hrm/employee/' . $employee->id . '/edit#others') }}">Add </a>
            
                                    @endif
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

@push('page-js')
    <script>
        $(document).ready(function () {
            var url = document.URL;
            var hash = url.substring(url.indexOf('#'));

            $(".nav-tabs").find("li a").each(function (key, val) {
                if (hash == $(val).attr('href')) {
                    $(val).click();
                }

                $(val).click(function (ky, vl) {
                    location.hash = $(this).attr('href');
                });
            });

        })
    </script>
@endpush
