
<h4 class="form-section">
    <i class="la la-tag"></i>@lang('ims::inventory.inventory_request_title')
</h4>

<!-- Title and store Location -->
<div class="row">
    <!-- title -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('title', trans('ims::inventory.item.item_request.form_elements.title'), ['class' => 'form-label required']) !!}
            {!! Form::text('title', old('title') ?? null,
                 [
                    'class' => 'form-control required'. ($errors->has('title') ? ' is-invalid' : ''),
                    "placeholder" => trans('ims::inventory.item.item_request.form_elements.title'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-msg-maxlength' => trans('labels.max_length_validation_message',['length'=>500]),
                    'maxlength'=>500
                ])
            !!}
            <div class="help-block"></div>
            @if ($errors->has('title'))
                <span class="invalid-feedback">{{ $errors->first('title') }}</span>
            @endif
        </div>
    </div>
    <!-- store location -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('inventory_location_id', trans('ims::inventory.item.item_request.form_elements.location'), ['class' => 'form-label required']) !!}
            {!! Form::select('inventory_location_id',
                $locations ?? [],
                old('inventory_location_id') ?? null,
                [
                    'class'=>'form-control select2 inventory-location required' . ($errors->has('inventory_location_id') ? ' is-invalid' : ''),
                    'required',
                    'data-validation-required-message' => trans('labels.This field is required'),
                ])
            !!}
            <div class="help-block"></div>
            @if ($errors->has('inventory_location_id'))
                <span class="invalid-feedback">
                    {{ $errors->first('inventory_location_id') }}
                </span>
            @endif
        </div>
    </div>
</div>
<!-- Item Request Purpose  and Dynamic Dropdown -->
<div class="row">
    <!-- Trip Type -->
    <div class="col-6">
        {!! Form::label('purpose', trans('ims::inventory.item.item_request.form_elements.purpose'), ['class' => 'form-label required']) !!}
        <div class="radio-options">
            <div class="row">
                <div class="form-group col-12">
                    <div class="row">
                        @foreach($purposes as $purpose)
                            <div class="col-md-auto">
                                <div class="skin skin-flat">
                                    {!! Form::radio('purpose', $purpose,old('purpose') == $purpose ? 1 : 0,
                                            [
                                                'class' => 'required item-request-type',
                                                 'data-msg-required'=>trans('labels.This field is required')
                                            ])
                                     !!}
                                    <label
                                        for="type">
                                        @lang('ims::inventory.item.item_request.purpose.'.$purpose)
                                    </label>
                                </div>
                                <div class="radio-error"></div>
                            </div>
                        @endforeach

                    <!-- error message -->
                        @if ($errors->has('type'))
                            <div class="help-block text-danger">
                                {{ $errors->first('type') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <!-- Training Dropdown -->
        <div class="col-12">
            <div class="form-group training">
            {!! Form::label('reference_entity_id', trans('tms::training.title'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('reference_entity_id', $trainings ?? [], null, [
                        'class' => 'form-control  select2',
                        'placeholder'=>trans('labels.select'),
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('training_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('training_id') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Reason TextArea -->
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="reason" class="required">@lang('ims::inventory.item.item_request.form_elements.reason')
                :</label>
            {!! Form::textarea('reason', old('present_address') ?? null, [
                'data-rule-maxlength'=>'300',
                'data-msg-required' => Lang::get('labels.This field is required'),
                'data-msg-maxlength'=>Lang::get('labels.At most 55 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                'rows' => 3,
                'class' => 'form-control required'
            ]) !!}
        </div>
    </div>
</div>

<h4 class="form-section">
    <i class="la la-tag"></i>@lang('ims::inventory.item.item_request.form_elements.repeater_title')
</h4>

@include('ims::inventory.item.request.form.form-repeater')

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i> @lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="#">
        <i class="la la-close"></i> @lang('labels.cancel')
    </a>
</div>

