<div class="card-body">
    @if ($page == "create")
        {!! Form::open(['route' => 'vms.fillingStation.store', 'class' => 'form company-form']) !!}
    @else
        {!! Form::open(['route' => ['vms.fillingStation.update', $fillingStation->id], 'class' => 'form company-form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('vms::fillingStation.title') @lang('labels.form')</h4>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('name', trans('vms::fillingStation.form_elements.station_name'),
                ['class' => 'form-label required']) !!}
                {!! Form::text('name', $page == "edit" ? $fillingStation->name : null, ['class' =>
                'form-control required',
                'placeholder' => trans('vms::fillingStation.form_elements.station_name'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('name'))
                        <div class="help-block text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('address', trans('vms::fillingStation.form_elements.address'), ['class' => 'form-label required']) !!}
                {!! Form::textarea('address', $page == "edit" ? $fillingStation->address : null, ['class' =>
                'form-control required',
                'placeholder' => trans('vms::fillingStation.form_elements.address'),
                 'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters')  ])!!}
                <!-- error message -->
                    @if ($errors->has('address'))
                        <div class="help-block text-danger">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
{{--        <div class="row">--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="form-group">--}}
{{--                {!! Form::label('email_lavel', trans('vms.fillingStation.email'), ['class' => 'form-label']) !!}--}}
{{--                {!! Form::text('email', $page == "edit" ? $company->email : null, ['class' =>--}}
{{--                'form-control',--}}
{{--                'placeholder' => trans('mms::company.email'),--}}
{{--                 'data-msg-required'=> __('labels.This field is required'),--}}
{{--                'data-rule-maxlength' => 60,--}}
{{--                'data-msg-maxlength'=> trans('labels.At most 100 characters') ])!!}--}}
{{--                <!-- error message -->--}}
{{--                    @if ($errors->has('email'))--}}
{{--                        <div class="help-block text-danger">--}}
{{--                            {{ $errors->first('email') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('contact_person_name', trans('vms::fillingStation.form_elements.contact_person_name'), ['class' => 'form-label']) !!}
                {!! Form::text('contact_person_name', $page == "edit" ? $fillingStation->contact_person_name : null, ['class' =>
                'form-control',
                'placeholder' => trans('vms::fillingStation.form_elements.contact_person_name'),
                 'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 60,
                'data-msg-maxlength'=> trans('labels.At most 60 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('contact_person_name'))
                        <div class="help-block text-danger">
                            {{ $errors->first('contact_person_name') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('contact_person_mobile', trans('vms::fillingStation.form_elements.mobile_number'),
                ['class' => 'form-label']) !!}
                {!! Form::text('contact_person_mobile', $page == "edit" ? $fillingStation->contact_person_mobile : null, ['class' =>
                'form-control',
                'placeholder' => trans('vms::fillingStation.form_elements.mobile_number'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 11,
                'data-msg-maxlength'=> trans('labels.At most 11 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('contact_person_mobile'))
                        <div class="help-block text-danger">
                            {{ $errors->first('contact_person_mobile') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Save & Cancel Button -->
        <div class="form-actions text-center">
            <button type="submit" class="btn btn-success">
                <i class="ft-check-square"></i>
                @lang('labels.save')
            </button>
            <a class="btn btn-warning mr-1" role="button" href="{{ route('vms.fillingStation.index') }}">
                <i class="ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {!! Form::close() !!}
        <br>
    </div>
</div>

@push('page-js')

@endpush
