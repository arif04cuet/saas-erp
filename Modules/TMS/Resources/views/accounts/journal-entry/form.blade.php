<div class="col">
    <!-- Date  and  Journal Dropdown -->
    <div class="row">
        <!-- Date  -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('date', trans('labels.date'), ['class' => 'form-label required']) !!}
                {{
                       Form::text('date', old('date') ?? date('Y-m-d'), [
                            'class' => 'form-control form-control-sm required',
                            'placeholder'=>trans('labels.select'),
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('date'))
                <div class="help-block text-danger">
                    {{ $errors->first('date') }}
                </div>
            @endif
        </div>

        <!-- Fiscal Year  -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('fiscal_year_id', trans('accounts::fiscal-year.title'),
                    ['class' => 'form-label required'])
                !!}
                {!! Form::select('fiscal_year_id', $fiscalYears, old('fiscal_year_id') ?? $activeFiscalYear->id,
                ['class' => "form-control form-control-sm select2 required", "placeholder" => trans('labels.select'),
                'data-msg-required'=> __('labels.This field is required')
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('fiscal_year_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('fiscal_year_id') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Title and Training Dropdown -->
    <div class="row">
        <!-- Title -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('title', trans('labels.title'), ['class' => 'form-label required']) !!}
                {!! Form::text('title', old('title') ?? null,
                ['class' => "form-control form-control-sm required", "placeholder" => trans('accounts::journal.entry.reference'),
                'data-rule-maxlength' => 50,  'data-msg-required' => trans('labels.This field is required'),
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('title'))
                    <div class="help-block text-danger">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Training -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('training_id',trans('tms::training.title'), ['class' => 'form-label required']) !!}
                {!! Form::select('training_id', $trainings, old('training_id') ?? null,
                [
                    'class' => "form-control form-control-sm training-select select2 required",
                    'placeholder'=>trans('labels.select'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'onchange'=> 'getMaxValues(this)'
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('training_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('training_id') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

{{--    <!-- advance payment part -->--}}
{{--    <div class="form-group">--}}
{{--        <div class="skin skin-flat">--}}
{{--            {{ Form::checkbox('is_advance_payment', 1,false)  }}--}}
{{--            <label--}}
{{--                class="">@lang('accounts::journal.entry.advance_payment.title')--}}
{{--            </label>--}}
{{--            <!-- advance payment options -->--}}
{{--            <div class="radio-options">--}}
{{--                <div class="row">--}}
{{--                    <!-- Advance Payment Radio Buttons  -->--}}
{{--                    <div class="form-group col-md-6 col-xl-6">--}}

{{--                        <div class="row">--}}
{{--                            <!--  Advance Payment -->--}}
{{--                            <div class="col-md-auto">--}}
{{--                                <div class="skin skin-flat">--}}
{{--                                    {!! Form::radio('advance_entry', 'advance_payment',null,--}}
{{--                                            [--}}
{{--                                                'class' => 'required',--}}
{{--                                                 'data-msg-required'=>trans('labels.This field is required')--}}
{{--                                            ])--}}
{{--                                     !!}--}}
{{--                                    <label--}}
{{--                                        for="advance_entry">--}}
{{--                                        @lang('accounts::journal.entry.advance_payment.radio_button.payment')--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="radio-error"></div>--}}
{{--                            </div>--}}
{{--                            <!-- Payment Adjustment -->--}}
{{--                            <div class="col-md-auto">--}}
{{--                                <div class="skin skin-flat">--}}
{{--                                    {!! Form::radio('advance_entry', 'advance_adjustment', null,--}}
{{--                                            [--}}
{{--                                                'class' => 'required radio-advance-entry',--}}
{{--                                                 'data-msg-required'=>trans('labels.This field is required')--}}
{{--                                            ])--}}
{{--                                     !!}--}}
{{--                                    <label--}}
{{--                                        for="advance_entry">--}}
{{--                                        @lang('accounts::journal.entry.advance_payment.radio_button.adjustment')--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="radio-error"></div>--}}
{{--                            </div>--}}
{{--                            <!-- error message -->--}}
{{--                            @if ($errors->has('advance_entry'))--}}
{{--                                <div class="help-block text-danger">--}}
{{--                                    {{ $errors->first('advance_entry') }}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Employee Dropdown  -->--}}
{{--                    <div class="col-6">--}}
{{--                        <div class="form-group employee-dropdown">--}}
{{--                            {!! Form::label('employee_id', trans('accounts::journal.entry.table.employee'),--}}
{{--                                ['class' => 'form-label required'])--}}
{{--                            !!}--}}
{{--                            {!! Form::select('employee_id', $employees, null,--}}
{{--                            [--}}
{{--                                'class' => "form-control select-employee select2 required",--}}
{{--                                "placeholder" => trans('accounts::journal.entry.table.employee'),--}}
{{--                                "data-msg-required" => trans('labels.This field is required'),--}}
{{--                            ])--}}
{{--                            !!}--}}
{{--                            <div class="help-block"></div>--}}
{{--                            <!-- error message -->--}}
{{--                            @if ($errors->has('employee_id'))--}}
{{--                                <div class="help-block text-danger">--}}
{{--                                    {{ $errors->first('employee_id') }}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}


</div>
<!--/General Information -->

<!-- Journal entry detail -->
@include('tms::accounts.journal-entry.form-repeater')


<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="master btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="master btn btn-warning mr-1" role="button" href="{{route('tms.journal-entries.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

