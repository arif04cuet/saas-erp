@extends('hm::layouts.master')
@section('title', trans('hm::booking-request.booking_request'))

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-12 my-auto align-self-center">
                <section id="validation">
                    <div class="row">
                        <div class="col-md-12 my-auto align-self-center">
                            <div class="card">

                                <div class="card-header">
                                    <div class="card-title text-center"><h4>
                                            <b>@lang('hm::booking-request.cancel.title')</b></h4>
                                    </div>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-md-6">
                                                <p class="text-center font-medium-3">@lang('hm::booking-request.cancel.card_title')</p>
                                                <div class="form-group">
                                                    {!!
                                                            Form::open([
                                                              'route' =>  'booking-requests.check',
                                                              'method' => 'get',
                                                              'class' => 'form booking-cancel-check-form','novalidate',
                                                            ])
                                                    !!}
                                                    {!! Form::label('reference_number', trans('hm::booking-request.cancel.form_elements.reference'),
                                                                        ['class' => 'form-label required'])
                                                        !!}
                                                    {{ Form::number(
                                                        'reference_number',
                                                         null,
                                                        [  'class' => 'form-control required',
                                                           'min'=>0,
                                                           'max'=>999999999999,
                                                           'data-rule-number'=>true,
                                                           'data-msg-number'=> trans('labels.Please enter a valid number'),
                                                           'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                                                           'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                                                           'data-msg-required'=> __('labels.This field is required'),
                                                        ]
                                                    ) }}


                                                    @if ($errors->has('mobile'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mobile') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="ft ft-check-square"></i> @lang('tms::check.submit_button')
                                                </button>
                                            </div>
                                        </div>
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                </section>
            </div>
        </div>
    </div>
@endsection



@push('page-js')
    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <!-- full-calender codes -->
    <script type="text/javascript">
        $(document).ready(function () {
            let confirmMessage = `{{trans('hm::booking-request.cancel.confirm_pop_up')}}`;
            $('.booking-cancel-check-form').validate({
                ignore: 'input[type=hidden],[readonly=readonly]',
                errorClass: 'danger',
                successClass: 'success',
                errorElement: "span",
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);

                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function (form, event) {
                    if (confirm(confirmMessage)) {
                        let number = $('input[name=reference_number]').val();
                        let url = '{{route('booking-requests.check.show',":id")}}';
                        url = url.replace(":id", number);
                        $(form).attr("action", url);
                        form.submit();
                    } else {
                        return false;
                    }
                }
            });
        });
    </script>
@endpush
