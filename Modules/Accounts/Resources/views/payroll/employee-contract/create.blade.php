@extends('accounts::layouts.master')
@section('title', trans('accounts::employee-contract.title'))
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('accounts::employee-contract.title')
                        @if($page == 'create')
                            @lang('labels.create')
                        @else
                            @lang('labels.edit')
                        @endif
                    </h4>
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
                        @include('accounts::payroll.employee-contract.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@php
    if(!isset($outstandings)) $outstandings=[];
@endphp


@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <!-- datepicker -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <!-- jquery Validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script>
        initialOutstandingData = [];
        page = @json($page, JSON_UNESCAPED_UNICODE);
        if (page === 'edit') {
            initialOutstandingData = @json($outstandings, JSON_UNESCAPED_UNICODE);
        }
        $('#start_date, #end_date, #probation_end').pickadate({
            format: 'd mmmm yyyy',
            selectYears: true,
            selectMonths: true,
        });

        $('#start_date').change(function () {
            $('#end_date').pickadate('picker').set('min', new Date($(this).val()));
        });

        $(document).ready(function () {
            // needed for repeater validation
            $('input,select,textarea,text').jqBootstrapValidation('destroy');

            let selectPlaceholder = '{!! trans('labels.select') !!}';

            let outstandingRepeaterForm = $('.outstanding-repeater');

            let outstandingRepeater = outstandingRepeaterForm.repeater({
                show: function () {

                    // reinit - select2
                    $(this).find('select').next('.select2-container').remove();
                    $(this).find('select').select2({
                        placeholder: selectPlaceholder,
                    });

                    // reinit - datepicker
                    $(this).find('.outstanding-month')
                        .removeClass('picker__input')
                        .removeAttr('aria-owns')
                        .removeAttr('id')
                        .attr('readOnly', false);

                    $(this).find('.outstanding-month').pickadate({
                        format: 'mmmm,yyyy',
                        selectYears: true,
                        selectMonths: true,
                    });
                    $(this).slideDown();
                },
                defaultValues: {
                    'amount': '0'
                },
                initEmpty: true,
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });

            if (initialOutstandingData.length) {
                outstandingRepeaterForm.setList(initialOutstandingData);
            }
        });

        //set the placemenet of error
        $('.salary-structure-form').validate({
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
                if (element[0].tagName === "SELECT") {
                    error.insertAfter(element.siblings('.select2-container'));
                    if (element.next('.select2-container').length > 0) {
                        error.insertAfter(element.next('.select2-container'));
                    } else {
                        error.insertAfter(element);
                    }
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {},
            submitHandler: function (form, event) {
                form.submit();
            },
        });

    </script>
@endpush
