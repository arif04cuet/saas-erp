@extends('hm::layouts.master')
@section('title', trans('hm::bill.bill_payment'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('hm::bill.bill_payment')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {{ Form::open(['route' => ['check-in-payments.store', $checkin->id], 'class' => 'bill-pay-form', 'method' => 'POST']) }}
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>@lang('hm::bill.billing_time'):</td>
                                            <td>{{ date('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::bill.bill_number'):</td>
                                            <td>{{ time() }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.check_in') @lang('labels.id'):</td>
                                            <td>{{ $checkin->shortcode }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::bill.bill_for'):</td>
                                            <td>{{ $checkin->requester->getName() }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::checkin.checkin_type'):</td>
                                            <td>{{ trans('hm::booking-request.' . $checkin->booking_type) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td width="40%">@lang('labels.total')</td>
                                            <td id="total-amount">{{ $dueAmount }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('labels.due')</td>
                                            <td class="due-amount"></td>
                                        </tr>
                                        <tr>
                                            <td>@lang('labels.amount')</td>
                                            <td>
                                                {{ Form::number('amount', old('amount') ? old('amount') : null, [
                                                        'class' => 'form-control required',
                                                        'min' => 0,
                                                        'max' => $dueAmount,
                                                        'data-msg-required' => trans('labels.This field is required'),
                                                    ])
                                                }}
                                                @if($errors->has('amount'))
                                                    <span class="danger">{{ $errors->first('amount') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('labels.method')</td>
                                            <td>
                                                {{ Form::select('type',
                                                    [
                                                        'cash' => trans('hm::checkin.cash'),
                                                        'card' => trans('hm::checkin.card'),
                                                        'check' => trans('hm::checkin.check')
                                                    ],
                                                    old('type') ? old('type') : null,
                                                    array('class' => 'form-control required' . ($errors->has('payment_method') ? ' is-invalid' : '') ))
                                                }}

                                                {{ Form::text('check_number',
                                                    old('check_number') ? old('check_number') : null,
                                                    [
                                                        'placeholder' => 'XXXXXXX Check No.',
                                                        'class' => 'form-control',
                                                        'style' => 'display: none',
                                                        'data-msg-required' => trans('labels.This field is required'),
                                                        'data-rule-minlength' => 11,
                                                        'data-msg-minlength'=> trans('labels.At least 11 characters'),
                                                    ]
                                                ) }}

                                                @if($errors->has('check_number'))
                                                    <span class="danger">{{ $errors->first('check_number') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions text-center">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-save"></i> @lang('hm::checkin.make_payment')
                                        </button>
                                        <a class="btn btn-warning mr-1" role="button"
                                           href="{{ route('check-in-payments.index',  $checkin->id) }}">
                                            <i class="ft-x"></i> @lang('labels.cancel')
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

            var totalAmount = Number($('#total-amount').text());
            var dueAmount = Number(totalAmount - this.value);
            $('.due-amount').html(dueAmount);

            let checkNumber = '{!! old('check_number') !!}';
            if (checkNumber) {
                var element = $('input[name="check_number"]');
                element.show();
                element.val(checkNumber);
            }

            /* # Payment
             ================================================= */
            $('input[name=amount]').keyup(function (e) {
                var totalAmount = Number($('#total-amount').text());
                var dueAmount = totalAmount;
                if (this.value < totalAmount) {
                    dueAmount = Number(totalAmount - this.value);
                } else {
                    dueAmount = 0;
                    this.value = totalAmount;
                }

                $('.due-amount').html(dueAmount);
            });

            /* # Payment Methods toggle
             ================================================= */
            $('select[name="type"]').change(function () {
                var payment_method = this.value;
                var element = $('input[name="check_number"]');

                if (payment_method == 'check') {
                    element.show();
                    element.val("");
                } else {
                    element.hide();
                    element.val("");
                }
            });
        });

        $('.bill-pay-form').validate({
            ignore: 'input[type=hidden]', // ignore hidden fields
            errorClass: 'danger',
            successClass: 'success',
            rules: {
                check_number: {
                    required: function (element) {
                        return ($('select[name="type"]').val() == 'check') ? true : false;
                    }
                },
            },
        });

    </script>

@endpush