<div class="modal fade" id="selectionModal" role="dialog" aria-labelledby="selectionModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectionModalLabel">@lang('hm::booking-request.booking_request') @lang('labels.forward')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['route' => ['booking-requests-forward', $roomBookingId], 'id' => 'forward-form']) }}
            <div class="modal-body">
                <div class="widget-content tab-content bg-white">
                    <div class="form-group mb-0 col-md-12">
                        <label class="required">@lang('labels.select') @lang('labels.user')</label>
                        {!! Form::select('forwardTo', $forwardToUsers, null, ['class' => 'form-control required user-select'] ) !!}
                    </div>
                    <div class="form-group mb-0 col-md-12">
                        <label class="required">@lang('labels.forward') @lang('labels.remarks')</label>
                        {!! Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => trans('labels.note'), 'cols' => 5, 'rows' => 3]) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">@lang('labels.forward')</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('labels.cancel')</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#selectionModal').modal('hide');

            $('.user-select').select2();
        });

    </script>
@endpush
