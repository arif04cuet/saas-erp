@component('tms::trainee.partials.components.edit_layout', ['trainee' => $trainee])
    {!! Form::open(['url' =>  route('trainee.health-reports.update', $trainee->id),
                    'class' => 'form trainee-edit-form',
                    'novalidate',
                    'method' => 'put'
                    ])
    !!}
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="present_deseases">@lang('tms::training.present_deseases') : </label>
                            {{ Form::select('present_deseases[]', $present_diseases, array_keys($present_diseases), ['class' => 'select2-tags form-control', 'id' => 'select2-tags', 'data-msg-required'=>trans('labels.This field is required'), 'multiple' => 'multiple']) }}
                            @if ($errors->has('present_deseases'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('present_deseases') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="physical_disability">@lang('tms::training.physical_disability') : </label>
                            {{ Form::select('physical_disability[]',$physical_disability, array_keys($physical_disability) , ['class' => 'select2-tags form-control', 'id' => 'select2-tags', 'data-msg-required'=>trans('labels.This field is required'), 'multiple' => 'multiple']) }}
                            @if ($errors->has('physical_disability'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('physical_disability') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div><h1>@lang('tms::training.general_exammination')</h1></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="temperature" class="required">@lang('tms::training.temperature') : </label>
                                    {!! Form::text('temperature', optional($trainee->healthExaminations)->temperature ?? null, [
                                            'class' => 'form-control required' . ($errors->has('temperature') ? ' is-invalid' : ''),
                                            'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                            ])
                                    !!}

                                    @if ($errors->has('temperature'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('temperature') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" id="localisation" name="localisation" value="{{ app()->getLocale() }}">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pulse" class="required">@lang('tms::training.pulse') : </label>
                                    {!! Form::text('pulse', optional($trainee->healthExaminations)->pulse ?? null, [
                                            'class' => 'form-control required' . ($errors->has('pulse') ? ' is-invalid' : ''),
                                            'data-msg-required' => Lang::get('labels.This field is required'),
                                            'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                            'placeholder' => 'পাল্স'
                                            ])
                                    !!}

                                    @if ($errors->has('pulse'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pulse') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="respiration" class="required">@lang('tms::training.respiration') : </label>
                                    {!! Form::text('respiration', optional($trainee->healthExaminations)->respiration ?? null, ['class' => 'form-control required' . ($errors->has('respiration') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'রেস্পিরেশন', 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                                    @if ($errors->has('respiration'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('respiration') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="conjunctiva" class="required">@lang('tms::training.conjunctiva') : </label>
                                    {!! Form::text('conjunctiva', optional($trainee->healthExaminations)->conjunctiva ?? null, ['class' => 'form-control required' . ($errors->has('conjunctiva') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'কনজান্কটিভা', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'), 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                                    @if ($errors->has('conjunctiva'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('conjunctiva') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="oral_cavity" class="required">@lang('tms::training.oral_cavity') : </label>
                                    {!! Form::text('oral_cavity', optional($trainee->healthExaminations)->oral_cavity ?? null, ['class' => 'form-control required' . ($errors->has('oral_cavity') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'ওরাল ক্যাভিটি', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'), 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                                    @if ($errors->has('oral_cavity'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('oral_cavity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="denture" class="required">@lang('tms::training.denture') : </label>
                                    {!! Form::text('denture', optional($trainee->healthExaminations)->denture ?? null, ['class' => 'form-control required' . ($errors->has('denture') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'ডেন্চার', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'), 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                                    @if ($errors->has('denture'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('denture') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group col-md-12">
                                    <label for="blood_pressure" class="required">@lang('tms::training.blood_pressure')</label>
                                    <div class="skin skin-flat">
                                        {!! Form::radio('blood_pressure', '1', optional($trainee->healthExaminations) ?
                                                   optional($trainee->healthExaminations)->blood_pressure == '1' : false,
                                                   [
                                                   'class' => 'required',
                                                   'data-msg-required' => trans('labels.This field is required'),
                                                   ])
                                        !!}
                                        <label>@lang('tms::training.yes')</label>
                                    </div>
                                    <div class="skin skin-flat">
                                        {!! Form::radio('blood_pressure', '0', optional($trainee->healthExaminations) ?
                                                optional($trainee->healthExaminations)->blood_pressure == '0' : false,
                                                [
                                                'class' => 'required',
                                                'data-msg-required' => trans('labels.This field is required')
                                                ])
                                        !!}
                                        <label>@lang('tms::training.no')</label>
                                    </div>
                                    <div class="row col-md-12 radio-error">
                                        @if ($errors->has('blood_pressure'))
                                            <span class="small text-danger"><strong>{{ $errors->first('blood_pressure') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group col-md-12">
                                    <label for="anaemia" class="required">@lang('tms::training.anaemia')</label>
                                    <div class="skin skin-flat">
                                        {!! Form::radio('anaemia', '1', optional($trainee->healthExaminations) ?
                                                   optional($trainee->healthExaminations)->anaemia == '1' : false,
                                                   [
                                                   'class' => 'required',
                                                   'data-msg-required' => trans('labels.This field is required')
                                                   ])
                                        !!}
                                        <label>@lang('tms::training.yes')</label>
                                    </div>
                                    <div class="skin skin-flat">
                                        {!! Form::radio('anaemia', '0', optional($trainee->healthExaminations) ?
                                                   optional($trainee->healthExaminations)->anaemia == '0' : false,
                                                   [
                                                   'class' => 'required',
                                                   'data-msg-required' => trans('labels.This field is required')
                                                   ])
                                        !!}
                                        <label>@lang('tms::training.no')</label>
                                    </div>
                                    <div class="row col-md-12 radio-error">
                                        @if ($errors->has('anaemia'))
                                            <span class="small text-danger"><strong>{{ $errors->first('anaemia') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group col-md-12">
                                    <label for="oedema" class="required">@lang('tms::training.oedema')</label>
                                    <div class="skin skin-flat">
                                        {!! Form::radio('oedema', '1', optional($trainee->healthExaminations) ?
                                                   optional($trainee->healthExaminations)->oedema == '1' : false,
                                                   [
                                                   'class' => 'required',
                                                   'data-msg-required' => trans('labels.This field is required')
                                                   ])
                                        !!}
                                        <label>@lang('tms::training.yes')</label>
                                    </div>
                                    <div class="skin skin-flat">
                                        {!! Form::radio('oedema', '0', optional($trainee->healthExaminations) ?
                                                   optional($trainee->healthExaminations)->oedema == '0' : false,
                                                   [
                                                   'class' => 'required',
                                                   'data-msg-required' => trans('labels.This field is required')
                                                   ])
                                        !!}
                                        <label>@lang('tms::training.no')</label>
                                    </div>
                                    <div class="row col-md-12 radio-error">
                                        @if ($errors->has('oedema'))
                                            <span class="small text-danger"><strong>{{ $errors->first('oedema') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div><h1>@lang('tms::training.systemic_exammination')</h1></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heart" class="required">@lang('tms::training.heart') : </label>
                                    {!! Form::text('heart', optional($trainee->healthExaminations)->heart ?? null, ['class' => 'form-control required' . ($errors->has('heart') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'হার্ট', 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'), 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                                    @if ($errors->has('heart'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('heart') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lung" class="required">@lang('tms::training.lung') : </label>
                                    {!! Form::text('lung', optional($trainee->healthExaminations)->lung ?? null, ['class' => 'form-control required' . ($errors->has('lung') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'ফুসফুস', 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'), 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                                    @if ($errors->has('lung'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lung') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="abdomen" class="required">@lang('tms::training.abdomen') : </label>
                                    {!! Form::text('abdomen', optional($trainee->healthExaminations)->abdomen ?? null, ['class' => 'form-control required' . ($errors->has('abdomen') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'তলপেট', 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'), 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                                    @if ($errors->has('abdomen'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('abdomen') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="eye_sight" class="required">@lang('tms::training.eye_sight') : </label>
                            {!! Form::text('eye_sight', optional($trainee->healthExaminations)->eye_sight ?? null, ['class' => 'form-control required' . ($errors->has('eye_sight') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'দৃষ্টিশক্তি', 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                            @if ($errors->has('eye_sight'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('eye_sight') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="left_eye" class="required">@lang('tms::training.left_eye') :</label>
                            {!! Form::text('left_eye', optional($trainee->healthExaminations)->left_eye ?? null, ['class' => 'form-control required' . ($errors->has('left_eye') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'বাম চোখ', 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                            @if ($errors->has('left_eye'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('left_eye') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="right_eye" class="required">@lang('tms::training.right_eye') :</label>
                            {!! Form::text('right_eye', optional($trainee->healthExaminations)->right_eye ?? null, ['class' => 'form-control required' . ($errors->has('right_eye') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'ডান চোখ', 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                            @if ($errors->has('right_eye'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('right_eye') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <i class="ft-check-square"></i> {{trans('labels.save')}}
        </button>
        <button class="btn btn-warning" type="button"
                onclick="window.location.href= '{{route('medical.trainee.health-reports.show', $trainee->id)}}'">
            <i class="ft-x"></i> {{trans('labels.cancel')}}
        </button>
    </div>
    {!! Form::close() !!}
    
@endcomponent
