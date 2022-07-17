<div class="card-body">
    @if ($page == 'create')
        {!! Form::open(['route' => 'publication-presses.store', 'class' => 'form press-form']) !!}
    @else
        {!! Form::open(['route' => ['publication-presses.update', $presses->id], 'class' => 'form press-form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('publication::press.press_form') @lang('labels.form')
        </h4>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (English)', trans('publication::press.name_en'), ['class' => 'form-label required']) !!}
                    {!! Form::text('press_name_en', $page == 'edit' ? $presses->press_name_en : null, ['class' => 'form-control required', 'placeholder' => trans('cafeteria::unit.english_name'), 'data-msg-required' => __('labels.This field is required'), 'data-rule-maxlength' => 50, 'data-msg-maxlength' => trans('labels.At most 50 characters')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('press_name_en'))
                        <span class="invalid-feedback">{{ $errors->first('press_name_en') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (Bangla)', trans('publication::press.name_bn'), ['class' => 'form-label required']) !!}
                    {!! Form::text('press_name_bn', $page == 'edit' ? $presses->press_name_bn : null, ['class' => 'form-control required', 'placeholder' => trans('cafeteria::unit.bangla_name'), 'data-msg-required' => __('labels.This field is required'), 'data-rule-maxlength' => 50, 'data-msg-maxlength' => trans('labels.At most 50 characters')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('press_name_bn'))
                        <span class="invalid-feedback">{{ $errors->first('press_name_bn') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (English)', trans('publication::press.address'), ['class' => 'form-label ']) !!}
                    {!! Form::text('address', $page == 'edit' ? $presses->address : null, ['class' => 'form-control', 'placeholder' => trans('publication::press.address'), 'data-rule-maxlength' => 50, 'data-msg-maxlength' => trans('labels.At most 50 characters')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('address'))
                        <span class="invalid-feedback">{{ $errors->first('address') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (Bangla)', trans('publication::press.contact_number'), ['class' => 'form-label ']) !!}
                    {!! Form::number('contact_number', $page == 'edit' ? $presses->contact_number : null, ['class' => 'form-control ', 'placeholder' => '017XXXXXXXX', 'data-msg-required' => trans('labels.This field is required'), 'data-rule-number' => 'true', 'data-msg-number' => trans('labels.Please enter a valid number'), 'data-rule-minlength' => '11', 'data-msg-minlength' => trans('validation.minlength', ['attribute' => __('labels.mobile'), 'min' => 11]), 'data-rule-maxlength' => '11', 'data-msg-maxlength' => trans('validation.maxlength', ['attribute' => __('labels.mobile'), 'max' => 11])]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('contact_number'))
                        <span class="invalid-feedback">{{ $errors->first('contact_number') }}</span>
                    @endif
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('employee_id', trans('accounts::employee-contract.employee_name'), ['class' => 'form-label']) !!}
                    {!! Form::select('press_user_id', $employees, $page === 'create' ? old('press_user_id') : $presses->press_user_id, ['class' => 'form-control select2 required']) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('press_user_id'))
                        <span class="help-block danger">{{ $errors->first('press_user_id') }}</span>
                    @endif
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Remark', trans('publication::press.activation'), ['class' => 'form-label required']) !!}

                    @if (Route::current()->getName() == 'publication-presses.edit')
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1"
                                value="active" {{ $presses->status == 'active' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexRadioDefault1">
                                @lang('publication::press.active')
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"
                                value="inactive" {{ $presses->status == 'inactive' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexRadioDefault2">
                                @lang('publication::press.inactive')
                            </label>
                        </div>

                    @else

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1"
                                value="active" required>
                            <label class="form-check-label" for="flexRadioDefault1">
                                @lang('publication::press.active')
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"
                                value="inactive">
                            <label class="form-check-label" for="flexRadioDefault2">
                                @lang('publication::press.inactive')
                            </label>
                        </div>

                    @endif

                    <div class="help-block"></div>
                    @if ($errors->has('remark'))
                        <span class="invalid-feedback">{{ $errors->first('remark') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn {{ $page == 'edit' ? 'btn-primary' : 'btn-success' }}">
            <i class="ft-check-square"></i>
            @lang('labels.save')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{ route('publication-presses.index') }}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
