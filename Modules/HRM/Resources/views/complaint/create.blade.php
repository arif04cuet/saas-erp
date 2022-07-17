@extends('hrm::layouts.master')
@section('title', trans('hrm::complaint.create'))

@section('content')
    <section id="user-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('hrm::complaint.create')</h4>
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
                            {!! Form::open(['route' => 'complaint.store', 'class' => 'form complaintForm', 'novalidate', 'enctype' => 'multipart/form-data']) !!}
                            {!! Form::hidden('complainer_id', $complainer_id) !!}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> @lang('hrm::complaint.create') @lang('labels.form')</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label required">@lang('hrm::complaint.against_whom')</label>
                                        @if(!is_null($complaintInvitation->id))
                                            {{ Form::hidden('complaint_invitation_id', $complaintInvitation->id) }}
                                        @endif
                                        @if(!is_null($complaintInvitation->id))
                                            {{ Form::hidden('complainee_id', $complaintInvitation->complainee->id) }}
                                            {{ Form::text('complainee_id', $complaintInvitation->complainee->getName() . ' - ' . $complaintInvitation->complainee->getDesignation(), ['class' => 'form-control', 'disabled']) }}
                                        @else
                                            {{ Form::select(
                                                'complainee_id',
                                                $employees,
                                                $complaintInvitation->id ? $complaintInvitation->complainee->id : null,
                                                [
                                                    'class' => "form-control select2 required",
                                                    "placeholder" => __('labels.select'),
                                                    'data-msg-required' => trans('labels.This field is required'),
                                                ]
                                              )
                                            }}
                                        @endif
                                        <div class="help-block"></div>
                                        @if ($errors->has('complainee_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('complainee_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('attachments', __('hrm::complaint.attachment'), ['class' => 'form-label']) !!}
                                            {!! Form::file('attachment', [
                                            'class' => 'form-control' . ($errors->has('attachment') ? ' is-invalid' : ''),
                                            'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf'
                                            ]) !!}
                                            <div class="help-block"></div>
                                            @if ($errors->has('attachment'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('attachment') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('reason', __('hrm::complaint.reason'), ['class' => 'form-label required']) !!}

                                            {!! Form::textarea('reason', $complaintInvitation->id ? $complaintInvitation->reason : null, [
                                                'class' => "form-control", "required ",
                                                "placeholder" => __('hrm::complaint.reason'),
                                                'data-rule-maxlength' => 300,
                                                'data-msg-maxlength' => trans('labels.At most 300 characters'),
                                                'data-msg-required' => trans('validation.required', ['attribute' => trans('hrm::complaint.reason')]),
                                                'readOnly' => $complaintInvitation->id ? true : false
                                            ]) !!}
                                            <div class="help-block"></div>
                                            @if ($errors->has('reason'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('reason') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ft-check-square"></i> {{trans('labels.save')}}
                                </button>
                                <button class="btn btn-warning" type="button" onclick="window.location = '{{route('complaint.index')}}'">
                                    <i class="ft-x"></i> {{trans('labels.cancel')}}
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('page-js')
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

            let complaintForm = $('.complaintForm');

            complaintForm.validate({
                ignore: 'input[type=hidden]',
                errorClass: "danger",
                successClass: "success",
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function (error, element) {

                    if (element.attr('type') === 'radio') {

                        error.insertBefore(element.parents().siblings('.radio-error'));

                    } else if (element[0].tagName === "SELECT") {

                        error.insertAfter(element.siblings('.select2-container'));

                    } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {

                        error.insertAfter(element.parents('.input-group'));

                    } else if(element.attr('type') === 'file') {

                        error.insertAfter(element.parent().parent().find('.avatar-preview'));

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
    </script>
@endpush
