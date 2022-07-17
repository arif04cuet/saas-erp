@extends('accounts::layouts.master')
@section('title', trans('accounts::payroll.promotion.title'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('accounts::payroll.promotion.title') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        {!! Form::open(['route' =>  'accounts.promotion.update','class' => 'form promotion-form']) !!}
                        @method('put')
                        @include('accounts::promotion.form')
                        {!! Form::close() !!}
                    </div>
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

        function getElement(element) {
            let name = $(element).attr("name");
            let grade = $(element).val();
            let index = getNumberFromString(name);
            $.ajax({
                url: '{{url('accounts/salary/increments')}}/' + grade,
                type: 'get',
                dataType: 'json',
                success: function (json) {
                    let incrementElementPattern = "employees[" + index + "][increment]";
                    let incrementElement = $('select[name="' + incrementElementPattern + '"]');
                    $(incrementElement).empty();
                    for (let i = 0; i <= json; i++) {
                        $(incrementElement).append($('<option>').text(i).attr('value', i));
                    }
                }
            });
        }

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
