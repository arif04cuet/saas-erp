@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.religion.page.edit.title'))

@section('content')
    <div class="col-xs-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    @lang('hrm::employee.religion.page.edit.title')
                </h4>
                <a href="" class="heading-elements-toggle">
                    <i class="la la-ellipsis-h font-medium-3"></i>
                </a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a href="{{ route('employees.religions.index') }}" class="btn btn-primary btn-sm">
                                <i class="ft-list white"></i>
                                @lang('labels.list')
                            </a>
                        </li>
                        <li><a href="" data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a href="" data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a href="" data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    {{ Form::open(
                        [
                            'route' => ['employees.religions.update', $religion->id],
                            'class' => 'form employee-religion-update-form',
                            'novalidate',
                            'method' => 'PUT',
                        ]
                    ) }}
                    @include('hrm::religion.partial.form.create')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">

        $('input,select,textarea').not('[type=submit]').jqBootstrapValidation('destroy');

        let employeeReligionCreateForm = $('.employee-religion-create-form');

        let validator = employeeReligionCreateForm.validate({
            ignore: 'input[type=hidden]',
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
            rule: {},
            submitHandler: function (form, event) {
                form.submit();
            }
        });

    </script>
@endpush
