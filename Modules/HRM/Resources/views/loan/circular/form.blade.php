@if ($page == 'create')
    {!! Form::open(['route' => 'loan-circulars.store', 'class' => 'form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => ['loan-circulars.update', $circular->id], 'class' => 'form', 'novalidate', 'method' => 'PUT']) !!}
@endif
<div class="form-body">
    <h4 class="form-section"><i class="ft-user"></i> @lang('hrm::complaint.create') @lang('labels.form')</h4>
    <div class="row">


        <div class="col-6">
            <label class="form-label required">
                @lang('hrm::employee.loan.circular.loan_circular_title')
            </label>

            {{ Form::text('title', $page == 'create' ? null : $circular->title, [
    'class' => 'form-control required',
    'required',
    'data-msg-required' => trans('labels.This field is required'),
]) }}
            <div class="help-block"></div>
            @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-6">
            <label class="form-label required">
                @lang('hrm::employee.loan.circular.reference_no')
            </label>

            {{ Form::text('reference_no', $page == 'create' ? null : $circular->reference_no, [
    'class' => 'form-control required',
    'required',
    'data-msg-required' => trans('labels.This field is required'),
]) }}
            <div class="help-block"></div>
            @if ($errors->has('reference_no'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('reference_no') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('circular_date', __('hrm::employee.loan.circular.circular_date'), ['class' => 'form-label required']) !!}
                {!! Form::text('circular_date', $page == 'create' ? null : \Carbon\Carbon::parse($circular->circular_date)->format('d F, Y'), [
    'class' => 'form-control pickadate',
    'placeholder' => __('labels.pick_a_date'),
    'required',
    'data-msg-required' => trans('labels.This field is required'),
]) !!}
                @if ($errors->has('circular_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('circular_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('last_date_of_application', __('hrm::employee.loan.circular.last_date_of_application'), ['class' => 'form-label required']) !!}
                {!! Form::text('last_date_of_application', $page == 'create' ? null : \Carbon\Carbon::parse($circular->last_date_of_application)->format('d F, Y'), [
    'class' => 'form-control pickadate',
    'required',
    'placeholder' => __('labels.pick_a_date'),
    'data-msg-required' => trans('labels.This field is required'),
]) !!}
                @if ($errors->has('last_date_of_application'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('last_date_of_application') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('details', __('labels.details'), ['class' => 'form-label required']) !!}

                {!! Form::text('details', $page == 'create' ? null : $circular->details, [
    'class' => 'form-control tinymce',
]) !!}
                <div class="help-block"></div>
                @if ($errors->has('details'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('details') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <i class="ft-check-square"></i> {{ trans('labels.save') }}
        </button>
        <button class="btn btn-warning" type="button" onclick="window.location = '{{ route('complaint.index') }}'">
            <i class="ft-x"></i> {{ trans('labels.cancel') }}
        </button>
    </div>
</div>
{!! Form::close() !!}
