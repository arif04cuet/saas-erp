@if($page == 'create')
    {!! Form::open(['route' =>  'physical-facility-requests.store', 'class' => 'facility-request-tab-steps wizard-circle', 'enctype' => 'multipart/form-data', 'novalidate']) !!}
@else
    {!! Form::open(['route' =>  ['booking-requests.update', $roomBooking->id], 'class' => 'booking-request-tab-steps wizard-circle', 'enctype' => 'multipart/form-data']) !!}
    @method('PUT')
@endif
@include('physical-facility-request.steps.step-1')
@include('physical-facility-request.steps.step-2')
{{--<div class="card-footer">--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <button type="submit" class="btn btn-success">--}}
{{--                <i class="la la-save"></i>--}}
{{--                @lang('labels.save')--}}
{{--            </button>--}}
{{--            <a class="btn btn-danger" href="{{url('/')}}">--}}
{{--                <i class="la la-times"></i>--}}
{{--                @lang('labels.cancel')--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{!! Form::close() !!}
