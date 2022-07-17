<!-- modal -->
<div class="modal fade text-left" id="inlineForm" tabindex="-1"
     role="dialog" aria-labelledby="myModalLabel33"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600"
                       id="myModalLabel33">{{trans('hrm::house-details.allocated_to')}}</label>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- modal body -->
            {!! Form::open(['class' => 'form trip-edit-form novalidate']) !!}
            <div class="modal-body">
                <!-- Trip Time and Return Time -->
                <div class="col">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group " id="start-time-div">
                                {!! Form::label('start_date_time', trans('vms::trip.form_elements.start_date_time'), ['class' => 'form-label required']) !!}
                                {{
                                       Form::text('start_date_time', $trip->start_date_time ?? date('YYYY-MM-DD hh::mm::ss'), [
                                            'class' => 'form-control required start-date-time',
                                            'data-msg-required'=> __('labels.This field is required'),
                                       ])
                                }}
                            </div>
                        </div>
                        <!--  Return date and time -->
                        <div class="col-6">
                            <div class="form-group" id="end-time-div">
                                {!! Form::label('end_date_time', trans('vms::trip.form_elements.end_date_time'), ['class' => 'form-label required']) !!}
                                {!! Form::text('end_date_time', $trip->end_date_time ?? date('YYYY-MM-DD hh::mm::ss'),
                                [
                                    'class' => "form-control required end-date-time",
                                    'data-msg-required' => trans('labels.This field is required'),
                                ]) !!}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="reset" class="btn btn-outline-secondary btn-lg"
                       data-dismiss="modal" value="{{trans('labels.cancel')}}">
                <input type="submit" class="btn btn-outline-primary btn-lg"
                       value="{{trans('labels.submit')}}">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
