@extends('hrm::layouts.master')
@section('title', trans('hrm::house-details.house_details'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('hrm::house-details.house_details')
                           @if ($page == "create")
                                @lang('labels.create')
                           @else
                                @lang('labels.edit')
                           @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('hrm::house-details.form')
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
            validateForm('.house-details-form');
            toggleDiv($("select[name='status'] :selected"));
        });

         $("select[name='status']").on('change', function () {
             toggleDiv(this);
         })

         function toggleDiv(ref)
         {
             if ($(ref).val() === "allocated") {
                 $(".allocated_to_div").show();
             } else {
                 $("select[name='allocated_to']").val('').trigger('change');
                 $(".allocated_to_div").hide();
             }
         }
    </script>
@endpush
