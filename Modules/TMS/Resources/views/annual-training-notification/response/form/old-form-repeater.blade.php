<h4 class="form-section"><i
        class="la la-hotel"></i>
    @lang('tms::annual_training.response.form_elements.repeater_title')
</h4>
<div class="col">
    <div class="annual-training-notification-response-repeater">
        <div data-repeater-list="response">
            @foreach(old('response') as $response)
                <div data-repeater-item>
                    <!-- Title -->
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('title',
                                    trans('labels.title'),
                                     ['class'=>'required'])
                                !!}
                                {!! Form::text('title',
                                        $response['title'],
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
                            <!-- error message -->
                            @if ($errors->has('response.'.$loop->index.'.title'))
                                <div class="help-block text-danger">
                                    {{ $errors->first('response.'.$loop->index.'.title')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Start and End Date-->
                    <div class="row">
                        <!-- Start Date  -->
                        <div class="col-4">
                            <div class="form-group">
                                {!! Form::label('start_date', trans('tms::hostel_booking_request.form_elements.start_date'), ['class' => 'form-label required']) !!}
                                {{
                                       Form::text('start_date', $response['start_date'], [
                                            'class' => 'form-control start-date required',
                                            'placeholder'=>trans('labels.select'),
                                            'data-msg-required'=> __('labels.This field is required'),
                                       ])
                                }}
                            </div>
                            <!-- error message -->
                            @if ($errors->has('response.'.$loop->index.'.start_date'))
                                <div class="help-block text-danger">
                                    {{ $errors->first('response.'.$loop->index.'.start_date')}}
                                </div>
                            @endif
                        </div>
                        <!-- End Date  -->
                        <div class="col-4">
                            <div class="form-group">
                                {!! Form::label('end_date', trans('tms::hostel_booking_request.form_elements.end_date'),
                                                ['class' => 'form-label required'])
                                !!}
                                {{
                                       Form::text('end_date', $response['end_date'], [
                                            'class' => 'form-control end-date required',
                                            'placeholder'=>trans('labels.select'),
                                            'data-msg-required'=> __('labels.This field is required'),
                                       ])
                                }}
                            </div>
                            <!-- error message -->
                            @if ($errors->has('response.'.$loop->index.'.end_date'))
                                <div class="help-block text-danger">
                                    {{ $errors->first('response.'.$loop->index.'.end_date')}}
                                </div>
                            @endif
                        </div>
                        <!-- Number of trainee  -->
                        <div class="col-4">
                            <div class="form-group">
                                {!! Form::label('no_of_trainee',
                                    trans('tms::annual_training.response.form_elements.no_of_trainee'),
                                    ['class'=>'required'])
                                 !!}
                                {!! Form::text('no_of_trainee', $response['no_of_trainee'],[
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
                            <!-- error message -->
                            @if ($errors->has('response.'.$loop->index.'.no_of_trainee'))
                                <div class="help-block text-danger">
                                    {{ $errors->first('response.'.$loop->index.'.no_of_trainee')}}
                                </div>
                            @endif
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
                                        $response['participant_type'],
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
                            <!-- error message -->
                            @if ($errors->has('response.'.$loop->index.'.participant_type'))
                                <div class="help-block text-danger">
                                    {{ $errors->first('response.'.$loop->index.'.participant_type')}}
                                </div>
                            @endif
                        </div>
                        <!-- remark -->
                        <div class="col-5">
                            <div class="form-group">
                                {!! Form::label('remark',
                                    trans('tms::annual_training.response.form_elements.remark'),
                                        ['class'=>''])
                                 !!}
                                {!! Form::textarea('remark', $response['remark'],[
                                           'class' => 'form-control ',
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
            @endforeach
        </div>
        <button type="button" data-repeater-create class="btn btn-sm btn-primary ">
            <i class="ft-plus"
               style="cursor: pointer">
            </i>@lang('labels.add')
        </button>
    </div>
</div>


