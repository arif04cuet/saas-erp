{!! Form::open(['route' =>  ['inventory-request.store.initial', $type], 'class' => 'form inventory-request-form', 'novalidate']) !!}

<h4 class="form-section">
    <i class="la la-tag"></i>
    @lang('ims::inventory.inventory_request_form_title', ['type' =>
__('ims::inventory.inventory_request_types.' . $type)])
</h4>
<div class="row">
    <div class="col-md-7">
        <div class="form-group">
            {!! Form::label('title', trans('ims::inventory.inventory_request_title'), ['class' => 'form-label required']) !!}
            {!! Form::hidden('type', $type) !!}
            {!! Form::text('title', old('title'),
                [
                    'class' => 'form-control'. ($errors->has('title') ? ' is-invalid' : ''),
                    "required",
                    "placeholder" => trans('ims::inventory.inventory_request_title'),
                    'data-validation-required-message' => trans('validation.required', ['attribute' => trans('ims::inventory.inventory_request_title')]),
                    'maxlength' => 100,
                ])
            !!}
            <div class="help-block"></div>
            @if ($errors->has('title'))
                <span class="invalid-feedback">{{ $errors->first('title') }}</span>
            @endif
        </div>
    </div>
    @if($employees['required'])
        <div class="col-md-5">
            <div class="form-group">
                {!! Form::label('receiver_id', trans('labels.receiver'), ['class' => 'form-label required']) !!}
                {!! Form::select('receiver_id',
                    ['' => ''] + $employees['options'],
                    null,
                    [
                        'class'=>'form-control select2 required' . ($errors->has('employee_id') ? ' is-invalid' : ''),
                        'required',
                        'data-validation-required-message' => trans('validation.required', ['attribute' => trans('labels.receiver')]),
                    ])
                !!}

                <div class="help-block"></div>
                @if ($errors->has('receiver_id'))
                    <span class="invalid-feedback">{{ $errors->first('receiver_id') }}</span>
                @endif
            </div>
        </div>
    @endif
</div>
@if($flags['is_location_visible'])
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('from_location_id', trans('ims::location.from_location'), ['class' => 'form-label required']) !!}

                {!! Form::select('from_location_id',
                    $fromLocations,
                    null,
                    [
                        'class'=>'form-control select required', 'required',
                        'data-validation-required-message' => trans('validation.required', ['attribute' => trans('ims::location.from_location')]),
                        'placeholder' => trans('labels.select')
                    ])
                !!}

                <div class="help-block"></div>
                @if ($errors->has('from_location_id'))
                    <span class="help-block text-danger">{{ $errors->first('from_location_id') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('to_location_id', trans('ims::location.to_location'), ['class' => 'form-label required']) !!}

                {!! Form::select('to_location_id',
                    $toLocations,
                    null,
                    [
                        'class' => 'form-control select required', 'required',
                        'data-validation-required-message' => trans('validation.required', ['attribute' => trans('ims::location.to_location')]),
                        'placeholder' => trans('labels.select')
                    ])
                !!}

                <div class="help-block"></div>
                @if ($errors->has('to_location_id'))
                    <span class="help-block text-danger">{{ $errors->first('to_location_id') }}</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Purpose of requisition -->
    <div class="form-group col-md-6">
        {!! Form::label('purpose', __('ims::inventory.inventory_request_purpose'), ['class' => 'form-label required']) !!}

        <ul class="list-inline">
            @foreach(config('constants.inventory_request_purposes') ?? [] as $purpose)
                <li class="list-inline-item">
                    <div class="skin skin-flat">
                        {!! Form::radio('purpose', $purpose, old('purpose') == $purpose,
                            ['class' => 'required', 'id' => $purpose,
                            'data-validation-required-message' => trans('labels.This field is required')])
                        !!}
                        <label for="{{$purpose}}">
                            {{__('ims::inventory.inventory_request_purposes.' . $purpose)}}
                        </label>
                    </div>
                </li>
                <li class="list-inline-item"></li>
            @endforeach

        </ul>
        <div class="help-block"></div>
        @if ($errors->has('purpose'))
            <div class="help-block text-danger"><strong>{{ $errors->first('purpose') }}</strong></div>
        @endif
    </div>
@else
    {!! Form::hidden('to_location_id', $flags['to_location_id']) !!}
@endif
<div class="form-actions text-center">
    <button type="submit" name="give_detail" value="1" class="btn btn-outline-primary">
        <i class="la la-chevron-right"></i> @lang('labels.save') @lang('labels.and') @lang('labels.next')
    </button>
    <button type="submit" name="give_detail" value="0" class="btn btn-primary">
        <i class="la la-check-square-o"></i> @lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{ route('inventory-request.index') }}">
        <i class="la la-close"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}

@push('page-js')
    <script>
        $('.select2').select2({
            placeholder: "{{__('labels.select')}}"
        });
    </script>
@endpush
