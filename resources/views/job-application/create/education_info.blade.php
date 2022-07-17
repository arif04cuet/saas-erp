<div class="education-repeater">

    <div data-repeater-list="education">

        @php
            $oldEducations = old();
        @endphp
        @if(isset($oldEducations['education']) && count($oldEducations['education'])>0)
            @foreach($oldEducations['education'] as $key => $education)
                <div data-repeater-item="">
                    <div class="row">
                        {{--<form class="form">--}}

                        <div class=" col-md-10">
                            <div class="row">

                                @if($errors->educationError->has('employee_id'))
                                    <div class="col-md-12">
                                        <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            {{$errors->educationError->first('employee_id')}}
                                        </div>
                                    </div>
                                @endif


                                <div class="col-md-6">
                                    <section class="basic-select2">
                                        <div class="form-group {{ $errors->educationError->has("education.".$key.".academic_institute_id") ? ' error' : '' }}">
                                            {{ Form::label('academic_institute_id', trans('hrm::education.institute_name'), ['class' => 'required']) }}
                                            <br/>
                                            {{ Form::select('academic_institute_id',$institutes,  $education['academic_institute_id'] , ['class' => 'select2 form-control instituteSelection',
                                            'placeholder' => trans('labels.select'),'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                            <div class="help-block"></div>
                                            @if ($errors->educationError->has("education.".$key.".academic_institute_id"))
                                                <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                            @endif

                                        </div>
                                    </section>
                                </div>

                                <div class="help-block"></div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->educationError->has("education.".$key.".academic_department_id") ? ' error' : '' }}">
                                        {{ Form::label('academic_department_id', trans('hrm::education.department_section_group'), ['class' => 'required']) }}
                                        {{ Form::select('academic_department_id',$academicDepartments,  $education['academic_department_id'], ['class' => 'form-control', 'placeholder' => trans('labels.select'),'data-validation-required-message'=> trans('labels.This field is required')]) }}
                                        <div class="help-block"></div>
                                        @if ($errors->educationError->has("education.".$key.".academic_department_id"))
                                            <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->educationError->has("education.".$key.".academic_degree_id") ? ' error' : '' }}">
                                        {{ Form::label('academic_degree_id', trans('hrm::education.degree_name'), ['class' => 'required']) }}
                                        {{ Form::select('academic_degree_id', $academicDegree, $education['academic_degree_id'],  ['class' => 'form-control', 'placeholder' => trans('labels.select'),'data-validation-required-message' => trans('labels.This field is required')]) }}
                                        <div class="help-block"></div>
                                        @if ($errors->educationError->has("education.".$key.".academic_degree_id"))
                                            <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->educationError->has("education.".$key.".passing_year") ? ' error' : '' }}">
                                        {{ Form::label('passing_year', trans('hrm::education.passing_year'), ['class' => 'required']) }}
                                        {{ Form::text('passing_year',  null,  ['id' => 'passing_year', 'class' => 'form-control', 'placeholder' => 'e.g: 2015',    'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                        <div class="help-block"></div>
                                        @if ($errors->educationError->has("education.".$key.".passing_year"))
                                            <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        {{ Form::label('medium', trans('hrm::education.medium')) }}
                                        {{ Form::select('medium', Config('constants.employee_education_medium'),
                                        $education['medium'], ['placeholder' =>trans('labels.select'), 'class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->educationError->has("education.".$key.".duration") ? ' error' : '' }}">
                                        {{ Form::label('duration', trans('hrm::education.duration'), ['class' => 'required']) }}
                                        {{ Form::select('duration',  $academicDurations, $education['duration'],
                                         ['class' => 'form-control', 'placeholder' =>trans('labels.select'), 'data-validation-required-message'=>trans('labels.This field is required')]) }}

                                        <div class="help-block"></div>
                                        @if ($errors->educationError->has("education.".$key.".duration"))
                                            <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->educationError->has("education.".$key.".result") ? ' error' : '' }}">
                                        {{ Form::label('result', trans('hrm::education.result'), ['class' => 'required']) }}
                                        {{ Form::text('result',  $education['result'], ['class' => 'form-control', 'placeholder' => 'CGPA / Grade / Division', 'data-validation-required-message'=>'Please enter result']) }}
                                        <div class="help-block"></div>
                                        @if ($errors->educationError->has("education.".$key.".result"))
                                            <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('achievement', trans('hrm::education.achievement')) }}
                                        {{ Form::text('achievement',  $education['achievement'], ['class' => 'form-control', 'placeholder' => 'eg. President Gold Madel']) }}
                                    </div>
                                </div>
                                {{ Form::hidden('id', isset($education['id']) ? $education['id'] : null   ) }}
                                {{ Form::hidden('employee_id', isset($education['employee_id']) ? $education['employee_id'] : null, ['class' =>'EmployeeId']) }}
                                <hr>
                            </div>
                        </div>

                        <div class=" col-md-2">
                            <div class="form-group col-sm-12 col-md-2 mt-2">
                                <button type="button" class="btn btn-danger" data-repeater-delete=""><i
                                            class="ft-x"></i>
                                    @lang('labels.remove')
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr style="border-bottom: 1px solid #1E9FF2">

                </div>
            @endforeach
        @else
            <div data-repeater-item="">
                <div class="row">
                    {{--<form class="form">--}}
                    <div class=" col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <section class="basic-select2">
                                    <div class="form-group">
                                        {{ Form::label('academic_institute_id', trans('hrm::education.institute_name'), ['class' => 'required']) }}
                                        <br/>
                                        {{ Form::select('academic_institute_id', $institutes, null,
                                        ['placeholder' =>trans('labels.select'), 'class' => 'select2 form-control instituteSelection',
                                         'data-validation-required-message'=> trans('labels.This field is required')]) }}

                                        <div class="help-block"></div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-6 addOtherInstitute">
                                <div class="form-group ">
                                    {{ Form::label('other_institute_name', trans('hrm::education.other_institute_name')) }}
                                    <br/>
                                    {{ Form::text('other_institute_name',  null,
                                    ['placeholder' =>trans('labels.select'),'id'=>'', 'class' => 'addInstituteInput form-control']) }}

                                    <div class="help-block"></div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('academic_department_id', trans('hrm::education.department_section_group'), ['class' => 'required']) }}
                                    {{ Form::select('academic_department_id',  $academicDepartments, null,
                                     ['placeholder' =>trans('labels.select'),'class' => 'select2 academicDepartmentSelect form-control',
                                     'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6 addDepartmentSection">
                                <div class="form-group ">
                                    {{ Form::label('other_department_name', trans('hrm::education.other_department')) }}
                                    <br/>
                                    {{ Form::text('other_department_name',  null,
                                    ['id'=>'', 'class' => 'addDepartmentInput form-control', 'placeholder' => 'Enter Your Institute Name']) }}

                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('academic_degree_id', trans('hrm::education.degree_name'), ['class' => 'required']) }}
                                    {{ Form::select('academic_degree_id', $academicDegree, null,
                                    ['placeholder' =>trans('labels.select'),'class' => 'select2 form-control academicDegreeSelect',
                                    'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-md-6 addDegreeSection">
                                <div class="form-group ">
                                    {{ Form::label('other_degree_name', trans('hrm::education.other_degree')) }}<br/>
                                    {{ Form::text('other_degree_name',  null,
                                    ['id'=>'', 'class' => 'addDegreeInput form-control', 'placeholder' => 'Enter Your degree Name']) }}

                                    <div class="help-block"></div>
                                </div>
                            </div>


                            <div class="col-md-6">


                                <fieldset class="form-group">
                                    {{ Form::label('passing_year', trans('hrm::education.passing_year'), ['class' => 'required']) }}
                                    <div class="input-group">

                                        {{ Form::text('passing_year',  null,  ['id' => 'passing_year', 'class' => 'form-control', 'placeholder' => 'e.g: 2015',    'data-validation-required-message'=>trans('labels.This field is required')]) }}

                                        <div class="help-block"></div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('medium',  trans('hrm::education.medium')) }}
                                    {{ Form::select('medium', Config('constants.employee_education_medium'),  null,
                                    ['placeholder' =>trans('labels.select'),'class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('duration',  trans('hrm::education.duration'), ['class' => 'required']) }}
                                    {{ Form::select('duration',  $academicDurations, null,
                                    ['placeholder' =>trans('labels.select'),'class' => 'form-control',
                                    'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('result',  trans('hrm::education.result'), ['class' => 'required']) }}
                                    {{ Form::text('result',  null,
                                    ['class' => 'form-control', 'placeholder' => 'CGPA / Grade / Division',
                                    'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('achievement',  trans('hrm::education.achievement')) }}
                                    {{ Form::text('achievement',  null, ['class' => 'form-control', 'placeholder' => 'eg. President Gold Madel']) }}
                                </div>
                            </div>
                            {{ Form::hidden('employee_id', isset($employee_id) ? $employee_id : null, ['class' =>'EmployeeId']) }}
                            <hr>
                        </div>
                    </div>
                    <div class=" col-md-2">
                        <div class="form-group col-sm-12 col-md-2 mt-2">
                            <button type="button" class="btn btn-danger" data-repeater-delete=""><i class="ft-x"></i>
                                @lang('labels.remove')
                            </button>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid #1E9FF2">
            </div>
        @endif
    </div>
    {{--form repeater end--}}
    <div class="col-md-12">
        <button type="button" data-repeater-create="" class="btn btn-primary addMore"><i
                    class="ft-plus"></i> @lang('labels.add_more')
        </button>
    </div>
    <div class="form-actions col-md-12 ">
        <div class="pull-right">
            {{ Form::button('<i class="la la-check-square-o"></i>'. trans('labels.save'), ['type' => 'submit', 'id' => 'SubmitButton', 'class' => 'btn btn-primary'] )  }}
            <a href="{{ url('/hrm/employee') }}">
                <button type="button" class="btn btn-warning mr-1"><i class="la la-times"></i> @lang('labels.cancel')
                </button>
            </a>
        </div>
    </div>
</div>

@push('page-js')
    <script>

        $(document).ready(function () {

            $(" .instituteSelection, .academicDepartmentSelect, .academicDegreeSelect").select2({width: '100%'});
            $(".addOtherInstitute").hide();
            $(".addDepartmentSection").hide();
            $(".addDegreeSection").hide();


            $('.instituteSelection').on('select2:select', function (e) {
                var value = $(".instituteSelection option:selected").val();
                if (value === 'other') {
                    $(".addOtherInstitute").show();
                    $(".addInstituteInput").focus();
                } else {
                    $(".addOtherInstitute").hide();

                }
            });
            $('.academicDepartmentSelect').on('select2:select', function (e) {
                var value = $(".academicDepartmentSelect option:selected").val();
                if (value === 'other_department') {
                    $(".addDepartmentSection").show();
                    $(".addDepartmentInput").focus();
                } else {
                    $(".addDepartmentSection").hide();

                }
            });
            $('.academicDegreeSelect').on('select2:select', function (e) {
                var value = $(".academicDegreeSelect option:selected").val();
                if (value === 'other_degree') {
                    $(".addDegreeSection").show();
                    $(".addDegreeInput").focus();
                } else {
                    $(".addDegreeSection").hide();

                }
            });
            $('.education-repeater').repeater({
                show: function () {
                    $(this).find('.select2-container').remove();
                    $(this).find('select').select2({
                        placeholder: selectPlaceholder
                    });

                    // remove error span
                    $('div:hidden[data-repeater-item]')
                        .find('input.is-invalid, select.is-invalid')
                        .each((index, element) => {
                            $(element).removeClass('is-invalid');
                        });

                    $(this).slideDown();
                }
            });
        })
    </script>
@endpush


