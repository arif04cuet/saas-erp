@if($page == 'create')
    {!! Form::open(['route' =>  'cost-centers.store', 'class' => 'form', 'novalidate']) !!}
@else
    {!! Form::open(['route' =>  ['cost-centers.update', $costCenter->id], 'class' => 'form', 'novalidate']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i
            class="la la-tag"></i>@lang('accounts::cost-center.create')</h4>

<!-- Name and fiscal-year  -->
<div class="row">
    <!-- Title -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('title', __('labels.title'), ['class' => 'form-label required']) !!}
            {!! Form::text('title', $page == 'create'? old('title') : $costCenter->title,
            ['class' => "form-control", "required ", "placeholder" => __('labels.title'),
            'data-msg-required' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('title'))
                <div class="help-block red">{{$errors->first('title') }}</div>
            @endif
        </div>
    </div>

    <!-- Title Bang la -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('title_bangla', __('accounts::cost-center.bangla_title'), ['class' => 'form-label required']) !!}
            {!! Form::text('title_bangla', $page == 'create'? old('title_bangla') : $costCenter->title_bangla,
            ['class' => "form-control", "required ", "placeholder" => __('accounts::cost-center.bangla_title'),
            'data-msg-required' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('title_bangla'))
                <div class="help-block red">{{$errors->first('title_bangla') }}</div>
            @endif
        </div>
    </div>

    <!-- Economy Code -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('code', __('labels.code'), ['class' => 'form-label required']) !!}
            {!! Form::select('code', $economyCodes, $page == 'create'? old('code') : $costCenter->code,
            ['class' => "form-control select2", "required ",
            'data-msg-required' => trans('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('code'))
                <div class="help-block red">{{$errors->first('code') }}</div>
            @endif
        </div>
    </div>

    <!-- Sequence -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('sequence', __('labels.sequence'), ['class' => 'form-label required']) !!}
            {!! Form::text('sequence', $page == 'create'? old('sequence') : $costCenter->sequence,
            ['class' => "form-control", "required ", "placeholder" => __('labels.sequence'),
            'data-msg-required' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('sequence'))
                <div class="help-block red">{{$errors->first('sequence') }}</div>
            @endif
        </div>
    </div>
</div>


<!-- Save / Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>{{ trans('labels.save') }}
    </button>
    <a class="btn btn-info mr-1" role="button"
       href="{{url(route('cost-centers.index'))}}">
        <i class="ft ft-list"></i> @lang('accounts::cost-center.index')
    </a>
</div>
{!! Form::close() !!}