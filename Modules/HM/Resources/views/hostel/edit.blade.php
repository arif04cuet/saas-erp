@extends('hm::layouts.master')
@section('title', __('hm::hostel.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('hm::hostel.edit_card_title')</h4>
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
                            @if ($errors->has('hostels'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $errors->first('hostels') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {!! Form::open(['route' => ['hostels.update', $hostel->id], 'class' => 'form', 'novalidate']) !!}
                            @method('PUT')
                            <h4 class="form-section"><i class="la  la-building-o"></i>@lang('hm::hostel.update_button')
                            </h4>
                            <!-- Name and Bangla Name -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name', __('labels.name'), ['class' => 'form-label required']) !!}
                                        {!! Form::text('name', $hostel->name ?? null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required ', 'placeholder' => 'e.g Hostel 1', 'data-validation-required-message' => 'Please enter name']) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('bangla_name', trans('labels.bangla_name'), ['class' => 'form-label required']) !!}
                                        {!! Form::text('bangla_name', $hostel->bangla_name ?? null, [
    'class' => 'form-control' . ($errors->has('bangla_name') ? ' is-invalid' : ''),
    'required ',
    'placeholder' => 'নাম (বাংলা)',
    'data-validation-required-message' => trans('validation.required', ['attribute' => __('labels.bangla_name')]),
]) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('bangla_name'))
                                            <span class="invalid-feedback">{{ $errors->first('bangla_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Total Floor -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('total_floor', __('hm::hostel.total_floor'), ['class' => 'form-label required']) !!}
                                        {!! Form::number('total_floor', $hostel->total_floor, ['class' => 'form-control' . ($errors->has('total_floor') ? ' is-invalid' : ''), 'required', 'placeholder' => 'e.g 5', 'data-validation-required-message' => 'Please enter total floor', 'min=1']) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('total_floor'))
                                            <span class="invalid-feedback">{{ $errors->first('total_floor') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> {{ __('labels.edit') }}
                                </button>
                                <a class="btn btn-warning mr-1" role="button" href="{{ route('hostels.index') }}">
                                    <i class="ft-x"></i> {{ __('labels.cancel') }}
                                </a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
