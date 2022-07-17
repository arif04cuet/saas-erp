@extends('hm::layouts.master')
@section('title', __('hm::hostel.title').' '.__('labels.select'))
@push('page-css')
@endpush
@section('content')
    <div class="modal fade" id="selectionModal" tabindex="-1" role="dialog" aria-labelledby="selectionModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectionModalLabel">@lang('hm::checkin.for_guest_assaingment') @lang('hm::hostel.title') @lang('labels.select')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table table-bordered">
                        <table>
                            @foreach($hostels as $name => $details)
                                <tr>
                                    <td>
                                        <a href="{{route('room.assign', ['selectedHostelId' => $details['hostelDetails']->id,
                                        'roomCheckinId'=>$roomCheckinId])}}">{{$name}}</a>
                                    </td>
                                    @foreach($details['roomDetails'] as $roomDetail)
                                        <td>
                                            {{__('hm::roomtype.title').': '.$roomDetail->room_type}}<br/>
                                            {{__('hm::hostel.total_rooms').': '.$roomDetail->room_count}}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script type="text/javascript">
        $(window).on('load', function () {
            $('#selectionModal').modal('show');
        });
        $('#selectionModal').on('hide.bs.modal', function (event) {
            location.href = "{{route('check-in.index')}}";
        });
    </script>
@endpush
