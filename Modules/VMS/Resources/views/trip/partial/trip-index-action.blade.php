@if( !$isPrivilegedUser && ($trip->status == \Modules\VMS\Entities\Trip::getStatuses()['pending'] || $trip->status == \Modules\VMS\Entities\Trip::getStatuses()['approved']))
    <a href="{{route('vms.trip.change-status',[$trip->id,\Modules\VMS\Entities\Trip::getStatuses()['cancelled']])}}"
       class="btn btn-{{$statusCssArray['rejected']}} btn-sm">
        {{trans('labels.cancel')}}
    </a>
@endif

@if($isPrivilegedUser)

    @if(($trip->status == \Modules\VMS\Entities\Trip::getStatuses()['pending'] || $trip->status == \Modules\VMS\Entities\Trip::getStatuses()['approved']))
        <a href="{{route('vms.trip.change-status',[$trip->id,\Modules\VMS\Entities\Trip::getStatuses()['rejected']])}}"
           class="btn btn-{{$statusCssArray['rejected']}} btn-sm">
            {{trans('labels.reject')}}
        </a>
    @endif

    <!-- approved to ongoing -->
    @if($trip->status == \Modules\VMS\Entities\Trip::getStatuses()['approved'])
        <a href="{{route('vms.trip.change-status',[$trip->id,\Modules\VMS\Entities\Trip::getStatuses()['ongoing']])}}"
           class="btn btn-{{$statusCssArray['completed']}} btn-sm">
            {{trans('labels.start')}}
        </a>
    @endif
    <!-- ongoing to completed  -->
    @if($trip->status == \Modules\VMS\Entities\Trip::getStatuses()['ongoing'])
        <a href="{{route('vms.trip.change-status',[$trip->id,\Modules\VMS\Entities\Trip::getStatuses()['completed']])}}"
           class="btn btn-{{$statusCssArray['completed']}} btn-sm">
            {{trans('vms::trip.status.completed')}}
        </a>
    @endif
    <!-- if completed, take feedback -->
    @if($trip->status == \Modules\VMS\Entities\Trip::getStatuses()['completed'])
        <a href="{{route('vms.trip.feedback.create',$trip->id)}}"
           class="btn btn-primary btn-sm">
            <span class="la la-plus-square"></span>{{trans('vms::trip.feedback.title')}}
        </a>
    @endif
@endif


