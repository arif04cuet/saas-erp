{!! Form::open(['url' =>  route('trainee.import.store',$training), 'class' => 'form', 'novalidate', 'method' => 'post']) !!}


<input type="hidden" name="training_id" value="{{$training->id}}">

<center>
    @foreach($errorList as $importError)
        <div class="alert bg-danger alert-dismissible" style="color: white">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button> {{$importError}}
        </div>
    @endforeach

    @if(!count($errorList) && !count($brokenTraineeMobileList) && count($traineeList))
        <button class="btn btn-success" type="submit" name="import_trainee"><i class="ft ft-upload"
                                                                               aria-hidden="true"></i> {{trans('tms::training.save_imported')}}
        </button>
    @endif
</center>

<table id="myTable" class="table table-striped table-bordered mt-1">
    <thead>
    <tr>
        <th>{{trans('labels.serial')}}</th>
        <th>{{trans('tms::trainee_import.form_elements.name')}}</th>
        <th>{{trans('tms::trainee_import.form_elements.mobile_number')}}</th>
        <th>{{trans('tms::trainee_import.form_elements.email')}}</th>
        <th>{{trans('tms::trainee_import.form_elements.dob')}}</th>
        <th>{{trans('tms::trainee_import.form_elements.gender')}}</th>
        <th>{{trans('tms::trainee_import.form_elements.father_name')}}</th>
        <th>{{trans('tms::trainee_import.form_elements.mother_name')}}</th>
        <th>{{trans('tms::trainee_import.form_elements.address')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($traineeList as $key=>$trainee)
        <tr
            @if(in_array($trainee[4], $brokenTraineeMobileList))  style='color:red' @endif>
            @php
                $banglaNameField = 'data['.$trainee[4].'][bangla_name]';
                $englishNameField = 'data['.$trainee[4].'][english_name]';
                $mobile = 'data['.$trainee[4].'][mobile]';
                $email = 'data['.$trainee[4].'][email]';
                $dob = 'data['.$trainee[4].'][dob]';
                $gender = 'data['.$trainee[4].'][trainee_gender]';
                $fatherName = 'data['.$trainee[4].'][fathers_name]';
                $fatherNameBangla = 'data['.$trainee[4].'][fathers_name_bn]';
                $motherName = 'data['.$trainee[4].'][mothers_name]';
                $motherNameBangla = 'data['.$trainee[4].'][mothers_name_bn]';
                $address = 'data['.$trainee[4].'][present_address]';
                $addressBangla = 'data['.$trainee[4].'][present_address_bn]';

            @endphp
            <th scope="row">{{ $loop->iteration }}</th>
            <!-- name -->
            <td>
                {{$trainee[0]." ".$trainee[1]}}
                <input type="hidden" name="{{$banglaNameField}}" value="{{$trainee[0]}}">
                <input type="hidden" name="{{$englishNameField}}" value="{{$trainee[1]}}">
            </td>
            <!-- mobile -->
            <td>
                {{$trainee[4] ?? trans('labels.not_found')}}
                <input type="hidden" name="{{$mobile}}" value="{{$trainee[4]}}">
            </td>
            <!-- email -->
            <td>
                {{$trainee[3] ?? trans('labels.not_found')}}
                <input type="hidden" name="{{$email}}" value="{{$trainee[3]}}"></td>
            <!-- dob -->
            <td>
                {{ $trainee[5] ?? trans('labels.not_found')}}
                <input type="hidden" name="{{$dob}}" value="{{$trainee[5]}}">
            </td>
            <!-- gender -->
            <td>
                {{ $trainee[2] ?? trans('labels.not_found')}}
                <input type="hidden" name="{{$gender}}" value="{{$trainee[2]}}">
            </td>
            <!-- father name -->
            <td>
                {{$trainee[6]." ".$trainee[7]}}
                <input type="hidden" name="{{$fatherName}}" value="{{$trainee[6]}}">,
                <input type="hidden" name="{{$fatherNameBangla}}" value="{{$trainee[7]}}">
            </td>
            <!-- mother name -->
            <td>
                {{$trainee[8]." ".$trainee[9]}}
                <input type="hidden" name="{{$motherName}}" value="{{$trainee[8]}}">,
                <input type="hidden" name="{{$motherNameBangla}}" value="{{$trainee[9]}}">
            </td>
            <!-- address -->
            <td>
                {{$trainee[10]." ".$trainee[11]}}
                <input type="hidden" name="{{$address}}" value="{{$trainee[10]}}">
                <input type="hidden" name="{{$addressBangla}}" value="{{$trainee[11]}}">
            </td>
        </tr>

    @endforeach
    </tbody>
</table>


{!! Form::close() !!}
