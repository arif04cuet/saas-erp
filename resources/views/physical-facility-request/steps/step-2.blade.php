<h6>{{ trans('hm::booking-request.step_2') }}</h6>
<fieldset>
    <div id="room_booking_tab">
        <h4 class="form-section"><i
                class="la  la-building-o"></i>{{ trans('hm::booking-request.booking_details') }}
        </h4>
        <div class="row">
            <div class="col-md-6">
                <label class="required">{{ trans('hm::booking-request.start_date') }}</label>
                <div class="form-group">
                    <div class="input-group">

                        {{ Form::text('start_date', $page == 'create' ? date('j F, Y') : date('j F, Y', strtotime($roomBooking->start_date)), [
                            'id' => 'start_date',
                            'class' => 'form-control required' . ($errors->has('start_date') ? ' is-invalid' : ''),
                            'placeholder' => 'Pick start date',
                            'required' => 'required',
                            $page == 'edit' ? 'data-rule-greaterThanOrEqual="' . date('j F, Y') .'"' : null,
                            $page == 'edit' ? 'data-msg-greaterThanOrEqual="' . trans('labels.Must be greater than or equal to', ['attribute' => date('j F, Y')]) .'"' : null,
                        ]) }}
                        @if ($errors->has('start_date'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('start_date') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="required">{{ trans('hm::booking-request.end_date') }}</label>
                <div class="form-group">
                    <div class="input-group">
                        {{ Form::text('end_date', $page == 'create' ? (new DateTime())->add(new DateInterval("P1D"))->format('j F, Y') : date('j F, Y',strtotime($roomBooking->end_date)), [
                             'id' => 'end_date',
                             'class' => 'form-control required' . ($errors->has('end_date') ? ' is-invalid' : ''),
                             'placeholder' => 'Pick end date',
                             'data-msg-greaterThanOrEqual="' . trans('labels.Must be greater than or equal to', ['attribute' => trans('hm::booking-request.start_date')]) .'"',
                         ]) }}

                        @if ($errors->has('end_date'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- TODO: patch booking feature for general and training -->
        {{ Form::hidden('booking_type', 'general') }}
        {{--<div class="row">
            <div class="form-group col-md-6">
                <label class="required">{{ $type=='checkin'? trans('hm::booking-request.checkin_type') : trans('hm::booking-request.booking_type') }}</label>
                <div class="skin skin-flat">
                {!! Form::radio('booking_type', 'general', true, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) !!}
                <label>@lang('hm::booking-request.general')</label>
                </div>
                <div class="skin skin-flat">
                {!! Form::radio('booking_type', 'training',
                $page == 'create' ? old('booking_type') == 'training' : ($roomBooking->booking_type == 'training'),
                [
                'class' => 'required',
                'data-msg-required' => trans('labels.This field is required')
                ]
                ) !!}
                <label>@lang('hm::booking-request.training')</label>
                </div>
                <div class="row col-md-12 radio-error">
                    @if ($errors->has('booking_type'))
                        <span class="small text-danger"><strong>{{ $errors->first('booking_type') }}</strong></span>
                    @endif
                </div>
            </div>
            <div class="form-group mb-1 col-md-6 select-training-div"
                 style="{{ isset($roomBooking) ? ($roomBooking->training_id ? '' : 'display: none') : 'display: none' }}">
                <label class="required">@lang('tms::training.title') @lang('labels.list')</label>
                <select name="training_id" class="form-control training-select required"
                        data-msg-required="{{ trans('labels.This field is required') }}">
                    <option value="">Select Training</option>
                    @foreach($trainings as $training)
                        @if(isset($roomBooking))
                            <option value="{{$training->id}}" {{ $roomBooking->training_id == $training->id ? 'selected' : '' }}>{{$training->training_title}}</option>
                        @else
                            <option value="{{$training->id}}">{{$training->training_title}}</option>
                        @endif
                    @endforeach
                </select>

                @if ($errors->has('training_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('training_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>--}}

        <div class="row">
            <div class="form-group col-md-6 no-guests-div">
                <label for="no_guests"
                       class="required">@lang('hm::booking-request.no_of_guests')</label>
                {{ Form::number('no_of_guests', isset($roomBooking) ? $roomBooking->guestInfos->count() : 1, [
                    'class' => 'form-control',
                    'min' => 1,
                    'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                    'required',
                    'data-msg-required' => Lang::get('labels.This field is required'),
                    'data-rule-number' => 'true',
                    'data-msg-number' => trans('labels.Please enter a valid number'),
                    'data-guest-count' => isset($roomBooking) ? $roomBooking->guestInfos->count() : 1
                ]) }}
            </div>
        </div>

        {{--    <h4 class="form-section"><i class="la  la-building-o"></i>@lang('hm::booking-request.room_details')--}}
        {{--    </h4>--}}
        @if($errors->has('roomInfos'))
            <span class="danger small">
            <strong>{{ $errors->first('roomInfos') }}</strong>
        </span>
        @endif
        <div class="repeater-room-infos">
            <div data-repeater-list="roomInfos">
                @if (old('roomInfos'))
                    @foreach(old('roomInfos') as $oldInput)
                        <div data-repeater-item="" style="">
                            <div class="form row">
                                <div class="form-group mb-1 col-sm-12 col-md-4">
                                    <label class="required">{{ trans('hm::booking-request.room_type') }}</label>
                                    <br>
                                    <!-- Start For Edit Old Room Type -->
                                @if(isset($oldInput['id']))
                                    {{ Form::hidden('id', $oldInput['id']) }}
                                @endif
                                <!-- End For Edit Old Room Type -->
                                    {!! Form::select('room_type_id', $roomTypes->pluck('name', 'id'), $oldInput['room_type_id'], ['class' => 'form-control required room-type-select' . ($errors->has('roomInfos.' . $loop->index . '.room_type_id') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'Select Room Type', 'onChange' => 'getRoomTypeRates(event, this.value)']) !!}

                                    @if ($errors->has('roomInfos.' . $loop->index . '.room_type_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('roomInfos.' . $loop->index . '.room_type_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-4">
                                    <label for="quantity"
                                           class="required">{{ trans('hm::booking-request.quantity') }}</label>
                                    <br>
                                    {!! Form::number('quantity', $oldInput['quantity'],
                                    [
                                        'class' => 'form-control required' . ($errors->has('roomInfos.' . $loop->index . '.quantity') ? ' is-invalid' : ''),
                                        'data-msg-required' => Lang::get('labels.This field is required'),
                                        'placeholder' => 'e.g. 2',
                                        'data-rule-number' => 'true',
                                        'data-msg-number' => trans('labels.Please enter a valid number'),
                                        'data-rule-regex' => '^[0-9]+$',
                                        'data-msg-regex' => trans('labels.only_integer_number'), 'min' => 1
                                    ]) !!}

                                    @if ($errors->has('roomInfos.' . $loop->index . '.quantity'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('roomInfos.' . $loop->index . '.quantity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                {{--<div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="required">{{ trans('hm::booking-request.rate') }}</label>
                                    <br>
                                    {!! Form::select('rate', ['' => ''], null, ['class' => 'form-control required rate-select' . ($errors->has('roomInfos.' . $loop->index . '.rate') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required')]) !!}

                                    @if ($errors->has('roomInfos.' . $loop->index . '.rate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('roomInfos.' . $loop->index . '.rate') }}</strong>
                                        </span>
                                    @endif
                                </div>--}}
                                <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                    <button type="button"
                                            class="btn btn-outline-danger"
                                            data-repeater-delete=""><i
                                            class="ft-x"></i>
                                    </button>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                @else
                    @if( $page == 'create' )
                        <div data-repeater-item="" style="">
                            <div class="form row">
                                <div class="form-group mb-1 col-sm-12 col-md-4">
                                    <label class="required">{{ trans('hm::booking-request.room_type') }}</label>
                                    <br>
                                    {!! Form::select('room_type_id', $roomTypes->pluck('name', 'id'), null, ['class' => 'form-control room-type-select required', 'placeholder' => 'Select Room Type', 'onChange' => 'getRoomTypeRates(event, this.value)', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <span class="select-error"></span>
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-4">
                                    <label class="required"
                                           for="quantity">{{ trans('hm::booking-request.quantity') }}</label>
                                    <br>
                                    {!! Form::number('quantity', null, [
                                        'class' => 'form-control required', 'placeholder' => 'e.g. 2',
                                        'data-msg-required' => trans('labels.This field is required'),
                                        'data-rule-regex' => '^[0-9]+$',
                                        'data-msg-regex' => trans('labels.only_integer_number'),
                                        'min' => 1,
                                        'data-msg-min'=> trans('labels.At least 1 characters'),
                                        'max' => 100,
                                        'data-msg-max'=> trans('labels.At most 100 characters'),
                                        'data-rule-number' => 'true',
                                        'data-msg-number' => trans('labels.Please enter a valid number'),
                                    ]) !!}
                                </div>
                                {{--<div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="required">{{ trans('hm::booking-request.rate') }}</label>
                                    <br>
                                    {!! Form::select('rate', ['' => ''], null, ['class' => 'form-control required rate-select', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <span class="select-error"></span>
                                </div>--}}

                                <div class="form-group col-sm-12 col-md-1 text-center mt-2">
                                    <button type="button" class="btn btn-outline-danger" data-repeater-delete="">
                                        <i class="ft-x"></i>
                                    </button>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @else
                        @foreach($roomBooking->roomInfos as $roomInfo)
                            <div data-repeater-item="" style="">
                                <div class="form row">
                                    <div class="form-group mb-1 col-sm-12 col-md-4">
                                        <label class="required">{{ trans('hm::booking-request.room_type') }}</label>
                                        <br>
                                        {!! Form::hidden('id', $roomInfo->id) !!}
                                        {!! Form::select('room_type_id', $roomTypes->pluck('name', 'id'), $roomInfo->room_type_id, ['class' => 'form-control room-type-select required', 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'Select Room Type', 'onChange' => 'getRoomTypeRates(event, this.value)']) !!}
                                        <span class="select-error"></span>
                                    </div>
                                    <div class="form-group mb-1 col-sm-12 col-md-4">
                                        <label class="required"
                                               for="quantity">{{ trans('hm::booking-request.quantity') }}</label>
                                        <br>
                                        {!! Form::number('quantity', $roomInfo->quantity,
                                        [
                                            'class' => 'form-control required Quantity',
                                            'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'e.g. 2',
                                            'data-rule-regex' => '^[0-9]+$',
                                            'data-msg-regex' => trans('labels.only_integer_number'), 'min' => 1,
                                            'data-rule-number' => 'true',
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                        ]) !!}
                                    </div>
                                    {{--<div class="form-group mb-1 col-sm-12 col-md-3">
                                        <label class="required">{{ trans('hm::booking-request.rate') }}</label>
                                        <br>
                                        {!! Form::select('rate', ['' => ''], $roomInfo->rate_type . '_' . $roomInfo->rate, ['class' => 'form-control rate-select required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                        <span class="select-error"></span>
                                    </div>--}}
                                    <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                        <button type="button" class="btn btn-outline-danger" data-repeater-delete="">
                                            <i class="ft-x"></i>
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
            <div class="form-group overflow-auto">
                <div class="col-12">
                    <button type="button" data-repeater-create="" id="add_more_room"
                            class="pull-right btn btn-sm btn-outline-primary">
                        <i class="ft-plus"></i> @lang('labels.add')
                    </button>
                </div>
            </div>
        </div>
    </div>

    <h4 class="form-section"><i
            class="la  la-building-o"></i>{{ trans('hm::booking-request.facility.cafeteria_request') }}
    </h4>
    <div class="row" id="cafeteria_tab">
        <div class="col-md-12 text-center">
            <label class="form-label text-center">
                Feature is under construction
            </label>
        </div>
    </div>
</fieldset>
