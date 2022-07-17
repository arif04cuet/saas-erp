{!! Form::open([
    'route' => 'check-in.approved-training.store',
    'class' => 'form trainee-hostel-checkin-form',
    'novalidate',
]) !!}
<!-- select a training -->
<h4 class="form-section"><i class="la  la-building-o"></i>
    @lang('hm::checkin.training.select_training')
</h4>
<div class="form-group">
    {!! Form::label('room_booking_id', trans('hm::checkin.training.training_title'), ['class' => 'form-label']) !!}
    {{ Form::select('room_booking_id', $bookingRequests, null, [
        'class' => 'form-control required',
        'data-msg-required' => __('labels.This field is required'),
        'placeholder' => trans('labels.select'),
        'onchange' => 'changeDynamicContent(this)',
    ]) }}
</div>

<div class="information-section">
    <!-- training and booking related information -->
    <h4 class="form-section"><i class="la  la-building-o"></i>
        @lang('hm::checkin.training.description')
    </h4>
    <div class="row dynamic-content">

    </div>
    @include('hm::check-in.approved-training.room-assign-repeater')
</div>

<!-- hidden fields -->
{{ Form::hidden('training_id', null) }}
{{ Form::close() }}
