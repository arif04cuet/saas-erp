<div class="card-body">
    @if ($page == "create")
        {!! Form::open(['route' => 'patients.store', 'class' => 'form patient-form']) !!}
    @else
        {!! Form::open(['route' => ['patients.update', $patient->id], 'class' => 'form patient-form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('mms::patient.title') @lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 15px;">
                <div>
                    {!! Form::label('type', trans('mms::patient.type.title'), ['class' => 'form-label required']) !!}
                </div>

                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('type', 'employee',
                    $page == "edit" ? $patient->type == "employee" ? true : false : true,
                    ['class' => 'required']) !!}
                    <label>@lang('mms::patient.type.employee')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('type', 'student',
                    $page == "edit" ? $patient->type == "student" ? true : false : false,
                    ['class' => 'required',]) !!}
                    <label>@lang('mms::patient.type.student')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('type', 'trainee',
                    $page == "edit" ? $patient->type == "trainee" ? true : false : false,
                    ['class' => 'required',]) !!}
                    <label>@lang('mms::patient.type.trainee')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('type', 'relative',
                    $page == "edit" ? $patient->type == "relative" ? true : false : false,
                    ['class' => 'required',]) !!}
                    <label>@lang('mms::patient.type.relative')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('type', 'others',
                    $page == "edit" ? $patient->type == "others" ? true : false : false,
                    ['class' => 'required',]) !!}
                    <label>@lang('mms::patient.type.others')</label>
                </div>
            </div>
            <div class="col-md-12 d-flex p-0" id="traineeInfo">
                <div class="col-md-6 training-list traineeInfo">
                    <div class="form-group">
                        <label
                            class="form-label required">@lang('mms::patient.training') {{trans('labels.name')}}</label>
                        {!! Form::select('training_id', $trainings, $page == "edit" ? $trainings ? null : null : null,
                                                ['class' => 'form-control  training_id',
                                                'data-msg-required'=> __('labels.This field is required'),
                                                'placeholder'=> __('labels.select'),
                                                'onChange' => 'getTraineeList()' ]) !!}
                    </div>
                </div>
                <div class="col-md-6 trainee-list traineeInfo">
                    <div class="form-group">
                        <label class="form-label required">@lang('mms::patient.trainee')</label>

                        <select name="trainee_id" id="trainee_id" class="form-control employee-select"
                                onchange="getTraineeInfo()"
                                data-msg-required="{{ __('labels.This field is required')}}">
                            @foreach($trainees as $trainee)
                                <option disabled="disabled" style="background-color: #CCC solid; "><b>{{$trainee}}</b>
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="col-md-6 employee_name" style="padding-left: 0px;">
                    <div class="form-group">
                        <label
                            class="form-label required">@lang('mms::patient.type.employee') {{trans('labels.name')}}</label>

                        <select name="employee_id" placeholder="{{__('labels.select')}}"
                                class="form-control dropdown-employee-name required employee-select"
                                onchange="getEmployeeInfo()"
                                data-msg-required="{{ __('labels.This field is required')}}">
                            @foreach($employees as $depertment)
                                <option disabled="disabled" style="background-color: #CCC solid; ">
                                    <b>{{$depertment['name']}}</b></option>
                                @foreach($depertment['data'] as $key=>$depertment)
                                    <option value="{{$key}}" @if($page=='edit' && $patient->type !=='trainee')
                                    @if($employee->id==$key) selected @endif @endif>{{$depertment}}</option>
                                @endforeach
                            @endforeach
                        </select>


                        {{-- {!! Form::select('employee_id', $employees, $page == "edit" ? $employee ? $employee->id : null : null,
                             ['class' => 'form-control dropdown-employee-name employee-select',
                             'data-msg-required'=> __('labels.This field is required'),
                             'onChange' => 'getEmployeeInfo()' ]) !!} --}}
                    </div>
                </div>
            </div>

            <div class="col-md-6 dropdown-div">
                <div class="form-group">
                    {!! Form::label('Name', trans('labels.name'),
                    ['class' => 'form-label required']) !!}
                    {{-- {!! Form::select('employee', $employees, $page == "edit" ? $employee ? $employee->id : null : null,
                    ['class' => 'form-control required dropdown-name employee-select',
                    'data-msg-required'=> __('labels.This field is required'),
                    'onChange' => 'getEmployeeDetails()' ]) !!} --}}


                    <select name="employee" class="form-control required dropdown-name employee-select"
                            onchange="getEmployeeDetails()"
                            data-msg-required="{{ __('labels.This field is required')}}">
                        <option value="">{{__('labels.select')}}</option>
                        @foreach($employees as $depertment)
                            <option disabled="disabled" style="background-color: #CCC solid; ">
                                <b>{{$depertment['name']}}</b></option>
                            @foreach($depertment['data'] as $key=>$depertment)
                                <option value="{{$key}}" @if($page=='edit'  && $patient->type !=='trainee')
                                @if($employee->id==$key) selected @endif @endif>{{$depertment}}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 txt-div" style="display: none">
                <div class="form-group">
                {!! Form::label('Name', trans('labels.name'),
                ['class' => 'form-label required']) !!}
                {!! Form::text('name', $page == "edit" ? $patient->name : null, ['class' =>
                'form-control required name',
                'placeholder' => trans('labels.name'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 50,
                'data-msg-maxlength'=> trans('labels.At most 50 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('name'))
                        <div class="help-block text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <style>
                    .select2-container--default .select2-results__option[aria-disabled=true] {
                        color: #5f0f0f;
                        background-color: #CCC;
                        font-weight: bold;
                        line-height: 2;
                    }

                </style>

                <div class="form-group">
                {!! Form::label('ID', trans('mms::patient.id'),
                ['class' => 'form-label required']) !!}
                {!! Form::text('patient_id', $page == "edit" ? $patient->patient_id : null, ['class' =>
                'form-control required',
                'placeholder' => trans('mms::patient.id'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 50,
                'data-msg-maxlength'=> trans('labels.At most 50 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('patient_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('patient_id') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('age', trans('mms::patient.age'), ['class' => 'form-label required']) !!}
                {!! Form::number('age', $page == "edit" ? $patient->age : null, ['class' =>
                'form-control required',
                'placeholder' => trans('mms::patient.age'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-max' => 100,
                'data-msg-max'=> trans('labels.Please enter a value less than or equal to 100'),
                'min' => 1,
                'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1') ])!!}
                <!-- error message -->
                    @if ($errors->has('age'))
                        <div class="help-block text-danger">
                            {{ $errors->first('age') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('mobile', trans('mms::patient.mobile'),
                ['class' => 'form-label required']) !!}
                {!! Form::text('mobile_no', $page == "edit" ? $patient->mobile_no : null, ['class' =>
                'form-control required',
                'placeholder' => trans('mms::patient.mobile'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-minlength' => 11,
                'data-msg-minlength'=> trans('labels.At least 11 characters'),
                'data-rule-maxlength' => 11,
                'data-msg-maxlength'=> trans('labels.At most 11 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('mobile_no'))
                        <div class="help-block text-danger">
                            {{ $errors->first('mobile_no') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    {!! Form::label('type', trans('mms::patient.gender'), ['class' => 'form-label required']) !!}
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('gender', 'male', $page == "edit" ? $patient->gender == "male" ? true : false : '',
                    ['class' => 'required']) !!}
                    <label>@lang('mms::patient.male')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('gender', 'female', $page == "edit" ? $patient->gender == "female" ? true : false : '',
                    ['class' => 'required',]) !!}
                    <label>@lang('mms::patient.female')</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('relation', trans('mms::patient.relation'), ['class' => 'form-label']) !!}
                {!! Form::text('relation', $page == "edit" ? $patient->relation : null, ['class' =>
                'form-control',
                'placeholder' => trans('mms::patient.relation'),
                'data-rule-maxlength' => 50,
                'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                ])!!}
                <!-- error message -->
                    @if ($errors->has('relation'))
                        <div class="help-block text-danger">
                            {{ $errors->first('relation') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-success">
            <i class="ft-check-square"></i>
            @lang('labels.save')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('patients.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>

@push('page-js')
    <script>
        $(document).ready(function () {
            $('.traineeInfo').addClass('hidden').removeClass('show');
        });
        $('input[name="type"]').on('ifClicked', function () {
            if ($(this).val() !== 'employee') {
                $('.txt-div').show();
                $('.dropdown-div').hide();
                $('.dropdown-name').removeClass('required');
            } else {
                $('.txt-div').hide();
                $('.dropdown-div').show();
                $('.dropdown-name').addClass('required');
            }
            if ($(this).val() == 'relative' || $(this).val() == 'others') {
                $('.employee_name').show();
                $('.dropdown-employee-name').addClass('required');
            } else {
                $('.employee_name').hide();
                $('.dropdown-employee-name').removeClass('required');
            }
            if ($(this).val() == 'trainee') {
                $('.training_id').find('option').remove();
                $('#trainee_id').find('option').remove();
                $('.traineeInfo').addClass('show').removeClass('hidden');
                $('input[name="patient_id"]').val('').prop("readonly", true);
                $('input[name="mobile_no"]').val('')
                $('input[name="name"]').val('');
                getTrainingsList();
                $('#trainee_id').addClass('required');
            } else {
                $('.traineeInfo').addClass('hidden').removeClass('show');
                $('#trainee_id').removeClass('required');
            }

            if ($(this).val() == 'student') {
                $('input[name="patient_id"]').val('').prop("readonly", false);
                $('input[name="mobile_no"]').val('')
                $('input[name="name"]').val('');
            }


        });

        function getTrainingsList() {
            let url = `{{ route('get-trainings-list') }}`;
            let data = [];
            $.get(url, data, function (response) {
                $('.training_id').find('option').remove();
                $('.training_id').append(`<option value=""><?php echo __('labels.select') ?></option>`);
                $.each(response, function (val, text) {
                    $('.training_id').append(`<option value="${val}">${text}</option>`);
                });
            });
        }

        function getTraineeList() {
            let trainingId = $('.training_id').val();
            if (trainingId.length === 0) {
                alert('Please select any Training ');
                $('#trainee_id').find('option').remove();
            } else {
                let url = `{{ route('get-trainee-list') }}` + '?trainingId=' + trainingId;
                let data = [];
                $.get(url, data, function (response) {
                    $('#trainee_id').find('option').remove();
                    $('#trainee_id').append(`<option value=""><?php echo __('labels.select') ?></option>`);
                    $.each(response, function (val, text) {
                        $('#trainee_id').append(`<option value="${val}">${text}</option>`);
                    });
                });
            }
        }

        function getEmployeeDetails() {
            let url = `{{ route('get-employee-details') }}`;
            let data = {id: $('.dropdown-name option:selected').val()}

            $.get(url, data, function (response) {
                $('input[name="name"]').val(`${response.first_name} ${response.last_name}`)
                $('input[name="patient_id"]').val(response.employee_id).prop("readonly", true);
                $('input[name="mobile_no"]').val(response.mobile_one)
            })
        }

        function getTraineeInfo() {
            let url = `{{ route('get-trainee-information') }}`;
            let data = {id: $('#trainee_id option:selected').val()}
            $.get(url, data, function (response) {
                // console.log(response);
                $('input[name="name"]').val(`${response.name}`)
                $('input[name="patient_id"]').val(response.patient_id).prop("readonly", true);
                $('input[name="mobile_no"]').val(response.mobile)
            })
        }

        function getEmployeeInfo() {
            let url = `{{ route('get-employee-details') }}`;
            let data = {id: $('.dropdown-employee-name option:selected').val()}

            $.get(url, data, function (response) {
                var employeeId = response.employee_id + '-' + Math.floor((Math.random() * 10) + 1);
                $('input[name="patient_id"]').val(employeeId).prop("readonly", true);
                $('input[name="mobile_no"]').val(response.mobile_one)
            })
        }

        @if(isset($patient))
        $(document).ready(function () {
            let type = "{{$patient->type}}";
            if (type === 'relative' || type === 'others') {
                $('.employee_name').show();
                $('.dropdown-employee-name').addClass('required');
            } else {
                $('.employee_name').hide();
            }

            if (type === 'trainee') {
                $('.traineeInfo').addClass('show').removeClass('hidden');
            }
        });

        @else
        $('.employee_name').hide();
        @endif
    </script>
@endpush
