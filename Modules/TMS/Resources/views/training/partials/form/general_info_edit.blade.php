{!! Form::open([
        'route' =>  ['training.update', $training->id],
        'class' => 'form wizard-circle training-form', 'novalidate',
        'method' => 'put',
        'enctype' => 'multipart/form-data'
        ])
        !!}
    <div class="form-body">
        <div class="col">
            <h4 class="form-section"><i class="ft-user"></i>
                @lang('tms::training.edit_training_form')
            </h4>
            <!-- Training  name & Bangla Name -->
            <div class="row">
                <!-- English name -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('training_name', trans('tms::training.name_eng'), ['class' => 'required'] ) }}
                        {{ Form::text('title',
                            $training->title,
                            [
                                'class' => 'form-control form-control-sm',
                                'placeholder' => '',
                                'required' => 'required',
                                'data-msg-required' => trans('labels.This field is required'),
                                'data-rule-minlength' => 3,
                                'data-msg-minlength'=> trans('labels.At least 3 characters'),
                                'data-rule-maxlength' => 100,
                                'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                            ])
                        }}
                        <div class="help-block"></div>
                        @if ($errors->has('title'))
                            <div class="help-block">  {{ $errors->first('title') }}</div>
                        @endif
                    </div>
                </div>
                <!-- Bangla Name -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('bangla_title', trans('tms::training.name_bn'), ['class' => 'required'] ) }}
                        {{ Form::text('bangla_title',
                            $training->bangla_title ?? null,
                            [
                                'class' => 'form-control form-control-sm',
                                'placeholder' => '',
                                'required' => 'required',
                                'data-msg-required' => trans('labels.This field is required'),
                                'data-rule-minlength' => 3,
                                'data-msg-minlength'=> trans('labels.At least 3 characters'),
                                'data-rule-maxlength' => 100,
                                'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                            ])
                        }}
                        <div class="help-block"></div>
                        @if ($errors->has('bangla_title'))
                            <div class="help-block">  {{ $errors->first('bangla_title') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Training Unique Id -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('uid', trans('tms::training.training_code'), ['class' => 'form-label required'] ) }}
                        <div class=" input-group">
                            {{-- <div class="input-group-prepend">
                        <span class="input-group-text" id="code_prefix">
                            {{$trainingId ?? '47.63.000.052.25'}}
                        </span>
                            </div> --}}
                            {{ Form::text('uid', $training->uid,
                                [
                                       'class' => 'form-control form-control-sm required',
                                       'data-rule-maxlength'=> 500,
                                       'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                                       'data-msg-required' => trans('labels.This field is required'),
                                       'placeholder'=>''
                               ])
                            }}
                        </div>
                        <div class="help-block"></div>
                        @if ($errors->has('uid'))
                            <span class="invalid-feedback">{{ $errors->first('uid') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="required">@lang('tms::training.venue')</label>
                        {{ Form::select('venue_id', $venues ?? [], isset($venues) ? $training->venue_id : null, [
                            'class' => 'form-control form-control-sm required',
                            'data-msg-required' => trans('labels.This field is required'),
                            'placeholder' => trans('labels.select'),
                            'select2'
                        ]) }}
    
                        @if($errors->has('venue_id'))
                            <strong class="danger">{{ $errors->first('venue_id') }}</strong>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Participant and Batches -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('no_of_trainee', trans('tms::training.training_participant_no'), ['class' => 'required']) }}
                        {{ Form::number('no_of_trainee',
                            $training->no_of_trainee,
                            [
                                'class' => 'form-control form-control-sm',
                                'placeholder' => '',
                                'required' => 'required',
                                'data-msg-required' => trans('labels.This field is required'),
                                'data-msg-number' => trans('labels.Please enter a valid number'),
                                'min' => 1,
                                'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'),
                                'max' => 1000,
                                'data-msg-max' => trans('labels.Please enter a value less than or equal to 1000'),
                                'step' => 1,
                                'data-msg-step' => trans('labels.Decimal numbers are not acceptable'),
                            ])
                        }}
                        <div class="help-block"></div>
                        @if ($errors->has('no_of_trainee'))
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $errors->first('no_of_trainee') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('batches', trans('tms::training.no_batches'), ['class' => 'required']) }}
                        {{ Form::number('no_of_batches', $training->no_of_batches,
                            [
                                'class' => 'form-control form-control-sm required',
                                'data-msg-required' => trans('labels.This field is required'),
                                'placeholder' => '',
                                'data-msg-number' => trans('labels.Please enter a valid number'),
                                'min' => 1,
                                'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'),
                                'max' => 30,
                                'data-msg-max' => trans('labels.Please enter a value less than or equal to 30'),
                                'step' => 1,
                                'data-msg-step' => trans('labels.Decimal numbers are not acceptable'),
                            ])
                        }}
                        <div class="help-block"></div>
                        @if ($errors->has('batches'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('batches') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
    
            </div>
            <!-- Budget and Lang Pref -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="required">@lang('tms::budget.budget')</label>
                        {{ Form::select('budget_id', $budgets ?? [], isset($budgets) ? $training->budget_id : null, [
                            'class' => 'form-control form-control-sm required',
                            'data-msg-required' => trans('labels.This field is required'),
                            'placeholder' => trans('labels.select'),
                            'select2'
                        ]) }}
    
                        @if($errors->has('budget_id'))
                            <strong class="danger">{{ $errors->first('budget_id') }}</strong>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="level" class="form-label required">@lang('tms::training.lang_preference.title')</label>
                        <div class="row">
                            @foreach($langOptions as $option)
                                <div class="col-md-4">
                                    <div class="skin skin-flat">
                                        {!! Form::radio('lang_preference', $option, $option == $training->lang_preference ? true : false, [
                                                                            'class' => 'required training_level',
                                                                            'data-msg-required' => Lang::get('labels.This field is required')
                                                                            ]) !!}
                                        <label
                                            for="language_preference">
                                            @lang('tms::trainee.language_preference.'.$option)
                                        </label>
                                    </div>
                                </div>
                                <div class="radio-error"></div>
                            @endforeach
                        </div>
    
                        <div class="row radio-error"></div>
                        @if ($errors->has('lang_preference'))
                            <div class="small danger">
                                <strong>{{ $errors->first('lang_preference') }}</strong>
                            </div>
                        @endif
    
                    </div>
                </div>
            </div>
        </div>
        <!-- Budget and Lang Pref -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="form-section"><i class="ft-user"></i>
                    @lang('tms::training.through_training_accommodation')
                </h4>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <i class="ft-user"></i> <label for="level" class="form-label required">@lang('tms::training.through_training')</label>
                    <div class="row">
                        @foreach($trainingThrougs as $option)
                            <div class="col-md-6">
                                <div class="skin skin-flat">
                                    {!! Form::radio('through_training', $option, $option == $training->through_training ? true : false, [ 'class' => 'required training_level', 'data-msg-required' => Lang::get('labels.This field is required')
                                                                        ]) !!}
                                    <label
                                        for="through_training">
                                        @lang('tms::training.through.'.$option)
                                    </label>
                                </div>
                            </div>
                            <div class="radio-error"></div>
                        @endforeach
                    </div>
    
                    <div class="row radio-error"></div>
                    @if ($errors->has('through_training'))
                        <div class="small danger">
                            <strong>{{ $errors->first('through_training') }}</strong>
                        </div>
                    @endif
    
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <i class="ft-user"></i> <label for="level" class="form-label required">@lang('tms::training.accommodation_type')</label>
                    <div class="row">
                        @foreach($accommodations as $option)
                            <div class="col-md-6">
                                <div class="skin skin-flat">
                                    {!! Form::radio('accommodation', $option, $option == $training->accommodation ? true : false, [
                                                                        'class' => 'required training_level',
                                                                        'data-msg-required' => Lang::get('labels.This field is required')
                                                                        ]) !!}
                                    <label
                                        for="accommodation">
                                        @lang('tms::training.accommodation.'.$option)
                                    </label>
                                </div>
                            </div>
                            <div class="radio-error"></div>
                        @endforeach
                    </div>
    
                    <div class="row radio-error"></div>
                    @if ($errors->has('accommodation'))
                        <div class="small danger">
                            <strong>{{ $errors->first('accommodation') }}</strong>
                        </div>
                    @endif
    
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <i class="ft-user"></i> <label for="level" class="form-label required">@lang('tms::training.enroll_allow')</label>
                    <div class="row">
                        @foreach($enrollTypes as $option)
                            <div class="col-md-6">
                                <div class="skin skin-flat">
                                    {!! Form::radio('enroll_type', $option, $option == $training->enroll_type ? true : false, [
                                                                        'class' => 'required training_level',
                                                                        'data-msg-required' => Lang::get('labels.This field is required')
                                                                        ]) !!}
                                    <label
                                        for="enroll_type">
                                        @lang('tms::training.enroll_type.'.$option)
                                    </label>
                                </div>
                            </div>
                            <div class="radio-error"></div>
                        @endforeach
                    </div>
    
                    <div class="row radio-error"></div>
                    @if ($errors->has('enroll_type'))
                        <div class="small danger">
                            <strong>{{ $errors->first('enroll_type') }}</strong>
                        </div>
                    @endif
    
                </div>
            </div>
        </div>
    </div>
    <!-- Cover and Feature Photo Upload -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <h1><label class="required">
                    @lang('tms::training.upload_photo')
                        (@lang('tms::trainee.fields.image.maximum') @lang('tms::trainee.fields.image.size')
                        - @lang('tms::trainee.fields.image.3mb'))
                    </label><br>
                </h1>
                <div class="training-photo avatar-upload">
                    <div class="avatar-edits">
                        <input type='file' name="photo"
                               id="imageUpload"
                               accept=".png, .jpg, .jpeg"
                               class="form-control form-control-sm validateImageFile"
                               data-rule-image-size="#imageUpload"
                        />
                        <label for="imageUpload"></label>
                    </div>
                    @if($training->photo)
                        <div class="avatar-preview">
                            <div id="imagePreview"
                                 style="background-image: url({{ url("/file/get?filePath=" .  $training->photo) }});">
                            </div>
                        </div>
                    @else
                        <div class="avatar-preview">
                            <div id="imagePreview"
                                 style="background-image: url({{ asset('/images/training-default-photo.jpg') }});">
                            </div>
                        </div>
                    @endif
                    <div id="imageValidationMassage" class="text-danger" style="margin-top: 5px;">
                    </div>
                    <div class="help-block"></div>
                    @if ($errors->has('photo'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('photo') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions mb-lg-3">
        <a class="master btn btn-warning pull-right" role="button" href="{{ route('training-head.index') }}"
           style="margin-left: 2px;">
            <i class="la la-times"></i> {{trans('labels.cancel')}}
        </a>
        <button type="submit" class="master btn btn-primary pull-right">
            <i class="la la-check-square-o"></i> {{trans('labels.save')}}
        </button>
    </div>

    {!! Form::close() !!}

