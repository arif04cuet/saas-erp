@extends('publication::layouts.master')
@section('title', trans('publication::published-research-paper.send_to_press'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('publication::published-research-paper.send_to_press')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('publication::published-research-paper.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-js')
    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>

   <script>
         $(document).ready(function () {
            validateForm('.send-press-form');
             makeDropdownsSelect2();
        });

         /**dropdown select*/
         function makeDropdownsSelect2() {
             /**material and unit dropdown in purchase list */
             $('.type-dropdown-select, .press-dropdown-select').select2({
                 selectOnClose: true,
             });
         }
    </script>
@endpush
