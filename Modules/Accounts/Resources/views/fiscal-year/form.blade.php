@if($page == 'create')
    {!! Form::open(['route' =>  'fiscal-year.store', 'class' => 'form fiscal-year-form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => [ 'fiscal-year.update', $fiscalYear->id], 'class' => 'fiscal-year-form']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::fiscal-year.title')</h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('start', trans('labels.start'), ['class' => 'form-label required']) !!}
            <div class="input-group">
                {!! Form::text('start', $page == 'create' ? old('start') : $fiscalYear->start, ['class' => 'form-control pickadate'.($errors->has('start') ? ' is-invalid' : ''), 'required',
                    'data-validation-required-message'=>trans('validation.required', ['attribute' => trans('labels.start')])]) !!}
                <div class="help-block"></div>
                @if ($errors->has('start'))
                    <span class="invalid-feedback">{{ $errors->first('start') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('end', trans('labels.end'), ['class' => 'form-label required']) !!}
            <div class="input-group">
                {!! Form::text('end', $page == 'create' ? old('end') : $fiscalYear->end, ['class' => 'form-control pickadate'.($errors->has('end') ? ' is-invalid' : ''), 'required',
                    'data-validation-required-message'=>trans('validation.required', ['attribute' => trans('labels.end')])]) !!}
                <div class="help-block"></div>
                @if ($errors->has('end'))
                    <span class="invalid-feedback">{{ $errors->first('end') }}</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>{{$page == 'create' ? trans('labels.save') : trans('labels.update')}}
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{url(route('fiscal-year.index'))}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
