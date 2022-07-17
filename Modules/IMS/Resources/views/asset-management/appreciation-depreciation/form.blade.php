@if($page == 'create')
    {{ Form::open(['route' =>  'appreciation-depreciation-records.store', 'class' => 'form', 'novalidate']) }}
@else
    {{ Form::open(['route' =>  ['appreciation-depreciation-records.update', $record->id], 'class' => 'form', 'novalidate']) }}
    @method('PUT')
@endif
{{--@if(!$errors->isEmpty())--}}
{{--    {{dd($errors)}}--}}
{{--@endif--}}
<h4 class="form-section"><i class="la la-building"></i> @lang('ims::appreciation-depreciation.form')</h4>
<div class="row">

    <!-- Items -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('inventory_item_id', __('ims::inventory.item.title'), ['class' => 'form-label required']) !!}
            {!! Form::select('inventory_item_id', $items, $page == 'create' ? (old('inventory_item_id') ?? $id) : $record->inventory_item_id,
            ['class' => "form-control searchable", "required ",
            'data-validation-required-message' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('journal_id'))
                <div class="help-block text-danger">
                    <strong>{{ $errors->first('journal_id') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <!-- Evaluation Date -->
    <div class="col-3">
        <div class="form-group" id="date_root">
            {!! Form::label('evaluation_date', __('ims::appreciation-depreciation.date'), ['class' => 'form-label required']) !!}
            {!! Form::text('evaluation_date', $page == 'create' ? old('evaluation_date') : $record->evaluation_date,
                ['class' => "form-control pickadate", "placeholder" => __('labels.date'),
                'data-validation-required-message' => __('labels.This field is required')])
             !!}
            <div class="help-block"></div>
            @if ($errors->has('evaluation_date'))
                <div class="help-block text-danger">
                    <strong>{{ $errors->first('evaluation_date') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <!-- Evaluation Type -->
    <div class="form-group col-md-3">

        {!! Form::label('type', __('ims::appreciation-depreciation.evaluation_type'), ['class' => 'form-label required']) !!}
        <ul class="list-inline">
            @foreach(config('constants.asset_evaluation_types') ?? [] as $type)
                <li class="list-inline-item">
                    <div class="skin skin-flat">
                        {!! Form::radio('type', $type, $page == 'create' ? old('type') == $type  : $record->type == $type,
                            ['class' => 'required', 'id' => $type,
                            'data-validation-required-message' => trans('labels.This field is required')])
                        !!}
                        <label for="{{$type}}" class="form-label">
                            {{__('ims::appreciation-depreciation.evaluation_types.' . $type)}}
                        </label>
                    </div>
                </li>
                <li class="list-inline-item">&nbsp;</li>
            @endforeach
        </ul>

        <div class="help-block"></div>

        <div class="row col-md-12 radio-error">
            @if ($errors->has('is_default'))
                <div class="help-block text-danger"><strong>{{ $errors->first('is_default') }}</strong></div>
            @endif
        </div>
    </div>

    <!-- Value -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('value', __('ims::appreciation-depreciation.value'), ['class' => 'form-label required']) !!}
            {!! Form::number('value', $page == 'create' ? old('value') : $record->value,
           ['class' => "form-control", "required ", 'step' => '.01', 'maxlength' => 14, 'data-validation-min-min' => 0,
           'data-validation-min-message'=> __('validation.min.numeric',
           ['attribute' => __('ims::appreciation-depreciation.value'), 'min' => __('labels.digits.0')]),
           'data-validation-maxlength-message'=> __('labels.At most 14 characters'),
           'data-validation-number-message'=> __('validation.numeric', ['attribute' => __('ims::appreciation-depreciation.value')]),
           'data-validation-required-message' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('vat_percentage'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('vat_percentage') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <!-- Reason -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('reason', __('ims::appreciation-depreciation.reason'), ['class' => 'form-label required']) !!}
            {!! Form::textarea('reason', $page == 'create' ? old('remark') : $record->remark,
                ['class' => "form-control", "placeholder" => __('ims::appreciation-depreciation.reason'),
                'maxlength' => 1000, 'rows' => 3, 'data-validation-required-message' => __('labels.This field is required')])
             !!}
            <div class="help-block"></div>
            @if ($errors->has('reason'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('reason') }}</strong>
            </span>
            @endif
        </div>
    </div>

</div>

<div class="form-actions center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
    </button>
    <a class="btn btn-warning" role="button" href="{{ route('inventory-locations.index') }}"
       style="margin-left: 2px;">
        <i class="la la-times"></i> {{trans('labels.cancel')}}
    </a>
</div>
{{ Form::close() }}
