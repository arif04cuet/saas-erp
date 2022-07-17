<div class="card-body">
    @if ($page == 'create')
        {!! Form::open(['route' => 'publication-types.store', 'class' => 'form type-form']) !!}
    @else
        {!! Form::open(['route' => ['publication-types.update', $types->id], 'class' => 'form type-form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('publication::type.type_form') @lang('labels.form')</h4>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (English)', trans('publication::type.name_en'), ['class' => 'form-label required']) !!}
                    {!! Form::text('name_en', $page == 'edit' ? $types->name_en : null, ['class' => 'form-control required', 'placeholder' => trans('cafeteria::unit.english_name'), 'data-msg-required' => __('labels.This field is required'), 'data-rule-maxlength' => 50, 'data-msg-maxlength' => trans('labels.At most 50 characters')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('en_name'))
                        <span class="invalid-feedback">{{ $errors->first('en_name') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (Bangla)', trans('publication::type.name_bn'), ['class' => 'form-label required']) !!}
                    {!! Form::text('name_bn', $page == 'edit' ? $types->name_bn : null, ['class' => 'form-control required', 'placeholder' => trans('cafeteria::unit.bangla_name'), 'data-msg-required' => __('labels.This field is required'), 'data-rule-maxlength' => 50, 'data-msg-maxlength' => trans('labels.At most 50 characters')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('bn_name'))
                        <span class="invalid-feedback">{{ $errors->first('bn_name') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Remark', trans('publication::type.activation'), ['class' => 'form-label required']) !!}
                    @if (Route::current()->getName() == 'publication-types.edit')
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1"
                                value="active" {{ $types->status == 'active' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexRadioDefault1">
                                @lang('publication::type.active')
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"
                                value="inactive" {{ $types->status == 'inactive' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexRadioDefault2">
                                @lang('publication::type.inactive')
                            </label>
                        </div>

                    @else

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1"
                                value="active" required>
                            <label class="form-check-label" for="flexRadioDefault1">
                                @lang('publication::type.active')
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"
                                value="inactive">
                            <label class="form-check-label" for="flexRadioDefault2">
                                @lang('publication::type.inactive')
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
        <a class="btn btn-warning mr-1" role="button" href="{{ route('publication-types.index') }}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
