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
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Billing Time:</td>
                                            <td>{{ date('d M, Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Bill Number:</td>
                                            <td>BILLXXXXXXX</td>
                                        </tr>
                                        <tr>
                                            <td>Booking ID:</td>
                                            <td>BKXXXXXXXX</td>
                                        </tr>
                                        <tr>
                                            <td>Bill For:</td>
                                            <td>Name</td>
                                        </tr>
                                        <tr>
                                            <td>Booking Type:</td>
                                            <td>Single / Family / Training</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td width="40%">Total</td>
                                            <td id="total-amount">2000</td>
                                        </tr>
                                        <tr>
                                            <td>Pay</td>
                                            <td>
                                                <input type="text" class="form-control" min="0" max="2000" name="pay_amount">
                                                <input type="hidden" class="form-control" name="due_amount">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Due</td>
                                            <td class="due-amount"></td>
                                        </tr>
                                        <tr>
                                            <td>Method</td>
                                            <td>
                                                {{ Form::select('payment_method', config('accounts.payment_method'), null, array('class' => 'form-control' . ($errors->has('payment_method') ? ' is-invalid' : '') )) }}
                                                <input type="text" class="form-control .extra-field" name="extra_field" style="display: none" placeholder="XXXXXXX Check No. ">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions text-center">
                                        <button type="button" class="btn btn-primary">
                                            <i class="la la-save"></i> Save
                                        </button>
                                        <a class="btn btn-warning mr-1" role="button"
                                           href="{{ route('bill.index') }}">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')

    <script type="text/javascript">
        $(document).ready(function () {
            /* # Payment
             ================================================= */

            $('input[name=pay_amount]').keyup(function (e) {
                var totalAmount = Number($('#total-amount').text());
                var dueAmount = Number(totalAmount-this.value);

                $('input[name=due_amount]').val(dueAmount);
                $('.due-amount').html(dueAmount);
            });

            /* # Payment Methods toggle
             ================================================= */

            $('select[name="payment_method"]').change(function(){
                var payment_method = this.value;
                var element = $('input[name="extra_field"]');

                if(payment_method != 'cash') {
                    element.show();
                    element.val("");
                } else {
                    element.hide();
                    element.val("");
                }
            });

        });
    </script>

@endpush