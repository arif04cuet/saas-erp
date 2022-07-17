@component('tms::trainee.partials.components.edit_layout', [
            'trainee' => $trainee
            ])
    {!! Form::open(['url' =>  route('trainee.trainee-type.update', $trainee->id),
                                'class' => 'form trainee-edit-form',
                                'novalidate',
                                'method' => 'put'
                            ]) !!}
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            {!! Form::hidden(
                                'trainee_id',
                                $trainee->id,
                                [
                                    'class' => 'form-control form-control-sm'
                                ]
                            )!!}
                            <div class="col-md-4"> 
                                {{ Form::label('trainee_type', trans('tms::trainee_type.title'), ['class' => 'required']) }}
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{-- <div class="skin skin-flat"> --}}
                                        {!! Form::radio(
                                            'trainee_type', 'association', $status,
                                            ['class' => 'required',
                                            'id' => 'org_trainee_type',
                                            'onclick' => 'setRadio(this)'
                                            ]) 
                                        !!}
                                        <span>সমিতি সদস্য</span>
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{-- <div class="skin skin-flat"> --}}
                                        {!! Form::radio(
                                            'trainee_type', 'doptor', $status2, ['class' => 'required',
                                            'id' => 'doptor_trainee_type',
                                            'onclick' => 'setRadio(this)'
                                            ]) 
                                        !!}
                                        <span>কর্মকর্তা</span>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5"></div>
                </div>
                <!------- Sumiti Member ------------>
                <div class="association-member border p-1" style="{{ $style }}">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="heading">সমিতি সদস্য</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('org_name', trans('tms::trainee_type.association_name'), ['class' => 'required']) }}
                                {!! Form::text(
                                    'org_name',
                                    isset($trainee->traineeType->org_name)? $trainee->traineeType->org_name : null,
                                    [
                                        'class' => 'form-control form-control-sm required' . ($errors->has('org_name') ? ' is-invalid' : ''),
                                        'data-msg-required' => Lang::get('labels.This field is required'),
                                        'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                    ]
                                )!!}
    
                                @if ($errors->has('org_name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('org_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('org_id', trans('tms::trainee_type.association_member_id'), ['class' => 'required']) }}
                                <br/>
                                {!! Form::text('org_id', isset($trainee->traineeType->org_id)? $trainee->traineeType->org_id : null, ['class' => 'form-control form-control-sm required' . ($errors->has('org_id') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}
    
                                @if ($errors->has('org_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('org_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('org_member_name', trans('tms::trainee_type.association_member_name'), ['class' => 'required']) }}
                                {!! Form::select(
                                    'org_member_name',
                                    $member_names,
                                    null,
                                    [
                                    'class' => 'form-control form-control-sm select2',
                                    'data-msg-required' => Lang::get('labels.This field is required'),
                                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$'
                                    ]
                                )!!}
    
                                @if ($errors->has('org_member_name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('org_member_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('org_member_join_date', trans('tms::trainee_type.association_join_date'), ['class' => 'required']) }}
                                <br/>
                                {!! Form::text(
                                    'org_member_join_date',
                                    isset($trainee->traineeType->org_member_join_date)? $trainee->traineeType->org_member_join_date : null,
                                    [
                                    'placeholder' => 'pick date',
                                    'class' => 'form-control form-control-sm org_member_join_date dateField required' . ($errors->has('org_member_join_date') ? ' is-invalid' : ''),
                                    'data-msg-required' => Lang::get('labels.This field is required')
                                    ]) 
                                !!}
    
                                @if ($errors->has('org_member_join_date'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('org_member_join_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!----------- Sumiti Member End ------------->
                <div class="kormokarta-form border p-1" style="{{ $style2 }}">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="heading">কর্মকর্তা</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('doptor_name', trans('tms::trainee_type.doptor_name'), ['class' => 'required']) }}
                                {!! Form::text(
                                    'doptor_name',
                                    isset($trainee->traineeType->doptor_name)? $trainee->traineeType->doptor_name : null,
                                    [
                                        'class' => 'form-control form-control-sm required doptor_name' . ($errors->has('doptor_name') ? ' is-invalid' : ''),
                                        'data-msg-required' => Lang::get('labels.This field is required'),
                                        'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                        'disabled' => 'true'
                                    ]
                                )!!}
    
                                @if ($errors->has('doptor_name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('doptor_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('doptor_service_id', trans('tms::trainee_type.doptor_service_id'), ['class' => 'required']) }}
                                {!! Form::text('doptor_service_id', isset($trainee->traineeType->doptor_service_id)? $trainee->traineeType->doptor_service_id : null, ['class' => 'form-control form-control-sm required' . ($errors->has('doptor_service_id') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                'disabled' => 'true'
                                ]) !!}
    
                                @if ($errors->has('doptor_service_id'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('doptor_service_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('doptor_present_designation', trans('tms::trainee_type.present_designation'), ['class' => 'required']) }}
                                {!! Form::select(
                                    'doptor_present_designation',
                                    $member_names,
                                    null,
                                    [
                                    'class' => 'form-control form-control-sm select2',
                                    'data-msg-required' => Lang::get('labels.This field is required'),
                                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                    'disabled' => 'true'
                                    ]
                                )!!}
    
                                @if ($errors->has('doptor_present_designation'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('doptor_present_designation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('doptor_join_date', trans('tms::trainee_type.doptor_join_date'), ['class' => 'required']) }}
                                <br/>
                                {!! Form::text(
                                    'doptor_join_date',
                                    isset($trainee->traineeType->doptor_join_date)? $trainee->traineeType->doptor_join_date : null,
                                      [
                                        'placeholder' => 'pick date',
                                        'class' => 'form-control form-control-sm required dateField' . ($errors->has('doptor_join_date') ? ' is-invalid' : ''),
                                       'data-msg-required' => Lang::get('labels.This field is required'),
                                       'disabled' => 'true'
                                ]) !!}
    
                                @if ($errors->has('doptor_join_date'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('doptor_join_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('doptor_present_designation_join_date', trans('tms::trainee_type.doptor_present_designation_join_date'), ['class' => 'required']) }}
                                <br/>
                                {!! Form::text(
                                    'doptor_present_designation_join_date',
                                    isset($trainee->traineeType->doptor_present_designation_join_date)? $trainee->traineeType->doptor_present_designation_join_date : null,
                                      [
                                        'placeholder' => 'pick date',
                                        'class' => 'form-control form-control-sm required dateField' . ($errors->has('doptor_present_designation_join_date') ? ' is-invalid' : ''),
                                       'data-msg-required' => Lang::get('labels.This field is required'),
                                       'disabled' => 'true'
                                ]) !!}
    
                                @if ($errors->has('doptor_present_designation_join_date'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('doptor_present_designation_join_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!----------- Doptor Member End ------------->
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <i class="ft-check-square"></i> {{trans('labels.save')}}
        </button>
        <button class="btn btn-warning" type="button"
                onclick="window.location.href= '{{route('trainee.index', $trainee->training->id)}}'">
            <i class="ft-x"></i> {{trans('labels.cancel')}}
        </button>
    </div>
    {!! Form::close() !!}
@endcomponent
