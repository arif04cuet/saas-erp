@component('tms::trainee.partials.components.create_layout', ['trainee' => $trainee])
    {!! Form::open(['url' =>  route('trainee.general-info.store', $trainee->id),
                    'class' => 'form trainee-create-form',
                    'novalidate',
                    'method' => 'post'
                    ])
    !!}
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @include('tms::trainee.create.lang.father_name_field')

                    @include('tms::trainee.create.lang.mother_name_field')
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emailAddress1" class="required">@lang('tms::training.birth_place') :</label>
                            {!! Form::text('birth_place', old('birth_place'), [
                                'class' => 'form-control required' . ($errors->has('fathers_name') ? ' is-invalid' : ''),
                                'data-msg-required' => Lang::get('labels.This field is required'),
                                'placeholder' => 'Comilla',
                                'data-rule-maxlength' => 50,
                                'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                            ]) !!}

                            @if ($errors->has('birth_place'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('birth_place') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="location1" class="required">@lang('tms::training.marital_status') :</label>
                                <div class="skin skin-flat">
                                    {!! Form::radio('marital_status', 'married', old('marital_status'), [
                                        'class' => 'required',
                                        'data-msg-required' => trans('labels.This field is required')
                                    ]) !!}
                                    <label>@lang('tms::training.married')</label>
                                </div>
                                <div class="skin skin-flat">
                                    {!! Form::radio('marital_status', 'unmarried', old('marital_status'), [
                                        'class' => 'required',
                                        'data-msg-required' => trans('labels.This field is required')
                                    ]) !!}
                                    <label>@lang('tms::training.unmarried')</label>
                                </div>
                                <div class="row col-md-12 radio-error">
                                    @if ($errors->has('marital_status'))
                                        <span class="small text-danger"><strong>{{ $errors->first('marital_status') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('tms::trainee.create.lang.present_address_field')

            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <i class="ft-check-square"></i> {{trans('labels.save')}}
        </button>
        <button class="btn btn-warning" type="button"
                onclick="window.location.href= '{{route('trainee.index', $trainee->training_id)}}'">
            <i class="ft-x"></i> {{trans('labels.cancel')}}
        </button>
    </div>
    {!! Form::close() !!}
@endcomponent
