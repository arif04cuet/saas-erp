@component('tms::training.partials.components.edit_layout', ['training' => $training])
    {{-- @if ($trainingStatus != \Modules\TMS\Entities\Training::getStatuses()['draft'] && $trainingStatus != \Modules\TMS\Entities\Training::getStatuses()['upcoming'])
        <div class="alert alert-danger text-center" role="alert">
            @lang('tms::training.flash_messages.timeline_change')
        </div>
    @else --}}
    {!! Form::open([
    'route' => ['training.durationDeadline.update', $training],
    'class' => 'form wizard-circle training-form',
    'novalidate',
    'method' => 'put',
]) !!}
    <div class="form-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="training_start_date"
                        class="form-label required">{{ trans('tms::training.start_date') }}</label>
                    {!! Form::text('start_date', \Carbon\Carbon::parse($training->start_date)->format('j F Y'), [
    'class' => 'form-control',
    'required' => 'required',
    'data-msg-required' => trans('labels.This field is required'),
    'placeholder' => 'Pick Date',
    'id' => 'training_start_date',
    'onchange' => 'dateDifference()',
]) !!}

                    <div class="help-block"></div>
                    @if ($errors->has('start_date'))
                        <p class="text-danger">{{ $errors->first('start_date') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="training_end_date"
                        class="form-label required">{{ trans('tms::training.end_date') }}</label>
                    {!! Form::text('end_date', \Carbon\Carbon::parse($training->end_date)->format('j F Y'), [
    'class' => 'form-control',
    'required' => 'required',
    'data-msg-required' => trans('labels.This field is required'),
    'placeholder' => 'Pick Date',
    'id' => 'training_end_date',
    'onchange' => 'dateDifference()',
]) !!}

                    <div class="help-block"></div>
                    @if ($errors->has('end_date'))
                        <p class="text-danger">{{ $errors->first('end_date') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="training_len" class="form-label">{{ trans('tms::training.training_period') }}</label>
                    {!! Form::text('training_len', null, [
    'id' => 'training_len',
    'class' => 'form-control',
    'readonly',
]) !!}

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="training_start_date" class="form-label required">@lang('tms::training.registration_deadline')</label>
                    {!! Form::text('registration_deadline', \Carbon\Carbon::parse($training->registration_deadline)->format('j F Y'), [
    'class' => 'form-control',
    'required' => 'required',
    'data-msg-required' => trans('labels.This field is required'),
    'placeholder' => 'Pick Date',
    'id' => 'registration_deadline',
]) !!}

                    <div class="help-block"></div>
                    @if ($errors->has('registration_deadline'))
                        <p class="text-danger">{{ $errors->first('registration_deadline') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions mb-lg-3">
        <a class="btn btn-warning pull-right" role="button"
            href="{{ url('/tms/training/') . '/' . $training->id . '/duration' }}" style="margin-left: 2px;">
            <i class="la la-times"></i> {{ trans('labels.cancel') }}
        </a>
        <button type="submit" class="btn btn-primary pull-right">
            <i class="la la-check-square-o"></i> {{ trans('labels.save') }}
        </button>
    </div>
    {!! Form::close() !!}
    {{-- @endif --}}
@endcomponent
