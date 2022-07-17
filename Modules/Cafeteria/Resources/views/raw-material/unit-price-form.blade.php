<!-- unit pricing category -->
<div class="col-md-12 mt-2 unit-price-category">
    @php
    $categories = Config::get('constants.cafeteria.unit_price');
    @endphp
    @if ($page == "edit" && count($rawMaterial->unitPrices) > 0)
    <div class="row">
        <div class="col-md-4">
            {!! Form::label('type',
                trans('cafeteria::raw-material.unit_price.title'),
                ['class' => 'form-label']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::label('price',
                trans('cafeteria::raw-material.unit_price.price'),
                ['class' => 'form-label required']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::label('vat',
                trans('cafeteria::raw-material.unit_price.vat'),
                ['class' => 'form-label required']) !!}
        </div>
        @foreach ($rawMaterial->unitPrices as $category)
        <div class="col-md-4 mb-1">
            {!! Form::text('category[]', $category->category,
                ['class' => 'form-control', 'readOnly']) !!}
        </div>

        <div class="col-md-4 mb-1">
            {!! Form::number('price[]', $category->price,
                ['class' => 'form-control price',
                'data-msg-required'=> __('labels.This field is required'),
                'min' => 1,
                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                'data-rule-maxlength' => 7,
                'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                'placeholder' => trans('cafeteria::raw-material.unit_price.price')]) !!}
        </div>

        <div class="col-md-4 mb-1">
            {!! Form::number('vat[]', $category->vat,
                ['class' => 'form-control price',
                'data-msg-required'=> __('labels.This field is required'),
                'min' => 0,
                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 0'),
                'data-rule-maxlength' => 7,
                'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                'placeholder' => trans('cafeteria::raw-material.unit_price.vat')]) !!}
        </div>

        <div>
            {!! Form::hidden('unit_price_id[]', $category->id) !!}
        </div>
        @endforeach
    </div>
    @else
    <div class="row">
        <div class="col-md-4">
            {!! Form::label('type',
                trans('cafeteria::raw-material.unit_price.title'),
                ['class' => 'form-label']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::label('price',
                trans('cafeteria::raw-material.unit_price.price'),
                ['class' => 'form-label required']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::label('vat',
                trans('cafeteria::raw-material.unit_price.vat'),
                ['class' => 'form-label required']) !!}
        </div>
        @foreach ($categories as $category)

        <div class="col-md-4 mb-1">
            {!! Form::text('category[]', $category,
                ['class' => 'form-control', 'readOnly']) !!}
        </div>

        <div class="col-md-4 mb-1">
            {!! Form::number('price[]', null,
                ['class' => 'form-control price',
                'data-msg-required'=> __('labels.This field is required'),
                'min' => 1,
                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                'data-rule-maxlength' => 7,
                'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                'placeholder' => trans('cafeteria::raw-material.unit_price.price')]) !!}
        </div>

        <div class="col-md-4 mb-1">
            {!! Form::number('vat[]', null,
                ['class' => 'form-control price',
                'data-msg-required'=> __('labels.This field is required'),
                'min' => 0,
                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 0'),
                'data-rule-maxlength' => 7,
                'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                'placeholder' => trans('cafeteria::raw-material.unit_price.vat')]) !!}
        </div>
        @endforeach
    </div>
    @endif
</div>