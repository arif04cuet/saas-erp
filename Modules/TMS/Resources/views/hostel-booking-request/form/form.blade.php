@if($action == 'edit')
    {!! Form::open(['route' =>  'tms.hostel-booking-requests.update',
            'class' => 'form tms-hostel-booking-request-form']) !!}
    @method('PUT')
    {!! Form::hidden('room_booking_id',$roomBookingId) !!}
@else
    {!! Form::open(['route' =>  'tms.hostel-booking-requests.store',
            'class' => 'form tms-hostel-booking-request-form']) !!}
@endif

<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <!-- Training Dropdown -->
    <div class="row">
        <!-- Training -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('training_id',trans('tms::training.title'), ['class' => 'form-label required']) !!}
                {!! Form::select('training_id', $trainings, old('training_id') ?? null,
                [
                    'class' => "form-control training-select select2 required",
                    'placeholder'=>trans('labels.select'),
                    'onchange'=>'changeInformation(this)',
                    'data-msg-required'=> __('labels.This field is required'),
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

        <!-- Trainee Number  -->
        <div class="col-6">
            <div class="form-group">
                {!!
                    Form::label('no_of_trainee', trans('tms::hostel_booking_request.form_elements.total_registered_guest'),
                                            ['class' => 'form-label'])
                !!}
                {{
                       Form::number('no_of_trainee', old('no_of_trainee') ?? 0, [
                            'class' => 'form-control',
                            'readonly'
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('no_of_trainee'))
                <div class="help-block text-danger">
                    {{ $errors->first('no_of_trainee') }}
                </div>
            @endif
        </div>
    </div>

    <!-- Start and End Date-->
    <div class="row">
        <!-- Start Date  -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('start_date', trans('tms::hostel_booking_request.form_elements.start_date'), ['class' => 'form-label required']) !!}
                {{
                       Form::text('start_date', old('start_date') ?? date('Y-m-d'), [
                            'class' => 'form-control start-date required',
                            'placeholder'=>trans('labels.select'),
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('start_date'))
                <div class="help-block text-danger">
                    {{ $errors->first('start_date') }}
                </div>
            @endif
        </div>

        <!-- End Date  -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('end_date', trans('tms::hostel_booking_request.form_elements.end_date'),
                                ['class' => 'form-label required'])
                !!}
                {{
                       Form::text('end_date', old('end_date') ?? date('Y-m-d'), [
                            'class' => 'form-control end-date required',
                            'placeholder'=>trans('labels.select'),
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('end_date'))
                <div class="help-block text-danger">
                    {{ $errors->first('end_date') }}
                </div>
            @endif
        </div>
    </div>

</div>
<!--/General Information -->

<!-- Hostel Booking Detail -->
@include('tms::hostel-booking-request.form.form-repeater')

<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{route('tms.dashboard')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

{!! Form::close() !!}
