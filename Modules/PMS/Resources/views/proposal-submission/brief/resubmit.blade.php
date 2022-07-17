@extends('pms::layouts.master')
@section('title', trans('pms::project_proposal.project_submit'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Form wizard with number tabs section start -->
                <section id="number-tabs">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('pms::project_proposal.create_proposal')</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-h font-medium-3"></i></a>
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
                                        {!! Form::open(['url' => route('project-proposal-submitted-save-resubmit', $proposal->id), 'class' => 'form project-submission-tab-steps', 'enctype' => 'multipart/form-data']) !!}
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="la la-briefcase"></i>@lang('pms::project_proposal.project_submit_form')</h4>
                                            <div class="row">
                                                <div class="col-md-8 offset-2">
                                                    <div class="row">
                                                        <div class="form-group mb-1 col-sm-12 col-md-12">
                                                            <label class="required">{{ trans('labels.title') }}</label>
                                                            <br>
                                                            <input class="form-control" type="text" value="{{$proposal->title}}" name="title">
                                                            <input type="hidden" name="feature_id" value="{{$featureId}}">
                                                            @if ($errors->has('title'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('title') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group mb-1 col-sm-12 col-md-12">
                                                            <label class="required">{{trans('pms::project_proposal.attachment')}}</label>
                                                            {!! Form::file('attachments[]', ['class' => 'form-control required' . ($errors->has('attachments') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf', 'multiple' => 'multiple']) !!}

                                                            @if ($errors->has('attachments'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('attachments') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions text-center">
                                                <div class="col-md-8 offset-2">
                                                    <div class="form-group">
                                                        <label for="message">{{__('labels.message_to_receiver')}}</label>
                                                        <textarea class="form-control" name="message" id="message"></textarea>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{trans('labels.resubmit')}}
                                                </button>
                                                <a class="btn btn-warning mr-1" role="button" href="{{route('pms')}}">
                                                    <i class="ft-x"></i> {{trans('labels.cancel')}}
                                                </a>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Form wizard with number tabs section end -->
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/wizard.css') }}">
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style.css') }}">
    <!-- END Custom CSS-->
@endpush

@push('page-js')
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/wizard-steps.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/editors/ckeditor/ckeditor.js')  }}"></script>
    <script>
        $(document).ready(function () {
            // validation
            $('.project-submission-tab-steps').validate({
                ignore: 'input[type=hidden]', // ignore hidden fields
                errorClass: 'danger',
                successClass: 'success',
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function (error, element) {
                    if (element.attr('type') == 'radio') {
                        error.insertBefore(element.parents().siblings('.radio-error'));
                    } else if (element[0].tagName == "SELECT") {
                        error.insertAfter(element.siblings('.select2-container'));
                    } else if (element.attr('id') == 'ckeditor') {
                        error.insertAfter(element.siblings('#cke_ckeditor'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    title: {
                        maxlength: 100
                    },
                    remarks: {
                        maxlength: 5000
                    }
                },
            });

        });


    </script>
@endpush



