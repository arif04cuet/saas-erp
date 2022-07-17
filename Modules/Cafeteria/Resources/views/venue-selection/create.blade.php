@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::venue-selection.title'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <h4 class="card-title">
                        @lang('cafeteria::venue-selection.title')
                        @lang('labels.create')
                    </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    @include('cafeteria::venue-selection.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page-css')
<!-- date-picker css -->
<link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
<link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
<link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush


@push('page-js')
<!-- pickadate -->
<script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

<!-- validation -->
<script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
</script>

<script>
    $(document).ready(function () {
            initAllDropDown();
            validateForm('.venue-selection-form');
        });

         /**dropdown select*/
         function initAllDropDown() {
            $('.training-dropdown, .venue-dropdown').select2({
                selectOnClose: true,
            });
        }

         /**date picker init*/
         $('input[name=selection_date]').pickadate({
            format: 'yyyy-mm-dd',
            drops: 'up',
        });
</script>
@endpush