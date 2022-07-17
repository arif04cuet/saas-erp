@if($page == 'create')
    {!! Form::open(['route' =>  'economy-sectors.store', 'class' => 'form economy-code-form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => [ 'economy-sectors.update', $economySector->id], 'class' => 'economy-code-form']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::accounts.sector.form')</h4>
<div class="row">
    <!-- Parent Economy Code -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('parent_economy_code', trans('accounts::accounts.sector.parent_code'), ['class' => 'form-label required']) !!}
            {!! Form::select('parent_economy_code', $economyCodes, $page === 'create' ? null :
$economySector->parent_economy_code, ['class'=>'form-control economy-head-select required']) !!}
            <div class="help-block"></div>
            @if ($errors->has('parent_economy_code'))
                <span class="invalid-feedback">{{ $errors->first('parent_economy_code') }}</span>
            @endif
        </div>
    </div>

    <!-- Economy Head -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('code', trans('labels.code'), ['class' => 'form-label required']) !!}
            <div class=" input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="code_prefix">
                        {{$page == 'edit'? substr($economySector->code, 0, 7) : '...'}}
                    </span>
                </div>
                {!! Form::number('code', $page == 'create' ? old('code') : substr($economySector->code, -2),
['class' => 'form-control'.($errors->has('code') ? ' is-invalid' : ''), 'required', 'maxlength' => 2, "placeholder" =>
"e.g 01", 'data-validation-maxlength-message' => __('validation.maxlength', ['attribute' => __('labels.code'), 'max'
=> \App\Utilities\EnToBnNumberConverter::en2bn(2)]),
               'data-validation-required-message'=>trans('validation.required', ['attribute' => __('labels.code')])]) !!}
            </div>
            <div class="help-block"></div>
            @if ($errors->has('code'))
                <span class="invalid-feedback">{{ $errors->first('code') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <!-- English Name -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('title', trans('labels.name') .' (English)', ['class' => 'form-label required']) !!}
            {!! Form::text('title', $page == 'create' ? old('english_name') : $economySector->title,
['class' => 'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'required',
            "placeholder" => "e.g Office Furniture", 'data-validation-required-message'=>trans('validation.required', ['attribute' => trans('labels.name')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('title'))
                <span class="invalid-feedback">{{ $errors->first('title') }}</span>
            @endif
        </div>
    </div>
    <!-- Bangla Name -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('title_bangla', trans('labels.name') .' (বাংলা)', ['class' => 'form-label required']) !!}
            {!! Form::text('title_bangla', $page == 'create' ? old('bangla_name') : $economySector->title_bangla, ['class' => 'form-control'.($errors->has('bangla_name') ? ' is-invalid' : ''), 'required',
            "placeholder" => "উদাঃ অফিস সরঞ্জামাদি", 'data-validation-required-message'=>trans('validation.required', ['attribute' => trans('labels.name')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('title_bangla'))
                <span class="invalid-feedback">{{ $errors->first('title_bangla') }}</span>
            @endif
        </div>
    </div>
</div>

<!-- Description -->
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('description', trans('labels.description'), ['class' => 'form-label']) !!}
            {!! Form::textarea('description', $page == 'create' ? old('description') : $economySector->description, ['rows' => '2', 'class' => 'form-control'.($errors->has('description') ? ' is-invalid' : ''),
            "placeholder" => trans('labels.description')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('description'))
                <span class="invalid-feedback">{{ $errors->first('description') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>{{$page == 'create' ? trans('labels.save') : trans('labels.update')}}
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{url(route('economy-code.index'))}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}

@push('page-js')
    <script>
        $("#parent_economy_code").change(function () {
            $("#code_prefix").html($(this).val());
        });
    </script>
@endpush
