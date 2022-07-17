<div class="card-body">
    @if ($page == 'create')
        {!! Form::open(['route' => 'publication-organizations.store', 'class' => 'form organization-form']) !!}
    @else
        {!! Form::open(['route' => ['publication-organizations.update', $organizations->id], 'class' => 'form organization-form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('publication::organization.organization_form')
            @lang('labels.form')
        </h4>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (English)', trans('publication::organization.name_en'), ['class' => 'form-label required']) !!}
                    {!! Form::text('name_en', $page == 'edit' ? $organizations->name_en : null, ['class' => 'form-control required', 'placeholder' => trans('cafeteria::unit.english_name'), 'data-msg-required' => __('labels.This field is required'), 'data-rule-maxlength' => 50, 'data-msg-maxlength' => trans('labels.At most 50 characters')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('name_en'))
                        <span class="invalid-feedback">{{ $errors->first('name_en') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (Bangla)', trans('publication::organization.name_bn'), ['class' => 'form-label required']) !!}
                    {!! Form::text('name_bn', $page == 'edit' ? $organizations->name_bn : null, ['class' => 'form-control required', 'placeholder' => trans('cafeteria::unit.bangla_name'), 'data-msg-required' => __('labels.This field is required'), 'data-rule-maxlength' => 50, 'data-msg-maxlength' => trans('labels.At most 50 characters')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('name_bn'))
                        <span class="invalid-feedback">{{ $errors->first('name_bn') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('employee_id', trans('accounts::employee-contract.employee_name'), ['class' => 'form-label']) !!}
                    {!! Form::select('organization_head', $employees, $page === 'create' ? old('organization_head') : $organizations->organization_head, ['class' => 'form-control select2 ']) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('organization_head'))
                        <span class="help-block danger">{{ $errors->first('organization_head') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Remark', trans('publication::organization.activation'), ['class' => 'form-label required']) !!}

                    @if (Route::current()->getName() == 'publication-organizations.edit')
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1"
                                value="active" {{ $organizations->status == 'active' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexRadioDefault1">
                                @lang('publication::organization.active')
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"
                                value="inactive" {{ $organizations->status == 'inactive' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexRadioDefault2">
                                @lang('publication::organization.inactive')
                            </label>
                        </div>

                    @else

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1"
                                value="active" required>
                            <label class="form-check-label" for="flexRadioDefault1">
                                @lang('publication::organization.active')
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"
                                value="inactive">
                            <label class="form-check-label" for="flexRadioDefault2">
                                @lang('publication::organization.inactive')
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
        <a class="btn btn-warning mr-1" role="button" href="{{ route('publication-organizations.index') }}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
