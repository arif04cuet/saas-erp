@extends('hm::layouts.master')
@section('title', __('hm::hostel.room'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('hm::hostel.create_room_title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' =>  'rooms.store', 'class' => 'form', 'novalidate']) !!}
                            <h4 class="form-section"><i class="la  la-building-o"></i>@lang('hm::hostel.create_room_form')</h4>
                            <h5>@lang('hm::hostel.add_room_lbl', ['hostel' => $hostel->name])</h5>
                            <input type="hidden" name="hostel_id" value="{{$hostel->id}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('floor') ? ' error' : '' }}">
                                        {!! Form::label('floor',  __('hm::hostel.floor'), ['class' => 'form-label required']) !!}
                                        {!! Form::text('floor', old('floor'), ["class" => "form-control","autofocus" => "autofocus", "required",
                                         "placeholder" => "e.g 1", 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('hm::hostel.floor')])]) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('floor'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('floor') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('room_type_id',  __('hm::roomtype.title'), ['class' => 'form-label required']) !!}
                                        {{ Form::select('room_type_id', $roomTypes,  null, ['class' => 'form-control', 'required' => 'required', 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('hm::roomtype.title')])]) }}
                                        <div class="help-block"></div>
                                        @if ($errors->has('room_type'))
                                            <div class="help-block">  {{ $errors->first('room_type_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('room_numbers') ? ' error' : '' }}">
                                        {!! Form::label('room_numbers',  __('hm::hostel.room') .' '. __('labels.number'), ['class' => 'form-label required']) !!}
                                        {!! Form::text('room_numbers', old('room_numbers'), ["class" => "form-control","autofocus" => "autofocus", "required" => true,
                                         "placeholder" => "e.g 201-205 or 201,202,203", 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('hm::hostel.room').' '.__('labels.number')])]) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('room_numbers'))
                                            <div class="help-block"> {{ $errors->first('room_numbers') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            {{--<h4 class="form-section"><i class="la  la-table"></i>Room Inventories</h4>--}}

                            {{--<div class="repeater-room-inventories">--}}
                            {{--<div data-repeater-list="rooms">--}}
                            {{--<div data-repeater-item="" style="">--}}
                            {{--<div class="form row">--}}
                            {{--<div class="form-group mb-1 col-sm-12 col-md-5">--}}
                            {{--<label>Item Name</label>--}}
                            {{--<br>--}}
                            {{--<select name="inventory_item" id="" class="form-control" required>--}}
                            {{--<option value=""></option>--}}
                            {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group mb-1 col-sm-12 col-md-5">--}}
                            {{--<label>Quantity</label>--}}
                            {{--<br>--}}
                            {{--<input type="number" name="quantity" min="1" id=""--}}
                            {{--class="form-control" placeholder="e.g 2">--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-sm-12 col-md-2 text-center mt-2">--}}
                            {{--<button type="button" class="btn btn-outline-danger"--}}
                            {{--data-repeater-delete=""><i--}}
                            {{--class="ft-x"></i>--}}
                            {{--</button>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<hr>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group overflow-auto">--}}
                            {{--<div class="col-12">--}}
                            {{--<button type="button" data-repeater-create=""--}}
                            {{--class="pull-right btn btn-sm btn-outline-primary">--}}
                            {{--<i class="ft-plus"></i> Add--}}
                            {{--</button>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-actions text-center">--}}
                            {{--<button type="submit" class="btn btn-primary">--}}
                            {{--<i class="la la-check-square-o"></i> Save--}}
                            {{--</button>--}}
                            {{--<a class="btn btn-warning mr-1" role="button" href="#">--}}
                            {{--<i class="ft-x"></i> Cancel--}}
                            {{--</a>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> @lang('labels.save')
                                </button>
                                <a class="btn btn-warning mr-1" role="button" href="{{route('hostels.index')}}">
                                    <i class="ft-x"></i> @lang('labels.cancel')
                                </a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#hostel-select, #room-type-select').select2({
                placeholder: 'Select option'
            });

            $('.repeater-room-inventories').repeater({
                show: function () {
                    $('div:hidden[data-repeater-item]')
                        .find('input.is-invalid')
                        .each((index, element) => {
                            $(element).removeClass('is-invalid');
                        });

                    $(this).slideDown();
                },
            });
        });
    </script>
@endpush
