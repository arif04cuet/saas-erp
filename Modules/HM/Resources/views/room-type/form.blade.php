@if($page == 'create')
    {!! Form::open(['route' =>  'room-types.create', 'class' => 'form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => [ 'room-types.update', $roomType->id]]) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la  la-building-o"></i>{{trans('hm::roomtype.create_form_title')}}</h4>
<div class="row">
    <!-- name -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', __('labels.name'), ['class' => 'form-label required']) !!}
            {!! Form::text('name', $page == 'create' ? old('name') : $roomType->name, [
                'class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''),
                'required',
                "placeholder" => "e.g AC Single",
                'data-validation-required-message' => trans('validation.required', ['attribute' => __('labels.name')])
            ]) !!}
            <div class="help-block"></div>
            @if ($errors->has('name'))
                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>
    <!-- bangla name -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('bangla_name',  trans('labels.bangla_name'), ['class' => 'form-label required']) !!}
            {!! Form::text('bangla_name', isset($roomType) ? $roomType->bangla_name : null, [
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

<div class="row">
    <!-- capacity -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('capacity') ? ' error' : '' }}">
            {!! Form::label('capacity', __('hm::roomtype.capacity'), ['class' => 'form-label required']) !!}
            {!! Form::number('capacity', $page == 'create' ? old('capacity') : $roomType->capacity, [
                'class' => 'form-control'.($errors->has('capacity') ? ' is-invalid' : ''),
                'required',
                'min' => '1',
                "placeholder" => "e.g 4",
                'data-validation-required-message' => trans('validation.required', ['attribute' => __('hm::roomtype.capacity')]),
                'data-validation-number-message' => trans('validation.numeric', ['attribute' => __('hm::roomtype.capacity')]),
                'data-validation-min-message' => trans('validation.min.numeric', ['attribute' => __('hm::roomtype.capacity')]),
            ]) !!}
            <div class="help-block"></div>
            @if ($errors->has('capacity'))
                <span class="invalid-feedback">{{ $errors->first('capacity') }}</span>
                </span>
            @endif
        </div>
    </div>
    <!-- checkbox -->
    <div class="col-md-6">
        <div class="skin skin-flat">
            <fieldset>
                {!!
                    Form::label('seat_wise_calculation',
                    trans('hm::roomtype.seat_wise_calculation'))
                !!}
                {!! Form::checkbox('seat_wise_calculation',1, false ,[(isset($roomType->seat_wise_calculation) && ($roomType->seat_wise_calculation))  ? 'checked' : ''])!!}
            </fieldset>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('government_official_rate') ? ' error' : '' }}">
            {!! Form::label('government_official_rate', __('hm::roomtype.government_official_rate'), ['class' => 'form-label required']) !!}

            {!! Form::number('government_official_rate', $page == 'create' ? old('government_official_rate') : $roomType->government_official_rate, [
                'class' => 'form-control'.($errors->has('government_official_rate') ? ' is-invalid' : ''),
                'required',
                'min' => '1',
                "placeholder" => "e.g 500",
                'data-validation-required-message' => trans('validation.required', ['attribute' => __('hm::roomtype.government_official_rate')]),
                'data-validation-number-message' => trans('validation.numeric', ['attribute' => __('hm::roomtype.government_official_rate')]),
                'data-validation-min-message' => trans('validation.min.numeric)', ['attribute' => __('hm::roomtype.government_official_rate')]),
            ]) !!}
            <div class="help-block"></div>
            @if ($errors->has('government_official_rate'))
                <span class="invalid-feedback">{{ $errors->first('government_official_rate') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('government_personal_rate', __('hm::roomtype.government_personal_rate'), ['class' => 'form-label required']) !!}
            {!! Form::number('government_personal_rate', $page == 'create' ? old('government_personal_rate') : $roomType->government_personal_rate, [
                'class' => 'form-control'.($errors->has('government_personal_rate') ? ' is-invalid' : ''),
                'required',
                'min' => '1',
                "placeholder" => "e.g 500",
                'data-validation-required-message' => trans('validation.required', ['attribute' => __('hm::roomtype.government_personal_rate')]),
                'data-validation-number-message' => trans('validation.numeric', ['attribute' => __('hm::roomtype.government_personal_rate')]),
                'data-validation-min-message' => trans('validation.min.numeric)', ['attribute' => __('hm::roomtype.government_personal_rate')]),
            ]) !!}
            <div class="help-block"></div>
            @if ($errors->has('government_personal_rate'))
                <span class="invalid-feedback">{{ $errors->first('government_personal_rate') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('non_government_rate', __('hm::roomtype.non_government_rate'), ['class' => 'form-label required']) !!}
            {!! Form::number('non_government_rate', $page == 'create' ? old('non_government_rate') : $roomType->non_government_rate, [
                'class' => 'form-control'.($errors->has('non_government_rate') ? ' is-invalid' : ''),
                'required',
                'min' => '1',
                "placeholder" => "e.g 500",
                'data-validation-required-message' => trans('validation.required', ['attribute' => __('hm::roomtype.non_government_rate')]),
                'data-validation-number-message' => trans('validation.numeric', ['attribute' => __('hm::roomtype.non_government_rate')]),
                'data-validation-min-message' => trans('validation.min.numeric)', ['attribute' => __('hm::roomtype.non_government_rate')]),
            ]) !!}
            <div class="help-block"></div>
            @if ($errors->has('non_government_rate'))
                <span class="invalid-feedback">{{ $errors->first('non_government_rate') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('international_rate', __('hm::roomtype.international_rate'), ['class' => 'form-label required']) !!}
            {!! Form::number('international_rate', $page == 'create' ? old('international_rate') : $roomType->international_rate, [
                'class' => 'form-control'.($errors->has('international_rate') ? ' is-invalid' : ''),
                'required',
                'min' => '1',
                "placeholder" => "e.g 500",
                'data-validation-required-message' => trans('validation.required', ['attribute' => __('hm::roomtype.international_rate')]),
                'data-validation-number-message' => trans('validation.numeric', ['attribute' => __('hm::roomtype.international_rate')]),
                'data-validation-min-message' => trans('validation.min.numeric)', ['attribute' => __('hm::roomtype.international_rate')]),
            ]) !!}
            <div class="help-block"></div>
            @if ($errors->has('international_rate'))
                <span class="invalid-feedback">{{ $errors->first('international_rate') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('bard_rate', __('hm::roomtype.bard_rate'), ['class' => 'form-label required']) !!}
            {!! Form::number('bard_rate', $page == 'create' ? old('bard_rate') : $roomType->bard_rate, [
                'class' => 'form-control'.($errors->has('bard_rate') ? ' is-invalid' : ''),
                'required',
                'min' => '1',
                "placeholder" => "e.g 500",
                'data-validation-required-message' => trans('validation.required', ['attribute' => __('hm::roomtype.bard_rate')]),
                'data-validation-number-message' => trans('validation.numeric', ['attribute' => __('hm::roomtype.bard_rate')]),
                'data-validation-min-message' => trans('validation.min.numeric)', ['attribute' => __('hm::roomtype.bard_rate')]),
            ]) !!}
            <div class="help-block"></div>
            @if ($errors->has('bard_rate'))
                <span class="invalid-feedback">{{ $errors->first('bard_rate') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('others_rate', __('hm::roomtype.other_rate'), ['class' => 'form-label required']) !!}
            {!! Form::number('others_rate', $page == 'create' ? old('others_rate') : $roomType->others_rate, [
                'class' => 'form-control'.($errors->has('others_rate') ? ' is-invalid' : ''),
                'required',
                'min' => '1',
                "placeholder" => "e.g 500",
                'data-validation-required-message' => trans('validation.required', ['attribute' => __('hm::roomtype.other_rate')]),
                'data-validation-number-message' => trans('validation.numeric', ['attribute' => __('hm::roomtype.other_rate')]),
                'data-validation-min-message' => trans('validation.min.numeric)', ['attribute' => __('hm::roomtype.other_rate')]),
            ]) !!}
            <div class="help-block"></div>
            @if ($errors->has('others_rate'))
                <span class="invalid-feedback">{{ $errors->first('others_rate') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>{{$page == 'create' ? __('labels.save') : __('labels.update')}}
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{url(route('room-types.index'))}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
<h5>{{trans('labels.note')}}</h5>
<p>** {{trans('labels.currency')}} {{trans('labels.bdt')}}</p>
