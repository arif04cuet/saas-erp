{{ Form::open(['route' => ['trainings.courses.store', $training->id],
        'method' => 'POST',
        'id' => 'training-course-create-form',
        'class' => 'training-course-create-form course-custom-textarea',
        'enctype' => 'multipart/form-data'
]) }}
<div class="row">
    <div class="col-md-6">
        {{ Form::hidden('training_id', $training->id) }}
        {{ Form::hidden('uid', $uid) }}
        <div class="form-group">
            <label for="">@lang('tms::course.course_id')</label>
            {{ Form::text('uid', $uid, ['class' => 'form-control form-control-sm']) }}

            @if($errors->has('uid'))
                <strong class="danger">{{ $errors->first('uid') }}</strong>
            @endif
        </div>
        <div class="form-group">
            <label for="" class="required">@lang('tms::course.name_en')</label>
            {{ Form::text('name', isset($course) ? $course->name : null, [
                'class' => 'form-control form-control-sm required' . ($errors->has('name') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'data-rule-regex-en' => config('regex.en'),
                'data-rule-maxlength' => 50,
                'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ]) }}

            @if($errors->has('name'))
                <strong class="danger">{{ $errors->first('name') }}</strong>
            @endif
        </div>
        <div class="form-group">
            <label for="" class="required">@lang('tms::course.name_bn')</label>
            {{ Form::text('name_bn', isset($course) ? $course->name_bn : null, [
                'class' => 'form-control form-control-sm required' . ($errors->has('name_bn') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'data-rule-regex-bn' => config('regex.bn'),
                'data-rule-maxlength' => 50,
                'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ]) }}

            @if($errors->has('name_bn'))
                <strong class="danger">{{ $errors->first('name_bn') }}</strong>
            @endif
        </div>
        <div class="form-group">
            <label for="" class="required">@lang('tms::training.venue')</label>
            {{ Form::select('venue_id', $venues, isset($course) ? $course->venue_id : null, [
                'class' => 'form-control form-control-sm required',
                'data-msg-required' => trans('labels.This field is required'),
                'placeholder' => trans('labels.select'),
                'select2'
            ]) }}

            @if($errors->has('venue_id'))
                <strong class="danger">{{ $errors->first('venue_id') }}</strong>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
    
                    <label for="start_date"
                           class="form-label required">{{trans('tms::course.start_date')}}</label>
                    <div id="start-date-container" class="date-container"></div>
                    {!! Form::text('start_date', isset($course) ? $course->start_date : null,
                    [
                        'class' => 'form-control form-control-sm required',
                        'data-msg-required' => trans('labels.This field is required'),
                        'placeholder' => 'Pick Date',
                        'id' => 'start_date',
                    ]) !!}
    
                    <div class="help-block"></div>
                    @if ($errors->has('start_date'))
                        <p class="text-danger">{{ $errors->first('start_date') }}</p>
                    @endif
                </div>
            </div>
            <!-- Registration endline -->
            <div class="col-md-12">
                <div class="form-group">
                    <label for="end_date"
                           class="form-label required">{{trans('tms::course.end_date')}}</label>
                    <div id="end-date-container" class="date-container"></div>
                    {!! Form::text('end_date',isset($course) ? $course->end_d : null,
                    [
                        'class' => 'form-control form-control-sm required',
                        'data-msg-required' => trans('labels.This field is required'),
                        'placeholder' => 'Pick Date',
                        'id' => 'end_date',
                         'data-msg-greaterThan' =>  trans('labels.greaterThan', ['name' => trans('hrm::appraisal.start_date')])
                    ]) !!}
    
                    <div class="help-block"></div>
                    @if ($errors->has('end_date'))
                        <p class="text-danger">{{ $errors->first('end_date') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            <h1 class="mb-0"><label class="required">
                @lang('tms::course.upload_photo')
                    (@lang('tms::trainee.fields.image.maximum') @lang('tms::trainee.fields.image.size')
                    - @lang('tms::trainee.fields.image.3mb'))
                </label>
            </h1>
            <div class="course-photo avatar-upload mt-0 ml-0">
                <div class="avatar-edits">
                    <input type='file' name="photo" id="imageUpload" accept=".png, .jpg, .jpeg" class="form-control form-control-sm validateImageFile"
                        required
                        data-msg-required="{{ trans('labels.Picture field is required') }}"
                        data-rule-image-size="#imageUpload"
                    />
                    <label for="imageUpload"></label>
                </div>
                <div class="avatar-preview">
                    <div id="imagePreview"
                        style="background-image: url({{ asset('/images/training-default-photo.jpg') }});">
                    </div>
                </div>
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
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="required">@lang('tms::course.course_detail_bn')</label>
            {{ Form::textarea('course_detail_bn', isset($course) ? $course->course_detail_bn : null, [
                'class' => 'form-control form-control-sm required' . ($errors->has('course_detail_bn') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'data-rule-regex-bn' => config('regex.bn'),
                'data-rule-maxlength' => 50,
                'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ]) }}

            @if($errors->has('course_detail_bn'))
                <strong class="danger">{{ $errors->first('course_detail_bn') }}</strong>
            @endif
        </div>
        <div class="form-group">
            <label for="" class="required">@lang('tms::course.course_detail_en')</label>
            {{ Form::textarea('course_detail_en', isset($course) ? $course->course_detail_en : null, [
                'class' => 'form-control form-control-sm required' . ($errors->has('course_detail_en') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'data-rule-regex-en' => config('regex.en'),
                'data-rule-maxlength' => 50,
                'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ]) }}

            @if($errors->has('course_detail_en'))
                <strong class="danger">{{ $errors->first('course_detail_en') }}</strong>
            @endif
        </div>
        <div class="form-group">
            <label for="">@lang('tms::training_course.implemented_by')</label>
            {{ Form::text(null, 'DoC', ['class' => 'form-control form-control-sm', 'disabled']) }}
        </div>
        <div class="form-group">
            <label for="registration_deadline"
                   class="form-label required">@lang('tms::training.registration_deadline')</label>
            <div id="registration-deadline-container" class="date-container"></div>
            {!! Form::text('registration_deadline', isset($course) ? $course->registration_deadline : null,
            [
                'class' => 'form-control form-control-sm required',
                'data-msg-required' => trans('labels.This field is required'),
                'placeholder' => 'Pick Date',
                'id' => 'registration_deadline',
            ]) !!}

            <div class="help-block"></div>
            @if ($errors->has('registration_deadline'))
                <p class="text-danger">{{ $errors->first('registration_deadline') }}</p>
            @endif
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="ft-check-square"></i> {{ trans('labels.save') }}
    </button>
    <a href="{{ route('training.index') }}" class="btn btn-warning">
        <i class="ft-x"></i> {{ trans('labels.cancel') }}
    </a>
</div>

{{ Form::close() }}

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('select').select2({
                placeholder: '{!! trans('labels.select') !!}'
            });

            // $('input[name=start_date]').daterangepicker({
            //     startDate: new Date(Date.parse("{{ $startDate }}")),
            //     minDate: new Date(Date.parse("{{ $startDate }}")),
            //     maxDate: new Date(Date.parse("{{ $endDate }}")),
            //     singleDatePicker: true,
            //     showDropdowns: true,
            //     locale: {
            //         format: 'DD/MM/YYYY'
            //     }
            // });

            // $('input[name=end_date]').daterangepicker({
            //     startDate: new Date(Date.parse("{{ $endDate }}")),
            //     minDate: new Date(Date.parse("{{ $startDate }}")),
            //     maxDate: new Date(Date.parse("{{ $endDate }}")),
            //     singleDatePicker: true,
            //     showDropdowns: true,
            //     locale: {
            //         format: 'DD/MM/YYYY'
            //     }
            // });

            $('#start_date').pickadate({
                locale: {
                    format: 'dd/mm/YYYY'
                }
            });
            $('#end_date').pickadate({
                locale: {
                    format: 'dd/mm/YYYY'
                }
            });
            $('#registration_deadline').pickadate({
                locale: {
                    format: 'dd/mm/YYYY'
                }
            });

            jQuery.validator.addMethod(
                "regex-bn",
                function (value, element, params) {
                    let regex = new RegExp(params);
                    return value.match(params);
                },
                "{{ trans('tms::trainee.errors.messages.regex.bn') }}"
            );

            jQuery.validator.addMethod(
                "regex-en",
                function (value, element, params) {
                    let regex = new RegExp(params);
                    return value.match(params);
                },
                "{{ trans('tms::trainee.errors.messages.regex.en') }}"
            );

        });
    </script>
@endpush
