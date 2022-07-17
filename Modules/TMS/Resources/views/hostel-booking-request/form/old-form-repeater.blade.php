<h4 class="form-section"><i
        class="la la-hotel"></i>
    @lang('tms::hostel_booking_request.form_elements.repeater_title')
</h4>
<div class="col">
    <div class="tms-hostel-booking-request-repeater">
        <div data-repeater-list="tms_hostel_booking_request">
            @foreach(old('tms_hostel_booking_request') as $tmsHostelBookingRequest)
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
                                        $tmsHostelBookingRequest['room_type_id'],
                                        [
                                         'class' => "form-control select-room-type required select2",
                                         'data-msg-required'=> trans('labels.This field is required'),
                                         'placeholder'=> trans('labels.select'),
                                        ]
                                     )
                            !!}
                            </div>
                            <!-- error message -->
                            @if ($errors->has('tms_hostel_booking_request.'.$loop->index.'.room_type_id'))
                                <div class="help-block text-danger">
                                    {{ $errors->first('tms_hostel_booking_request.'.$loop->index.'.room_type_id') }}
                                </div>
                            @endif
                        </div>
                        <!-- Number -->
                        <div class="col-5">
                            <div class="form-group">
                                {!! Form::label('quantity',trans('tms::hostel_booking_request.form_elements.number'),
                                        ['class'=>'required'])
                                 !!}
                                {!! Form::text('quantity', $tmsHostelBookingRequest['quantity'],[
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
                            <!-- error message -->
                            @if ($errors->has('tms_hostel_booking_request.'.$loop->index.'.quantity'))
                                <div class="help-block text-danger">
                                    {{ $errors->first('tms_hostel_booking_request.'.$loop->index.'.quantity') }}
                                </div>
                            @endif
                        </div>
                        <!-- delete buttton -->
                        <div class="form-group col-2" style="margin-top: 25px">
                            <button type="button" class="btn btn-outline-danger" data-repeater-delete="">
                                <i class="ft-x"></i>
                            </button>
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
