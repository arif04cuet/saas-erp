@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::special-service.bill.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('cafeteria::special-service.bill.title')
                            @lang('labels.create')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('cafeteria::special-group-bill.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-js')
<!-- repeater -->
<script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

<!-- validation -->
<script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
</script>

    <script>

        $(document).ready(function () {
            showGrandTotal();
            InitAllDropDown();
            validateForm('.special-group-bill-form');
        });

        $(`.special-group-bill`).repeater({
            show: function () {
                $(this).slideDown();
                InitAllDropDown();

                $(this).find('.bill-date').datepicker({
                    dateFormat: "yy-mm-dd",
                });

                let charge = $('.charge').val();
                $(this).find('.charge').val(charge);

                let totalMember = $('.member').val();
                $(this).find('.member').val(totalMember);

                let name = $(this).find('.charge').attr('name');
                calculateTotal(name)
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                    $(this).find('.total_charge').val('0');
                    setTimeout(function(){ showGrandTotal(); }, 1000);
                }
            },
            /** making the first item not deletable */
            @if($page == 'create')
                isFirstItemUndeletable: true
            @endif
        });

        /**dropdown select*/
        function makeDropdownsSelect2() {
            $('.groups-dropdown').select2({
                selectOnClose: true,
            });
        }

        function InitAllDropDown() {
            $('.select2-container').remove();
            makeDropdownsSelect2();
        }

        // /**date picker init*/
        $('.bill-date').datepicker({
            dateFormat: "yy-mm-dd"
        });

    </script>
@endpush
