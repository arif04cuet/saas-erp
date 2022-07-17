@extends('tms::layouts.master')
@section('title', 'Create Training Course Rules and Guidelines')

@section('content')
    <section id="assessment">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="repeat-form">Create Training Course Payment Type</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
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
                                {{ Form::open(['route' => [
                                    'trainings.courses.payment.store',
                                    $training->id,
                                    $course->id
                                ],
                                'method' => 'POST'
                                ]) }}
                                <div class="row">
                                    <div class="col-md-3 text-right"> 
                                        {{ Form::hidden('course_id', $course->id) }}
                                        {{ Form::label('payment_type', trans('tms::course_payment.payment_type'), ['class' => 'required']) }} :
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <div class="skin skin-flat"> --}}
                                                {!! Form::radio(
                                                    'payment_type', 'free', true,
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
                                                    'payment_type', 'with-payment', false, ['class' => 'required',
                                                    'id' => 'with_payment',
                                                    'onclick' => 'setRadio(this)'
                                                    ]) 
                                                !!}
                                                <span>{{ trans('tms::course_payment.with_payment') }}</span>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row">
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
                                                                    'registration', 'registration', true,
                                                                    ['class' => '',
                                                                    'onclick' => 'setRadio(this)'
                                                                    ]) 
                                                                !!}
                                                                <span>{{ trans('tms::course_payment.at_registration') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group mb-3">
                                                            {!! Form::number('registration_amt', null, [
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
                                                                    'exam', 'exam', false,
                                                                    ['class' => '',
                                                                    ]) 
                                                                !!}
                                                                <span>{{ trans('tms::course_payment.at_exam') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group mb-3">
                                                            {!! Form::number('exam_amt', null, [
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
                                                                    'certificate_widraw', 'certificate_widraw', false,
                                                                    ['class' => '',
                                                                    ]) 
                                                                !!}
                                                                <span>{{ trans('tms::course_payment.certificate_widraw') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group mb-3">
                                                            {!! Form::number('certificate_widraw_amt', null, [
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
                                    <div class="form-actions">
                                        <button type="submit" class="master btn btn-primary">
                                            <i class="ft-check-square"></i> {{ trans('labels.save') }}
                                        </button>
                                        <a href="{{ route('trainings.courses.payment.show', [$training->id, $course->id]) }}"
                                           class="master btn btn-warning">
                                            <i class="ft-x"></i> {{ trans('labels.cancel') }}
                                        </a>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
@endpush