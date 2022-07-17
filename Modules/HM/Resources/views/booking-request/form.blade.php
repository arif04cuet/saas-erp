@if ($type == 'booking')
    @if ($page == 'create')
        {!! Form::open(['route' => 'booking-requests.store', 'class' => 'booking-request-tab-steps wizard-circle', 'enctype' => 'multipart/form-data']) !!}
    @else
        {!! Form::open(['route' => ['booking-requests.update', $roomBooking->id], 'class' => 'booking-request-tab-steps wizard-circle', 'enctype' => 'multipart/form-data']) !!}
        @method('PUT')
    @endif
@elseif($type == 'checkin')
    @if ($page == 'create')
        {!! Form::open(['route' => 'check-in.store', 'class' => 'booking-request-tab-steps wizard-circle', 'enctype' => 'multipart/form-data']) !!}
    @else
        @if ($checkinType == 'from-booking')
            {!! Form::open(['route' => ['check-in.store', $roomBooking->id], 'class' => 'booking-request-tab-steps wizard-circle', 'enctype' => 'multipart/form-data']) !!}
        @else
            {!! Form::open(['route' => ['check-in.update', $roomBooking->id], 'class' => 'booking-request-tab-steps wizard-circle', 'enctype' => 'multipart/form-data']) !!}
            @method('PUT')
        @endif
    @endif
@endif
<!-- Logic for handling booking from multiple place -->
<!-- Step 1 -->
@include('hm::booking-request.partials.form.step-1')
<!-- Step 2 -->
@include('hm::booking-request.partials.form.step-2')
<!-- Step 3 -->
@include('hm::booking-request.partials.form.step-3')
<!-- Step 4 -->
@include('hm::booking-request.partials.form.step-4')
{!! Form::close() !!}
