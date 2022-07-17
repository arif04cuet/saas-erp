@extends('tms::layouts.master')

@section('title',trans('tms::course_evaluation.add'))

@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form"> @lang('tms::course_evaluation.add')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0 list-circle">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        {!! Form::open(['route' =>  ['training.course.evaluate.question.store'], 'class' => 'form question-setup-form', 'novalidate', 'method' => 'post']) !!}
                        @include('tms::training.assessment.course_evaluation.partials.form.question-setup')

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="ft-check-square"></i> {{ trans('labels.save') }}
                            </button>
                            <a href="#"
                               class="btn btn-warning">
                                <i class="ft-x"></i> {{ trans('labels.cancel') }}
                            </a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
 <style>
     .customcheck{
         margin:0px 8px 0px 0px !important;
     }
 </style>
@endpush

    @php
        
    @endphp
    @push('page-js')
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <script type="text/javascript">

        $("#training_id").change(function () {
            var url = "{{url('tms/get-course-by-training-id/')}}" ;
            $.get( url +'/'+ $('#training_id').val(), function (data) {
                $('#course_id').find('option').not(':first').remove();
                if(data.length > 0)
                {
                    for (i=0; i < data.length; i++)
                    {
                        $('#course_id').append(new Option(data[i]['name'], data[i]['id']));
                    }
                }
            });
        });
        $("#course_id").change(function () {
            var url = "{{url('tms/get-module-by-course-id/')}}" ;
            $.get( url +'/'+ $('#course_id').val(), function (data) {
                $('#module_id').find('option').not(':first').remove();
                if(data.length > 0)
                {
                    for (i=0; i < data.length; i++)
                    {
                        $('#module_id').append(new Option(data[i]['title'], data[i]['id']));
                    }
                }
            });
        });

        let questionRepeaterContainer = $('.multi-question-ans'),
            answerRepeaterContainer = $('.add-multi-answer'),
            isInitialized = false;

        $(document).ready(function () {
            $('input,select,textarea').not('[type=submit]').jqBootstrapValidation('destroy');

            let questionRepeater = questionRepeaterContainer.repeater({
                initEmpty: true,
                show: function () {
                    let difference = true;
                    initiateTasks(this, difference);
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            if (questionRepeaterContainer.length) {
                questionRepeater.setList([1]);
            }
            // For Answer Repeater
            let answerRepeater = answerRepeaterContainer.repeater({
                initEmpty: true,
                show: function () {
                    let difference = true;
                    initiateTasks(this, difference);
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            if (answerRepeaterContainer.length) {
                answerRepeater.setList([1]);
            }

            isInitialized = true;

            function initiateTasks(instance, check=true) {
                if(check === true) {
                    $(instance).slideDown();
                }
            }

            let validator = $('.question-setup-form').validate({
                ignore: [],
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
                rules: {},
                submitHandler: function (form, event) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
