@if(!old('response')->isEmpty())
    @include('tms::annual-training-notification.response.form.old-form-repeater')
@else
    <h4 class="form-section"><i
            class="la la-tag"></i>
        @lang('tms::annual_training.response.form_elements.repeater_title')
    </h4>
    <div class="col">
        <div class="annual-training-notification-response-repeater">
            <div data-repeater-list="response">
                <div data-repeater-item>

                    <div class="row">
                        <!-- Title -->
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('title',
                                    trans('labels.title'),
                                     ['class'=>'required'])
                                !!}
                                {!! Form::text('title',
                                        null,
                                        [
                                         'class' => "form-control required ",
                                         'data-rule-maxlength'=> 500,
                                         'data-msg-required'=> trans('labels.This field is required'),
                                         'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                                         'placeholder'=> trans('labels.select'),
                                        ]
                                     )
                            !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Start Date  -->
                        <div class="col-4">
                            <div class="form-group">
                                {!! Form::label('start_date', trans('tms::hostel_booking_request.form_elements.start_date'), ['class' => 'form-label required']) !!}
                                {{
                                       Form::text('start_date', old('start_date') ?? date('Y-m-d'), [
                                            'class' => 'form-control start-date required',
                                            'placeholder'=>trans('labels.select'),
                                            'data-msg-required'=> __('labels.This field is required'),
                                       ])
                                }}
                            </div>
                        </div>

                        <!-- End Date  -->
                        <div class="col-4">
                            <div class="form-group">
                                {!! Form::label('end_date', trans('tms::hostel_booking_request.form_elements.end_date'),
                                                ['class' => 'form-label required'])
                                !!}
                                {{
                                       Form::text('end_date', old('end_date') ?? date('Y-m-d'), [
                                            'class' => 'form-control end-date required',
                                            'placeholder'=>trans('labels.select'),
                                            'data-msg-required'=> __('labels.This field is required'),
                                       ])
                                }}
                            </div>
                        </div>

                        <!-- Number of trainee  -->
                        <div class="col-4">
                            <div class="form-group">
                                {!! Form::label('no_of_trainee',
                                    trans('tms::annual_training.response.form_elements.no_of_trainee'),
                                    ['class'=>'required'])
                                 !!}
                                {!! Form::text('no_of_trainee', 1,[
                                           'class' => 'form-control required',
                                           'data-rule-digits'=>'true',
                                           'data-rule-max'=>5000,
                                           'data-rule-min'=>1,
                                           'data-msg-digits'=> trans('labels.only_integer_number'),
                                           'data-msg-max'=> trans('labels.max_validate_equal_or_less',['max'=>5000]),
                                           'data-msg-min'=> trans('labels.Must be greater than or equal to',['attribute'=>1]),
                                           'data-msg-required'=> __('labels.This field is required'),
                                ])!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Participant Type -->
                        <div class="col-5">
                            <div class="form-group">
                                {!! Form::label('participant_type',
                                    trans('tms::annual_training.response.form_elements.participant_type'),
                                     ['class'=>'required'])
                                !!}
                                {!! Form::text('participant_type',
                                        null,
                                        [
                                         'class' => "form-control required ",
                                         'data-rule-maxlength'=> 500,
                                         'data-msg-required'=> trans('labels.This field is required'),
                                         'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                                         'placeholder'=> trans('labels.select'),
                                        ]
                                     )
                            !!}
                            </div>
                        </div>
                        <!-- remark -->
                        <div class="col-5">
                            <div class="form-group">
                                {!! Form::label('remark',
                                    trans('tms::annual_training.response.form_elements.remark'),
                                        ['class'=>''])
                                 !!}
                                {!! Form::textarea('remark', null,[
                                           'class' => 'form-control',
                                           'rows'=>4,
                                           'data-rule-maxlength'=> 500,
                                           'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                                           'data-msg-required'=> trans('labels.This field is required'),
                                ])!!}
                            </div>
                        </div>
                        <!-- delete buttton -->
                        <div class="col-2">
                            <div class="form-group" style="margin-top: 25px">
                                <button type="button" class="btn btn-outline-danger" data-repeater-delete="">
                                    <i class="ft-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" data-repeater-create class="btn btn-sm btn-primary ">
                <i class="ft-plus"
                   style="cursor: pointer">
                </i>@lang('labels.add')
            </button>
        </div>
    </div>
@endif

