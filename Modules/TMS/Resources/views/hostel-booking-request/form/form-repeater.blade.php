@if(old('tms_hostel_booking_request'))
    @include('tms::hostel-booking-request.form.old-form-repeater');
@else
    <h4 class="form-section"><i
            class="la la-hotel"></i>
        @lang('tms::hostel_booking_request.form_elements.repeater_title')
    </h4>
    <div class="col">
        <div class="tms-hostel-booking-request-repeater">
            <div data-repeater-list="tms_hostel_booking_request">
                <div data-repeater-item>
                    <div class="row">
                        <!-- Room Type-->
                        <div class="col-5">
                            <div class="form-group">
                                {!! Form::label('room_type_id',
                                    trans('tms::hostel_booking_request.form_elements.room_type'),
                                     ['class'=>'required'])
                                !!}
                                {!! Form::select('room_type_id',
                                        $roomTypes,
                                        null,
                                        [
                                         'class' => "form-control select-room-type required select2",
                                         'data-msg-required'=> trans('labels.This field is required'),
                                         'placeholder'=> trans('labels.select'),
                                        ]
                                     )
                            !!}
                            </div>
                        </div>
                        <!-- Number -->
                        <div class="col-5">
                            <div class="form-group">
                                {!! Form::label('quantity',trans('tms::hostel_booking_request.form_elements.number'),
                                        ['class'=>'required'])
                                 !!}
                                {!! Form::text('quantity', 1,[
                                           'class' => 'form-control quantity required',
                                           'data-rule-digits'=>'true',
                                           'data-rule-max'=>100,
                                           'data-rule-min'=>1,
                                           'data-msg-digits'=> trans('labels.only_integer_number'),
                                           'data-msg-max'=> trans('labels.max_validate_equal_or_less',['max'=>100]),
                                           'data-msg-min'=> trans('labels.Must be greater than or equal to',['attribute'=>1]),
                                           'data-msg-required'=> __('labels.This field is required'),
                                ])!!}
                            </div>
                        </div>
                        <!-- delete buttton -->
                        <div class="form-group col-2" style="margin-top: 25px">
                            <button type="button" class="btn btn-outline-danger" data-repeater-delete="">
                                <i class="ft-x"></i>
                            </button>
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

