<div class="form-body">
    {{-- <div class="col"> --}}
        <!-- Training English & Bangla Name -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">

                    <label for="start_date"
                            class="form-label required">{{trans('tms::training_year.start_date')}}</label>
                    <div id="start-date-container" class="date-container"></div>
                    {!! Form::text('start_date', isset($trainingYear) ?
                    \Carbon\Carbon::parse($trainingYear->start_date)->format('j F Y') : null,
                    [
                        'class' => 'form-control form-control-sm dateField required',
                        'data-msg-required' => trans('labels.This field is required'),
                        'placeholder' => 'Pick Date',
                        'id' => 'start_date',
                    ]) !!}

                    <div class="help-block"></div>
                    @if ($errors->has('start_date'))
                        <p class="text-danger">{{ $errors->first('start_date') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date"
                           class="form-label required">{{trans('tms::training_year.end_date')}}</label>
                    <div id="end-date-container" class="date-container"></div>
                    {!! Form::text('end_date',isset($trainingYear) ?
                    \Carbon\Carbon::parse($trainingYear->end_date)->format('j F Y') : null,
                    [
                        'class' => 'form-control form-control-sm dateField required',
                        'data-msg-required' => trans('labels.This field is required'),
                        'placeholder' => 'Pick Date',
                        'id' => 'end_date',
                         'data-msg-greaterThan' =>  trans('labels.greaterThan', ['name' => trans('hrm::appraisal.start_date')])
                    ]) !!}

                    <div class="help-block"></div>
                    @if ($errors->has('end_date'))
                        <p class="text-danger">{{ $errors->first('end_date') }}</p>
                    @endif
                </div>
            </div>
        </div>
    {{-- </div> --}}

</div>

<div class="form-actions mb-lg-3">
    <button type="submit" class="master btn btn-primary pull-left">
        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
    </button>
</div>

