@if($trip->status != \Modules\VMS\Entities\Trip::getStatuses()['approved'] && $trip->type != $tripTypes['official'])
    @can('admin-vms-trip-approve')

        <!-- vehicle details -->
        <h4 class="form-section"><i class="la la-tag"></i>
            @lang('vms::trip.bill.payment_title')
        </h4>

        {!! Form::open(['route' =>  ['vms.trip.bill.payment',$trip],'class' => 'form']) !!}

        <div class="row text-center">
            <div class="col-12 ">
                <div class="radio-options">
                    <div class="row">
                        <div class="form-group col-12 ">
                            <div class="row">
                                <div class="col-12">
                                    <div class="skin skin-flat">
                                    @if($trip->type == $tripTypes['personal'])
                                        <!-- payroll -->
                                            {!! Form::radio('payment_option', $paymentOptions['payroll'],1,
                                                   [
                                                   'class' => 'required',
                                                    'data-msg-required'=>trans('labels.This field is required')
                                                   ])
                                            !!}
                                            <label
                                                for="type">
                                                @lang('vms::trip.bill.payment_option.'.$paymentOptions['payroll'])
                                            </label>
                                            <!-- make payment to accounts -->
                                            {!! Form::radio('payment_option', $paymentOptions['accounts'],null,
                                                      [
                                                      'class' => 'required',
                                                       'data-msg-required'=>trans('labels.This field is required')
                                                      ])
                                               !!}
                                            <label
                                                for="type">
                                                @lang('vms::trip.bill.payment_option.'.$paymentOptions['accounts'])
                                            </label>
                                        @elseif($trip->type == $tripTypes['training'])
                                            {!! Form::radio('payment_option', $paymentOptions['tms_accounts'],1,
                                                     [
                                                     'class' => 'required',
                                                      'data-msg-required'=>trans('labels.This field is required')
                                                     ])
                                              !!}
                                            <label
                                                for="type">
                                                @lang('vms::trip.bill.payment_option.'.$paymentOptions['tms_accounts'])
                                            </label>
                                        @elseif($trip->type == $tripTypes['project'])
                                            {!! Form::radio('payment_option', $paymentOptions['project'],1,
                                                   [
                                                   'class' => 'required',
                                                    'data-msg-required'=>trans('labels.This field is required')
                                                   ])
                                            !!}
                                            <label
                                                for="type">
                                                @lang('vms::trip.bill.payment_option.'.$paymentOptions['project'])
                                            </label>
                                        @endif
                                    </div>
                                    <div class="radio-error"></div>
                                </div>

                                <!-- error message -->
                                @if ($errors->has('payment_option'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('payment_option') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-actions text-center">
            <button type="submit" class="btn btn-success">
                <i class="la la-check-square-o"></i>@lang('labels.submit')
            </button>
            <a class="btn btn-warning mr-1" role="button"
               href="{{route('vms.trip.bill.index')}}">
                <i class="ft-x la la-check-square"></i> @lang('labels.back_page')
            </a>
        </div>
    @endcan
@endif
