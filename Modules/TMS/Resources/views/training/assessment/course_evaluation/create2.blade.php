@extends('layouts.public')
@section('title', trans('tms::training.evaluation.general_info_title'))

@push('page-css')
    <style>
        @media screen and (max-width: 1300px) {
            .header-navbar .navbar-container ul.nav li > a.nav-link {
                font-size: 14px;
                padding: 1.9rem 0.6rem;
            }
        }

        @media screen and (min-width: 992px) and (max-width: 1040px) {
            .header-navbar .navbar-container ul.nav li > a.nav-link {
                font-size: 13px;
            }
        }

        .card-body > ul > li.list-group-item h4 {
            font-size: 16px;
            line-height: 24px;
        }

        .card-body > ul > li.list-group-item h5 {
            font-size: 14px;
        }

        .card-body > ul > li.list-group-item {
            box-shadow: 0 -3px 8px 0 rgba(0, 0, 0, 0.07);
        }

        .header-navbar {
            box-shadow: 0 2px 15px 0px rgba(0, 0, 0, 0.05);
        }

        .form-check label {
            cursor: pointer;
        }

        .actions ul li {
        }

        .app-content .wizard > .actions > ul > li > a {
            padding: 7px 5px;
            min-width: 90px;
            text-align: center;
        }

        @media screen and (max-width: 767px) {
            .plr-xs-0 {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            .app-content .wizard > .content > .body {
                padding: 0 !important;
            }

            .course-evaluation-tab-steps h2.text-title {
                font-size: 18px;
            }

            .app-content .wizard > .steps > ul > li {
                width: 33% !important;
            }
        }

        @media screen and (max-width: 480px) {
            .app-content .wizard > .steps > ul > li {
                width: 50% !important;
            }

            .card-body > ul > li.list-group-item {
                padding: 0;
            }

            .card-body > ul > li.list-group-item .list-group-item {
                border-left: none;
                border-right: none;
                border-radius: 0;
            }
        }
    </style>
@endpush()

@section('content')
    <div class="container plr-xs-0">
        <div class="row justify-content-center">
            <div class="col-md-12 plr-xs-0">
                @if (session('success'))
                    <div class="alert bg-success alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <span style="color: black">{!! session('success') !!}</span>
                        <a href="{{ route('public-booking-requests.create') }}" class="btn btn-amber btn-accent-4"
                           style="color: white"><b>@lang('hm::booking-request.create_booking_request')</b></a>
                    </div>
                @else
                    <section id="number-tabs">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <a class="heading-elements-toggle">
                                            <i class="la la-ellipsis-h font-medium-3"></i>
                                        </a>
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
                                            {!! Form::open([
                                                    'route' =>  ['public.courses.evaluations.store', $course, $trainee],
                                                    'class' => 'course-evaluation-tab-steps wizard-circle',
                                                    'method' => 'PUT',
                                            ]) !!}
                                            {{-- {{ dd($courseObjectives) }} --}}
                                            @include('tms::training.assessment.course_evaluation.partials.form.steps.introduction')
                                            @if($sections->count())
                                                @foreach($sections as $key => $section)
                                                    @include('tms::training.assessment.course_evaluation.partials.form.steps.section', ['section' => $section, 'courseObjectives' => $courseObjectives])
                                                @endforeach
                                            @endif
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <style type="text/css">
        .icheckbox_flat-green, .iradio_flat-green {
            margin-top: -15px;
        }
    </style>
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/wizard-steps.js') }}"></script>
    @include('tms::training.assessment.course_evaluation.partials.javascript')
    <script src="{{ asset('js/course_evaluation/step.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.course-evaluation-tab-steps').validate({
                ignore: ':hidden,:disabled',
                errorClass: 'danger',
                successClass: 'success',
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function (error, element) {
                    if (element.attr('type') === 'radio') {
                        error.insertBefore(element.parent().parent().parent().parent().parent().parent().parent()
                            .siblings('div.error-container').find('.radio-error'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {},
                submitHandler: function (form, event) {
                    form.submit();
                }
            });
        });

        let checkboxesContainer = $('.checkbox-scores');
        checkboxesContainer.on('ifClicked', function () {
            let group = $(this).attr('data-questionnaire-group');
            let clickedCheckbox = $(this).attr('data-item-index');

            let groupCheckboxes = $('input[type=checkbox][data-questionnaire-group=' + group + ']');
            groupCheckboxes.not('[data-index-id=' + clickedCheckbox + ']').iCheck('uncheck');
        });

        let radioContainer = $('.radio-scores');
        radioContainer.on('ifChecked', function () {
            $(this).parent().parent().parent().parent().parent().parent().parent()
                .siblings('div.error-container').find('label.danger').remove();
            $(this).parent().parent().parent().parent().parent().parent()
                .siblings('span.invalid-feedback').remove();
        })
    </script>
@endpush
