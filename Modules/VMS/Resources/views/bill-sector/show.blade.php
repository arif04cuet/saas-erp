@extends('vms::layouts.master')
@section('title', trans('vms::bill-sector.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('vms::bill-sector.title') @lang('labels.details')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements" style="top: 5px;">
                <ul class="list-inline mb-1">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <h4 class="form-section"><i class="la la-tag"></i> @lang('labels.details')</h4>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <table class="table">
                            <tr>
                                <th>@lang('vms::bill-sector.form_elements.title_english')</th>
                                <td>{{ $vmsBillSector->title_english ?? trans('labels.not_found') }}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::bill-sector.form_elements.title_bangla')</th>
                                <td>{{ $vmsBillSector->title_bangla ?? trans('labels.not_found') }}</td>
                            </tr>

                            <tr>
                                <th>@lang('vms::bill-sector.form_elements.amount')</th>
                                <td>{{ $vmsBillSector->amount ?? trans('labels.not_found') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <h4 class="form-section"><i class="la la-tag"></i> @lang('labels.details')</h4>
                <div class="row">
                    @include('vms::bill-sector.form.assign-form')
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <a href="{{route('vms.bill-sector.index')}}" class="btn btn-danger">
                        <i class="la la-backward"></i> @lang('labels.back_page')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page-css')

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <!-- checkbox css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

@endpush

@push('page-js')
    <!-- pickadate -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <!-- daterange picker -->
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <!-- custom -->
    <script>
        let genericErrorMessage = '<?php echo trans('labels.generic_error_message'); ?>';
        $('.promotion-form').submit(function (eventObj) {
                if (confirm("Are you sure ?")) {
                    let table = $('#promotion-table').dataTable();
                    table.api().rows().nodes().page.len(-1).draw(false);
                    return true;
                } else {
                    return false;
                }
            }
        );
    </script>
@endpush
