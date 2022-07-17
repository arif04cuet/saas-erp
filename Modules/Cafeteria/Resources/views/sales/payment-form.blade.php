<h4 class="form-section mt-4"><i class="la la-tag"></i>@lang('cafeteria::special-service.bill.title') @lang('cafeteria::special-service.bill.payment')</h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('paid', trans('cafeteria::special-service.bill.payment'), ['class' => 'form-label required']) !!}
            {!! Form::text('paid', $page == "edit" ? $sales->paid : null, ['class' =>
                'form-control payment required',
                'data-msg-required'=> __('labels.This field is required'),
                'data-msg-max'=> trans('cafeteria::sales.paid_validate'),
                'min' => 0,
                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 0'),
                'placeholder' => trans('cafeteria::special-service.bill.payment'),
                'onkeyup' => 'calculatePayment()' 
            ])!!}
            <input type="hidden" name="paid-edit" value="{{ $page == "edit" ? $sales->paid : 0 }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('due', trans('cafeteria::special-service.bill.due_total'), ['class' => 'form-label']) !!}
            {!! Form::text('due', $page == "edit" ? $sales->due : null, ['class' =>
                'form-control due-total required',
                'data-msg-required'=> __('labels.This field is required'),
                'placeholder' => trans('cafeteria::special-service.bill.due_total'),
                'readOnly' => true
            ])!!}
        </div>
    </div>
</div>