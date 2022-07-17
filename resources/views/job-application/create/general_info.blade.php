<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('first_name') ? ' error' : '' }}">
            {{ Form::label('first_name', trans('labels.first_name'), ['class' => 'required'] ) }}
            {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Jon', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('first_name'))
                <div class="help-block">  {{ $errors->first('first_name') }}</div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('last_name') ? ' error' : '' }}">
            {{ Form::label('last_name', trans('labels.last_name'), ['class' => 'required']) }}
            {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Doe', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('last_name'))
                <div class="help-block">  {{ $errors->first('last_name') }}</div>
            @endif
        </div>
        <div class="form-group {{ $errors->has('employee_id') ? ' error' : '' }}">
            {{ Form::label('employee_id', trans('hrm::employee_general_info.employee_id'), ['class' => 'required']) }}
            {{ Form::text('employee_id', null, ['class' => 'form-control', 'placeholder' => '', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('employee_id'))
                <div class="help-block">  {{ $errors->first('employee_id') }}</div>
            @endif
        </div>
        <div class="form-group {{ $errors->has('department_id') ? ' error' : '' }}">
            {{ Form::label('department', trans('hrm::department.department'), ['class' => 'required']) }}
            {{ Form::select('department_id',$employeeDepartments, null, ['id'=> 'department_id','placeholder' => trans('labels.select') ,'class' => 'form-control', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('department_id'))
                <div class="help-block">  {{ $errors->first('department_id') }}</div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('section_id') ? ' error' : '' }}">
            {{ Form::label('section', trans('hrm::department.section_title'), ['class' => 'required']) }}
            {{ Form::select('section_id',$sections, null, ['id' => 'section_id','placeholder' => trans('labels.select') ,'class' => 'form-control']) }}
            <div class="help-block"></div>
        </div>

        <div class="form-group {{ $errors->has('designation_id') ? ' error' : '' }}">
            {{ Form::label('designation_id', trans('hrm::designation.designation'), ['class' => 'required']) }}
            {{ Form::select('designation_id', $employeeDesignations,  null, ['placeholder' => trans('labels.select'), 'class' => 'form-control', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('designation_id'))
                <div class="help-block">  {{ $errors->first('designation_id') }}</div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('other_duties') ? ' error' : '' }}">
            {{ Form::label('other_duties', trans('hrm::employee_general_info.employee_other_duties')) }}
            {{Form::text('other_duties', null, ['class' => 'form-control'])}}
            <div class="help-block"></div>
            @if ($errors->has('status'))
                <div class="help-block">  {{ $errors->first('status') }}</div>
            @endif
        </div>


        <div class="form-group {{ $errors->has('gender') ? ' error' : '' }}">
            {{ Form::label('gender', trans('labels.gender'), ['class' => 'required']) }}
            {{ Form::select('gender',  Config::get('constants.gender'),  null, ['placeholder' => trans('labels.select'), 'class' => 'form-control', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('gender'))
                <div class="help-block">  {{ $errors->first('gender') }}</div>
            @endif
        </div>


        <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
            {{ Form::label('status', trans('hrm::employee_general_info.employee_current_status'), ['class' => 'required']) }}
            {{ Form::select('status', Config::get('constants.employee_available_status'),  null, ['placeholder' => trans('labels.select'), 'class' => 'form-control', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->has('status'))
                <div class="help-block">  {{ $errors->first('status') }}</div>
            @endif
        </div>


        <div class="form-group {{ $errors->has('email') ? ' error' : '' }}">
            {{ Form::label('email', trans('labels.email_address'), ['class' => 'required']) }}
            {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'info@example.com', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @foreach ($errors->get('email') as $message)
                <div class="help-block">  {{ $message }}</div>
            @endforeach
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <h1><label class="required">@lang('hrm::employee_general_info.upload_employee_photo')</label></h1>
            <div class="avatar-upload">
                <div class="avatar-edit">
                    <input type='file' name="photo" id="imageUpload" accept=".png, .jpg, .jpeg" @if(empty($employee->photo)) required  data-validation-required-message ="{{ trans('labels.Picture field is required') }}" @endif />
                    <label for="imageUpload"></label>
                </div>
                <div class="avatar-preview">
                    <div id="imagePreview"
                         style="background-image: url({{ '/file/get?filePath='.$photoUrl }});">
                    </div>
                </div>
                <div class="help-block"></div>
            </div>

        </div>
        <br/>
        <div class="form-group {{ $errors->has('tel_office') ? ' error' : '' }}">
            {{ Form::label('tel_office', trans('labels.tel_office')) }}
            {{ Form::number('tel_office', null, ['class' => 'form-control', 'placeholder' => '02XXXXXXX', 'maxlength' =>'11', 'data-validation-maxlength-message'=>trans('labels.At least 11 characters')]) }}
            <div class="help-block"></div>
            @foreach ($errors->get('tel_office') as $message)
                <div class="help-block">  {{ $message }}</div>
            @endforeach
        </div>

        <div class="form-group {{ $errors->has('tel_home') ? ' error' : '' }}">
            {{ Form::label('tel_home', trans('labels.tel_home')) }}
            {{ Form::number('tel_home', null, ['class' => 'form-control','placeholder' => '02XXXXXXX','maxlength' =>'11', 'data-validation-maxlength-message'=>'Enter maximum 11 digit']) }}
            <div class="help-block"></div>
            @foreach ($errors->get('tel_home') as $message)
                <div class="help-block">  {{ $message }}</div>
            @endforeach
        </div>

        <div class="form-group {{ $errors->has('mobile_one') ? ' error' : '' }}">
            {{ Form::label('mobile_one', trans('labels.mobile') . " (1)", ['class' => 'required']) }}
            {{ Form::number('mobile_one', null, ['class' => 'form-control','placeholder' => '017XXXXXXXX','required' => 'required',
            'data-validation-required-message'=> trans('labels.This field is required'),  'minlength' =>'11',
            'data-validation-minlength-message'=>trans('validation.minlength', ['attribute'=> __('labels.mobile'), 'min'=>11]), 'maxlength' =>'11',
            'data-validation-maxlength-message'=> trans('validation.maxlength', ['attribute'=> __('labels.mobile'), 'max'=>11])]) }}
            <div class="help-block"></div>
            @foreach ($errors->get('mobile_one') as $message)
                <div class="help-block">  {{ $message }}</div>
            @endforeach
        </div>

        <div class="form-group {{ $errors->has('mobile_two') ? ' error' : '' }}">
            {{ Form::label('mobile_two', trans('labels.mobile'). " (2)") }}
            {{ Form::number('mobile_two', null, ['class' => 'form-control','placeholder' => '017XXXXXXXX',  'minlength' =>'11', 'data-validation-minlength-message'=>trans('labels.At least 11 characters'), 'maxlength' =>'11', 'data-validation-maxlength-message'=>'Enter maximum 11 digit',]) }}
            <div class="help-block"></div>
            <div class="help-block"></div>
            @foreach ($errors->get('mobile_two') as $message)
                <div class="help-block">  {{ $message }}</div>
            @endforeach
        </div>
    </div>


    <hr>
    {{ Form::hidden('id', null) }}
    <div class="form-actions col-md-12 ">
        <div class="pull-right">
            {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
            <a href="{{ url('/hrm/employee') }}">
                <button type="button" class="btn btn-warning mr-1">
                    <i class="la la-times"></i> @lang('labels.cancel')
                </button>
            </a>

        </div>
    </div>
</div>
@push('page-js')
    <script>
        $(document).ready(function () {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imageUpload").change(function () {
                readURL(this);
            });
        });

        $("#department_id").change(function () {
            var url = "{{url('hrm/get-sections-by-dept-id/')}}" ;
            $.get( url +'/'+ $('#department_id').val(), function (data) {
                $('#section_id').find('option').remove();
                if(data.length > 0)
                {
                    for (i=0; i < data.length; i++)
                    {
                        $('#section_id').append(new Option(data[i]['name'], data[i]['id']));
                    }
                }
            });
        });

    </script>

@endpush