@extends('accounts::layouts.master')
@section('title', trans('accounts::sector.temporary.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('accounts::sector.temporary.create') </h4>
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

                            {!! Form::open(['route' =>  'temporary-sectors.index', 'class' => 'form economy-code-form', 'novalidate']) !!}
                            <h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::sector.temporary.title')
                            </h4>

                            <div class="row">
                                <!-- English Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('english_name', trans('labels.name') .' (English)', ['class' => 'form-label required']) !!}
                                        <span class="danger">*</span>
                                        {!! Form::text('english_name', null, ['class' => 'form-control', 'required',
                                        "placeholder" => "e.g Assets", 'data-validation-required-message'=>trans('validation.required', ['attribute' => trans('labels.name')])]) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('english_name'))
                                            <span class="invalid-feedback">{{ $errors->first('english_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- Bangla Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name', trans('labels.name') .' (বাংলা)', ['class' => 'form-label required']) !!}
                                        <span
                                            class="danger">*</span>
                                        {!! Form::text('bangla_name', null, ['class' => 'form-control', 'required',
                                        "placeholder" => "e.g Assets", 'data-validation-required-message'=>trans('validation.required', ['attribute' => trans('labels.name')])]) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('bangla_name'))
                                            <span class="invalid-feedback">{{ $errors->first('bangla_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Description and Fiscal Year -->
                            <div class="row">
                                <!-- Description -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('description', trans('labels.description'), ['class' => 'form-label required']) !!}
                                        {!! Form::textarea('description', null, ['rows' => '2', 'class' => 'form-control',
                                        "placeholder" => trans('labels.description')]) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>

                            <!-- For Demo Purpose Only -->
                            @php
                                $fiscalYear = ['2017-2018','2018-2019','2019-2020'];
                            @endphp
                            <!-- Fiscal Year -->
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('fiscal_year_id', 'Fiscal Year', ['class' => 'form-label required']) !!}
                                        {!! Form::select('fiscal_year_id', $fiscalYear, null,
                                        ['class' => "form-control", "required ", "placeholder" => 'Select a fiscal year',
                                        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Save / Cancel Button -->
                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i>{{ trans('labels.save') }}
                                </button>
                                <a class="btn btn-warning mr-1" role="button"
                                   href="{{url(route('journal.index'))}}">
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
    <script>
        // select2 placeholder localization
        let selectPlaceholder = '{!! trans('labels.select') !!}';

        $(document).ready(function () {

            $('.economy-head-select').select2({
                placeholder: selectPlaceholder
            });

        });

    </script>
@endpush
