@extends('hm::layouts.master')
@section('title', __('hm::hostel.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('hm::hostel.create_card_title')</h4>
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
                            @if($errors->has('hostels'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $errors->first('hostels') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {!! Form::open(['route' =>  'hostels.store', 'class' => 'form', 'novalidate']) !!}
                            <h4 class="form-section"><i class="la la-building-o"></i>@lang('hm::hostel.create_button')
                            </h4>
                            <!-- name and bangla name -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name',  __('labels.name'), ['class' => 'form-label required']) !!}
                                        {!! Form::text('name', old('name'), ["class" => "form-control". ($errors->has('name') ? ' is-invalid' : ''), "required ",
                                         "placeholder" => "e.g Hostel 1", 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('labels.name')])]) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('bangla_name',  trans('labels.bangla_name'), ['class' => 'form-label required']) !!}
                                        {!! Form::text('bangla_name', old('bangla_name') ?? null, [
                                            "class" => "form-control". ($errors->has('bangla_name') ? ' is-invalid' : ''), "required ",
                                            "placeholder" => "নাম (বাংলা)",
                                            'data-validation-required-message'=>trans('validation.required',
                                             ['attribute' => __('labels.bangla_name')])
                                             ])
                                          !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('bangla_name'))
                                            <span class="invalid-feedback">{{ $errors->first('bangla_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- total floor -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('total_floor',  __('hm::hostel.total_floor'), ['class' => 'form-label required']) !!}
                                        {!! Form::number('total_floor', old('total_floor'), ["class" => "form-control". ($errors->has('total_floor') ? ' is-invalid' : ''), "required",
                                         "placeholder" => "e.g 5", 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('hm::hostel.total_floor')])]) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('total_floor'))
                                            <span class="invalid-feedback">{{ $errors->first('total_floor') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <h4 class="form-section"><i
                                    class="la  la-table"></i>{{__('hm::hostel.room').' '.__('labels.details')}}</h4>

                            <div class="repeater-rooms">
                                <div data-repeater-list="rooms">
                                    <div data-repeater-item="" style="">
                                        <div class="form row">
                                            <div class="form-group mb-1 col-sm-12 col-md-3">
                                                {!! Form::label('floor',  __('hm::hostel.floor').' '.__('labels.number'), ['class' => 'form-label required']) !!}
                                                <br>
                                                {!! Form::number('floor', old('floor'), ["class" => "form-control". ($errors->has('floor') ? ' error' : ''), "required",
                                                "placeholder" => "e.g 1", 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('hm::hostel.floor') .__('labels.number')])]) !!}
                                                <div class="help-block"></div>
                                                @if ($errors->has('floor'))
                                                    <span class="invalid-feedback">{{ $errors->first('floor') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-3 form-group">
                                                {{ Form::label('room_type', __('hm::roomtype.title'), ['class' => 'required']) }}
                                                {{ Form::select('room_type', $roomTypes, null, ['class' => 'form-control'. ($errors->has('room_type') ? ' error' : ''),
                                                 'required' => 'required', 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('hm::roomtype.title')])]) }}
                                                <div class="help-block"></div>
                                                @if ($errors->has('room_type'))
                                                    <span
                                                        class="invalid-feedback">{{ $errors->first('room_type') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group mb-1 col-sm-12 col-md-3">
                                                {!! Form::label('room_numbers',  __('hm::hostel.room').' '.__('labels.number'), ['class' => 'form-label required']) !!}
                                                <br>
                                                {!! Form::text('room_numbers', old('room_numbers'), ["class" => "form-control". ($errors->has('room_numbers') ? ' error' : ''), "required", "min" => 1,
                                                "placeholder" => "e.g 201-205 or 201,202,203", 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('hm::hostel.room').__('labels.number')])]) !!}
                                                <div class="help-block"></div>
                                                @if ($errors->has('room_numbers'))
                                                    <span
                                                        class="invalid-feedback">{{ $errors->first('room_numbers') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-12 col-md-1 text-center mt-2">
                                                <button type="button" class="btn btn-outline-danger"
                                                        data-repeater-delete=""><i
                                                        class="ft-x"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group overflow-auto">
                                    <div class="col-12">
                                        <button type="button" data-repeater-create=""
                                                class="pull-right btn btn-sm btn-outline-primary add">
                                            <i class="ft-plus"></i> @lang('labels.add')
                                        </button>
                                    </div>
                                </div>

                                <div class="form-actions text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> {{__('labels.save')}}
                                    </button>
                                    <a class="btn btn-warning mr-1" role="button" href="{{route('hostels.index')}}">
                                        <i class="ft-x"></i> {{__('labels.cancel')}}
                                    </a>
                                </div>
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
        $(document).ready(() => {
            //
            $('.repeater-rooms').repeater({
                show: function () {
                    $('div:hidden[data-repeater-item]')
                        .find('input.is-invalid')
                        .each((index, element) => {
                            $(element).removeClass('is-invalid');
                        });
                    $(this).slideDown();
                },
            });
            $('.add').on('click', function () {
                $('input, select,textarea').jqBootstrapValidation('destroy');
                $('input, select,textarea').jqBootstrapValidation();
            });
        });
    </script>
@endpush
