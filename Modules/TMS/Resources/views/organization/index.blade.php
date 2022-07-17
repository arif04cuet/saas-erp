@extends('tms::layouts.master')
@section('title', trans('tms::organization.edit_organization'))

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="form-section"><i class="ft-user"></i>
                            @lang('tms::organization.edit_organization') @lang('labels.form')
                        </h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    @include('tms::organization.partials.form', ['page' => 'create'])
                                </div>
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered alt-pagination">
                                            <thead>
                                            <tr>
                                                <th width="10px">{{ trans('labels.serial') }}</th>
                                                <th>{{trans('tms::organization.organization_name')}}</th>
                                                <th class="text-center">{{ trans('labels.action') }} </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($trainingOrganizations as $trainingOrganization)
                                                <tr>
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="{{ route('trainingOrganization.show',$trainingOrganization->id) }}">
                                                            {{ $trainingOrganization->name ?? trans('labels.not_available') }}
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="dropdown">
                                                            <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"
                                                                    class="btn btn-info dropdown-toggle">
                                                                <i class="la la-cog"></i>
                                                            </button>
                                                                <span aria-labelledby="imsRequestList" class="dropdown-menu mt-1 dropdown-menu-right">
                                                                    <a href="{{ route('trainingOrganization.edit', $trainingOrganization->id) }}"
                                                                        class="dropdown-item">
                                                                        <i class="ft-edit-2"></i> {{ trans('labels.edit') }}
                                                                    </a>
        
                                                                    <div class="dropdown-divider"></div>
                                                                    <a href="{{ route('trainingOrganization.show', $trainingOrganization->id) }}"
                                                                    class="dropdown-item">
                                                                        <i class="ft-eye"></i> {{trans('labels.details')}}
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    {!! Form::open([
                                                                        'method'=>'DELETE',
                                                                        'url' => route('training-type.delete',$trainingOrganization->id),
                                                                        'style' => 'display:inline'
                                                                        ]) !!}
                                                                        {!! Form::button('<i class="ft-trash"></i> '.trans('labels.delete'), array(
                                                                        'type' => 'submit',
                                                                        'class' => 'dropdown-item',
                                                                        'title' => 'Delete the user',
                                                                        'onclick'=>'return confirm("Confirm delete?")',
                                                                        )) !!}
                                                                        {!! Form::close() !!}
                                                                </span>
                                                        </span>
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
    </section>
@endsection

@push('page-css')
<link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
<link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
<link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
<link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@push('page-js')
<script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
<script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
<script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
<script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {

        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");
        $('select').select2({
            placeholder: '{{ trans('labels.select') }}'
        });

        // datepicker
        $('#deadline_date').pickadate({
            min: new Date(),
            max: 365*17,
            default: new Date(),
        });


        let validator = $('.training-organization-form').validate({
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
