@extends('hrm::layouts.master')
@section('title', trans('hrm::appraisal.invitation.create'))

@section("content")
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="repeat-form">@lang('hrm::appraisal.invitation.create')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show" style="">
                <div class="card-body">
                    @include('hrm::appraisal.invitation.form')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')

    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/editors/tinymce/tinymce.min.css') }} "/>
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script src="{{asset('theme/vendors/js/editors/tinymce/tinymce.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");
            // datepicker
            $('#deadline_for_signer').pickadate({
                min: new Date(),
                max: 365*17,
                default: new Date(),
            });
            $('#deadline_for_final_commenter').pickadate({
                min: new Date(),
                max: 365*17,
                default: new Date(),
            });
            $('#deadline_for_final_commenter_sign').pickadate({
                min: new Date(),
                max: 365*17,
                default: new Date(),
            });

            tinymce.init({
                selector: 'textarea',
                menubar: false,
                height: 200,
                theme: 'modern',
                plugins: " advlist autolink lists link image charmap print preview textcolor anchor searchreplace visualblocks code fullscreen insertdatetime media table paste imagetools wordcount",
                toolbar: "textcolorinsertfile undo redo | fontselect fontsizeselect | styleselect| textcolor forecolor backcolor  | table  | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link | image | ",
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '{{asset("theme/vendors/css/editors/tinymce/tinymce.min.css")}}'
                ]
            });

            let validator = $('.appraisal-invitation-form').validate({
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
    <script>
        $("#reporter").change(function () {
            $.get("{{url('hrm/appraisal/settings/getSettingById')}}/" + $(this).val(), function (settingObj) {

                $.get("{{ url('hrm/appraisal/settings/getSignerById') }}/" + settingObj.signer_id, function (signer) {
                    document.getElementById('signer').value = signer;
                });

                $.get("{{ url('hrm/appraisal/settings/getCommenterById') }}/" + settingObj.commenter_id, function (commenter) {
                    document.getElementById('commenter').value = commenter;
                });
            });
        });
    </script>
@endpush
