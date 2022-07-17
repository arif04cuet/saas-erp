{!!
    Form::open([
      'route' =>  'check-in.approved-physical-facility.store',
      'class' => 'form organization-hostel-checkin-form','novalidate',
    ])
!!}

<div class="information-section">
    <!-- training and booking related information -->
    <h4 class="form-section"><i class="la  la-building-o"></i>
        @lang('hm::checkin.training.description')
    </h4>
    <div class="">
        @include('hm::check-in.physical-facility.helper.information')
    </div>
    @include('hm::check-in.physical-facility.room-assign-repeater')
</div>

<!-- hidden fields -->
{{Form::hidden('room_booking_id',$roomBooking->id)}}
{{Form::close()}}
