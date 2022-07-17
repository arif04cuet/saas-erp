<h6>{{ trans('tms::training.physical_information') }}</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="joining_age" class="required">@lang('tms::training.joining_age') :</label>
                        {!! Form::number('joining_age', old('joining_age'), ['class' => 'form-control required' . ($errors->has('joining_age') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => '30']) !!}
                        @if ($errors->has('joining_age'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('joining_age') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="expertise_sports" class="">@lang('tms::training.expertise_sports') : </label>
                        {{ Form::select('expertise_sports[]',[], NULL , ['class' => 'select2-tags form-control', 'id' => 'select2-tags', 'data-msg-required'=>trans('labels.This field is required'), 'multiple' => 'multiple']) }}
                        @if ($errors->has('expertise_sports'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('expertise_sports') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hobby" class="">@lang('tms::training.hobby') : </label>
                        {{ Form::select('hobby[]',[], NULL , ['class' => 'select2-tags form-control', 'id' => 'select2-tags', 'data-msg-required'=>trans('labels.This field is required'), 'multiple' => 'multiple']) }}
                        @if ($errors->has('hobby'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('hobby') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="sports_experience" class="">@lang('tms::training.experience') :</label>
                            {{ Form::select('sports_experience',['Song' => 'Song', 'Acting' => 'Acting', 'Dancing' => 'Dancing', 'Speech' => 'Speech'], NULL , ['class' => ' form-control instituteSelection',
                                                'placeholder' => trans('labels.select'),'data-validation-required-message'=>trans('labels.This field is required')]) }}
                            @if ($errors->has('sports_experience'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sports_experience') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="hieght" class="required">@lang('tms::training.hieght') : (@lang('tms::training.inch'))</label>
                    {!! Form::number('hieght', old('hieght'), ['class' => 'form-control required' . ($errors->has('hieght') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => '65']) !!}
                    @if ($errors->has('hieght'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('hieght') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="weight" class="required">@lang('tms::training.weight') : (@lang('tms::training.kilogram'))</label>
                    {!! Form::number('weight', old('weight'), ['class' => 'form-control required' . ($errors->has('weight') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => '70']) !!}
                    @if ($errors->has('weight'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('weight') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label for="normal_chest" class="required">@lang('tms::training.normal_chest') : (@lang('tms::training.inch'))</label>
                    {!! Form::text('normal_chest', old('normal_chest'), ['class' => 'form-control required' . ($errors->has('normal_chest') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => '32']) !!}
                    @if ($errors->has('normal_chest'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('normal_chest') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="expended_chest" class="required">@lang('tms::training.expended_chest') : (@lang('tms::training.inch'))</label>
                    {!! Form::text('expended_chest', old('expended_chest'), ['class' => 'form-control required' . ($errors->has('expended_chest') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => '34']) !!}
                    @if ($errors->has('expended_chest'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('expended_chest') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="weight_end_course" class="required">@lang('tms::training.weight_end_course') : (@lang('tms::training.kilogram'))</label>
                    {!! Form::text('weight_end_course', old('weight_end_course'), ['class' => 'form-control required' . ($errors->has('weight_end_course') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => '75']) !!}
                    @if ($errors->has('weight_end_course'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('weight_end_course') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>


        <br>
</fieldset>


