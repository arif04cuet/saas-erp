@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.add_employee'))

@section("content")
    @php

        /* $tab_action = isset($employee_id) ? '' : 'disabled';
         $employee_id = isset($employee_id) ? $employee_id : ''; */
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="repeat-form">@lang('hrm::employee.add_employee')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show" style="">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-underline nav-justified" id="tab-bottom-line-drag">
                                @include('hrm::employee.partial.tab')
                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div class="tab-pane active show" role="tabpanel" id="general" aria-labelledby="general-tab"
                                     aria-expanded="true">
                                    {!! Form::open(['url' => route('employee.store.general-info'), 'class'=>'form form-horizontal hrm-employee-create-form-general', 'novalidate', 'files'=> true]) !!}
                                    @include('hrm::employee.create.general_info')
                                    {!! Form::close() !!}
                                </div>
                                <div class="tab-pane " id="personal" role="tabpanel" aria-labelledby="personal-tab"
                                     aria-expanded="false">
                                    {!! Form::open(['url' => route('employee.store.personal-info'), 'class'=>'form form-horizontal hrm-employee-create-form-personal', 'novalidate', 'id' => 'form-personal']) !!}
                                    @include('hrm::employee.create.personal_info')
                                    {!! Form::close() !!}
                                </div>
        
                                <div class="tab-pane " id="spouse-children" role="tabpanel" aria-labelledby="spouse-children-tab"
                                     aria-expanded="false">
                                    {!! Form::open(['url' => route('employee.store.spouse-children-info'), 'class'=>'form form-horizontal hrm-employee-create-form-spouse-children', 'novalidate', 'id' => 'form-spouse-children']) !!}
                                    @include('hrm::employee.create.spouse_children_info')
                                    {!! Form::close() !!}
                                </div>
        
                                <div class="tab-pane" id="education" role="tabpanel" aria-labelledby="education-tab"
                                     aria-expanded="false">
                                    {!! Form::open(['url' => route('store.employee.education-info'), 'class'=>'form form-horizontal hrm-employee-create-form-education', 'novalidate']) !!}
                                    @include('hrm::employee.create.education_info')
                                    {!! Form::close() !!}
                                </div>
        
        
                                <div class="tab-pane" id="training" role="tabpanel" aria-labelledby="training-tab"
                                     aria-expanded="false">
                                     @can('hrm-user-access')
                                        {!! Form::open(['url' => route('store.employee.training-info'), 'class'=>'form form-horizontal hrm-employee-create-form-training', 'novalidate']) !!}
                                        @include('hrm::employee.create.training_info')
                                     {!! Form::close() !!}
                                     @else
                                        <h3 class="text-center">@lang('hrm::employee.no_permission_for_training')</h3>
                                    @endcan
                                </div>
        
                                <div class="tab-pane" id="others" role="tabpanel" aria-labelledby="others-tab"
                                        aria-expanded="false">
                                    {!! Form::open(['url' => route('store.employee.interest-info'), 'class'=>'form form-horizontal hrm-employee-create-form-others', 'novalidate']) !!}
                                    @include('hrm::employee.create.others_info')
                                    {!! Form::close() !!}
                                </div>
        
        
                                {{--<div class="tab-pane" id="publication" role="tabpanel" aria-labelledby="publication-tab"
                                     aria-expanded="false">
        
                                    {!! Form::open(['url' => 'hrm/employee/publica  tion-info', 'class'=>'form form-horizontal hrm-employee-create-form', 'novalidate']) !!}
                                    @include('hrm::employee.create.publication_info')
                                    {!! Form::close() !!}
                                </div>
        
        
                                <div class="tab-pane" id="research" role="tabpanel" aria-labelledby="research-tab"
                                     aria-expanded="false">
                                    {!! Form::open(['url' => 'hrm/employee/research-info', 'class'=>'form form-horizontal hrm-employee-create-form']) !!}
                                    @include('hrm::employee.create.research_info')
                                    {!! Form::close() !!}
                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/photo-upload.css') }}">

@endpush
@push('page-js')
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
   <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script>

        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

        let selectPlaceholder = '{!! trans('labels.select') !!}';
        var employee_id = "<?php echo $employee_id ?>";
        $(document).ready(function () {
            $('.DatePicker').pickadate();

            $('.addMore').click(function () {

                $('.EmployeeId').val(employee_id);

                $('#date_of_birth, #job_joining_date, #current_position_joining_date, #current_position_expire_date, #training_year, #published_date').pickadate();
            });

            //        url active based on hash tag url
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

        });
    </script>
@endpush
