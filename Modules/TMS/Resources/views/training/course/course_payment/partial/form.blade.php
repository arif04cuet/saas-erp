    {{ Form::hidden('course_id', $course->id) }}
    <div class="row">
        <div class="col-md-3 text-right"> 
            {{ Form::label('payment_type', trans('tms::course_payment.payment_type'), ['class' => 'required']) }} :
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{-- <div class="skin skin-flat"> --}}
                    {!! Form::radio(
                        'payment_type', 'free', isset($course->trainingCoursePayment->payment_type) && $course->trainingCoursePayment->payment_type == 'free' ? true : false,
                        ['class' => 'required',
                        'id' => 'without_payment',
                        'onclick' => 'setRadio(this)'
                        ]) 
                    !!}
                    <span>{{ trans('tms::course_payment.without_payment') }}</span>
                {{-- </div> --}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{-- <div class="skin skin-flat"> --}}
                    {!! Form::radio(
                        'payment_type', 'with-payment', isset($course->trainingCoursePayment->payment_type) && $course->trainingCoursePayment->payment_type == 'with-payment' ? true : false, ['class' => 'required',
                        'id' => 'with_payment',
                        'onclick' => 'setRadio(this)'
                        ]) 
                    !!}
                    <span>{{ trans('tms::course_payment.with_payment') }}</span>
                {{-- </div> --}}
            </div>
        </div>

        <div class="col-md-3 text-right"> 
            {{ Form::label('payment_point', trans('tms::course_payment.payment_point'), ['class' => 'required']) }} :
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                    {!! Form::checkbox(
                                        'registration', 'registration', isset($course->trainingCoursePayment->payment_type) && $course->trainingCoursePayment->registration == 'registration' ? true : false,
                                        ['class' => '']) 
                                    !!}
                                    <span>{{ trans('tms::course_payment.at_registration') }}</span>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group mb-0">
                                {!! Form::number('registration_amt', isset($course->trainingCoursePayment->registration_amt) ? $course->trainingCoursePayment->registration_amt : null , [
                                    'class' => 'form-control form-control-sm' . ($errors->has('registration_amt') ? ' is-invalid' : ''),
                                    'placeholder' => Lang::get('tms::course_payment.payment_poriman'),
                                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                    {!! Form::checkbox(
                                        'exam', 'exam', isset($course->trainingCoursePayment->exam) && $course->trainingCoursePayment->exam == 'exam' ? true : false,
                                        ['class' => '']) 
                                    !!}
                                    <span>{{ trans('tms::course_payment.at_exam') }}</span>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group mb-0">
                                {!! Form::number('exam_amt', isset($course->trainingCoursePayment->exam_amt) ? $course->trainingCoursePayment->exam_amt : null, [
                                    'class' => 'form-control form-control-sm' . ($errors->has('exam_amt') ? ' is-invalid' : ''),
                                    'placeholder' => Lang::get('tms::course_payment.payment_poriman'),
                                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                    {!! Form::checkbox(
                                        'certificate_widraw', 'certificate-widraw', isset($course->trainingCoursePayment->certificate_widraw) && $course->trainingCoursePayment->certificate_widraw == 'certificate-widraw' ? true : false,
                                        ['class' => '']) 
                                    !!}
                                    <span>{{ trans('tms::course_payment.certificate_widraw') }}</span>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group mb-0">
                                {!! Form::number('certificate_widraw_amt', isset($course->trainingCoursePayment->certificate_widraw_amt) ? $course->trainingCoursePayment->certificate_widraw_amt : null, [
                                    'class' => 'form-control form-control-sm' . ($errors->has('certificate_widraw_amt') ? ' is-invalid' : ''),
                                    'placeholder' => Lang::get('tms::course_payment.payment_poriman'),
                                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-5"></div> --}}
            </div>
        </div>
    </div>

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('js/jquery-repeater/custom.js') }}"></script>
    <script src="{{ asset('js/jquery-validator-init.js') }}"></script>
@endpush
