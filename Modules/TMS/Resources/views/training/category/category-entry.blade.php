@extends('tms::layouts.master')
@section('title', trans('tms::training_type.title'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="form-section"><i class="ft-user black"></i>
                                @lang('tms::training_type.title')
                            </h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        {!! Form::open(['route' =>  ['training.category.store'], 'class' => 'form wizard-circle training-type-form', 'novalidate', 'method' => 'post']) !!}
                                        <fieldset>
                                            @include('tms::training.category.form',['page'=>'index'])
                                        </fieldset>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="master table table-striped table-bordered alt-pagination">
                                                <thead>
                                                <tr>
                                                    <th width="10px">{{ trans('labels.serial') }}</th>
                                                    <th>{{ trans('labels.name') }}</th>
                                                    <th>{{ trans('tms::category.parent') }}</th>
                                                    <th class="text-center">{{ trans('labels.action') }} </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($categories as $key => $category)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td>
                                                            <a href="{{ route('training-head.show', $category->id) }}">
                                                                {{ $category->getName() ?? trans('labels.not_found') }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('training-head.show', $category->id) }}">
                                                                {{ $category->getParentName() ?? trans('labels.not_found') }}
                                                            </a>
                                                        </td>

                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <a href="{{ route('training-category-show', $category) }}" class="master btn btn-info" title="{{trans('labels.details')}}">
                                                                    <i class="ft-eye white"></i>
                                                                    {{-- {{trans('labels.details')}} --}}
                                                                </a>
                                                                <a href="{{ route('training-category-edit', $category) }}" class="master btn btn-success" title="{{trans('labels.edit')}}">
                                                                    <i class="ft-edit white"></i>
                                                                    {{-- {{trans('labels.edit')}} --}}
                                                                </a>
                                                                <a href="#" class="master btn btn-danger"
                                                                    onclick="delete_form{{ $key }}.submit()" title="{{ trans('labels.delete') }}">
                                                                    <i class="la la-trash-o white"></i>
                                                                </a>
                                                                <!-- delete -->
                                                                {{-- <div class="dropdown-divider"></div> --}}
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'url' => route('training-category-remove',$category),
                                                                    'style' => 'display:inline',
                                                                    'id' => 'delete_form' . $key,
                                                                ]) !!}

                                                                {!! Form::close() !!}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
    <script src="{{asset('theme/vendors/js/editors/tinymce/tinymce.js')}}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/core/app.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");
            $('.select').select2();

            let validator = $('.training-type-form').validate({
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
                    } else if(element.attr("type") === "file") {
                        $('#imageValidationMassage').html(error);
                    }else {
                        error.insertAfter(element);
                    }
                },
                rules: {},
                submitHandler: function (form, event) {
                    form.submit();
                }
            });
        });

        jQuery.validator.addMethod(
            "regex-bn",
            function (value, element, params) {
                let regex = new RegExp(params);
                return value.match(params);
            },
            "{{ trans('tms::training_type.msg.regex.bn') }}"
        );

        jQuery.validator.addMethod(
            "regex-en",
            function (value, element, params) {
                let regex = new RegExp(params);
                return value.match(params);
            },
            "{{ trans('tms::training_type.msg.regex.eng') }}"
        );

        jQuery.validator.addMethod(
            'no-white-space',
            function (value, element, params) {
                let regex = new RegExp(params);
                return value.match(params);
            },
            "{{ trans("labels.This field is required") }}"
        );

    </script>
@endpush
