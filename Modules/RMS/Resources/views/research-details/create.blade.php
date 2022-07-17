@extends('rms::layouts.master')
@section('title', trans('rms::research_details.submit_detail'))

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
                                    <h4 class="card-title">@lang('rms::research_details.submit_detail')</h4>
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
                                        {!! Form::open(['route' =>  'research-details.store', 'class' => '', 'enctype' => 'multipart/form-data']) !!}

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="la la-briefcase"></i> @lang('rms::research_details.research_detail_submission_form')</h4>

                                            <div class="row">
                                                <div class="col-md-8 offset-2">
                                                    <fieldset>
                                                        <div class="form row">

                                                            {{--                                                            {!! Form::hidden('auth_user_id', $auth_user_id) !!}--}}
                                                            {{--@if($page == 'create')--}}
                                                            {!! Form::hidden('research_detail_invitation_id', $researchDetailInvitationId) !!}
                                                            {{--@endif--}}
                                                            <div class="form-group mb-1 col-sm-12 col-md-12">
                                                                <label class="required">{{ trans('labels.name') }}</label>
                                                                <br>
                                                                {!! Form::text('title', null, ['class' => 'form-control required' . ($errors->has('title') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'Title', 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters')]) !!}

                                                                @if ($errors->has('title'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('title') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            <div class="form-group mb-1 col-sm-12 col-md-12">
                                                                <label class="required">{{trans('rms::research_proposal.attachment')}}</label>
                                                                {!! Form::file('attachments[]', ['class' => 'form-control required' . ($errors->has('attachments') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf', 'multiple' => 'multiple']) !!}

                                                                @if ($errors->has('attachments'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('attachments') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                            <input type="hidden" name="type" id="type">
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-8 offset-2">
                                                    <fieldset>
                                                        <div class="form row">

                                                            <div class="form-group mb-1 col-sm-12 col-md-12">
                                                                <label class="">{{ trans('labels.message_to_receiver') }}</label>
                                                                <br>
                                                                {!! Form::textarea('message', null, ['class' => 'form-control',  'placeholder' => 'Message','rows'=>3]) !!}
                                                            </div>

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="pull-right">
                                                {!! Form::button('<i class="la la-check-square-o"></i> '.trans('labels.save') , ['type' => 'submit', 'class' => 'btn btn-primary', 'name' => 'type', 'value' => 'publish'] ) !!}

                                                <a class="btn btn-warning mr-1" role="button"
                                                   href="{{route('invitations')}}"><i class="ft-x"></i> {{trans('labels.cancel')}}
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
    {{--    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">--}}
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style.css') }}">
    <!-- END Custom CSS-->
@endpush

@push('page-js')
    {{--    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js')  }}"></script>--}}
    {{--    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>--}}
    {{--    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>--}}

    {{--    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>--}}
    {{--    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>--}}
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    {{--    <script src="{{ asset('theme/js/scripts/forms/wizard-steps.js') }}"></script>--}}
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    {{--    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>--}}
    {{--    <script src="{{ asset('theme/vendors/js/editors/ckeditor/ckeditor.js')  }}"></script>--}}
    <script>


    </script>
@endpush
