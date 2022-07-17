@extends('ims::layouts.master')
@section('title', trans('ims::inventory.item.edit'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('ims::inventory.item.edit')</h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements" style="top: 5px;">
                        <ul class="list-inline mb-1">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body">
                        {{ Form::open(['route' =>  ['inventory-items.update', $item->id], 'class' => 'form', 'novalidate']) }}
                        @method('PUT')
                        <h4 class="form-section">
                            <i class="la la-building"></i>
                            @lang('ims::inventory.item.edit_form_title')
                        </h4>
                        <div class="row">
                            <!-- Title -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('title', __('labels.title'), ['class' => 'form-label required']) !!}
                                    {!! Form::text('title', old('title') ?? $item->title,
['class' => "form-control", "required ", "placeholder" => __('labels.title'), 'maxlength' => 250,
                                    'data-validation-required-message' => __('labels.This field is required')]) !!}
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- ID -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('unique_id', __('ims::inventory.item.unique_id'), ['class' => 'form-label']) !!}
                                    {!! Form::label('unique_id', $item->unique_id, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <!-- Model -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('model', __('ims::inventory.item.model'), ['class' => 'form-label']) !!}
                                    {!! Form::text('model', old('model') ?? $item->model,
['class' => "form-control", "placeholder" => __('ims::inventory.item.model'), 'maxlength' => 250]) !!}
                                    <div class="help-block"></div>
                                    @if ($errors->has('model'))
                                        <span class="help-block red">
                                            {{ $errors->first('model') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Unit Price -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('unit_price', __('ims::inventory.item.unit_price'),
['class' => 'form-label required']) !!}
                                    {!! Form::number('unit_price', old('unit_price') ?? $item->unit_price,
['class' => "form-control", "required ", "placeholder" => __('ims::inventory.item.unit_price'), 'step' => '.01',
                                    'maxlength' => 10, 'data-validation-maxlength-message' => __('labels.At most 10 characters'),
                                    'data-validation-number-message' =>
                                    __('validation.numeric', ['attribute' => __('ims::inventory.item.unit_price')]),
                                    'data-validation-required-message' => __('labels.This field is required')]) !!}
                                    <div class="help-block"></div>
                                    @if ($errors->has('unit_price'))
                                        <span class="help-block red">
                                            {{ $errors->first('unit_price') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Invoice -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('invoice_no', __('ims::inventory.item.invoice_no'), ['class' => 'form-label']) !!}
                                    {!! Form::text('invoice_no', old('invoice_no') ?? $item->invoice_no,
                                        ['class' => "form-control", "placeholder" => __('ims::inventory.item.invoice_no'),
                                        'maxlength' => 50])
                                    !!}
                                    <div class="help-block"></div>
                                    @if ($errors->has('invoice_no'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('invoice_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Remark -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('remark', __('labels.details'), ['class' => 'form-label']) !!}
                                    {!! Form::textarea('remark', old('remark') ?? $item->remark,
['class' => "form-control", "placeholder" => __('labels.details'), 'maxlength' => 250, 'rows' => 2]) !!}
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="form-actions center">
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-check-square-o"></i> {{trans('labels.edit')}}
                            </button>
                            <a class="btn btn-warning" role="button"
                               href="{{ route('inventory-items.index') }}" style="margin-left: 2px;">
                                <i class="la la-times"></i> {{trans('labels.cancel')}}
                            </a>

                        </div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
