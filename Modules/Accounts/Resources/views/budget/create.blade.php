@extends('accounts::layouts.master')
@section('title', trans('accounts::budget.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('accounts::budget.title')
                            @if($page == 'create')
                                @lang('labels.create')
                            @else
                                @lang('labels.edit')
                            @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('accounts::budget.form')
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


    <script>

        $(document).ready(function () {
            InitAllDropDown();
            showTotal();
            showRevisedTotal();
        });


        let journalItemsRepeater = $(`.repeater-budget-items`).repeater({
            show: function () {
                $(this).slideDown();
                // remove all the select2 container and reinitialise it
                InitAllDropDown();

            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // making the first item not deletable
            @if($page == 'create')
            isFirstItemUndeletable: true
            @endif
        });

        // dept select2
        function makeDropdownsSelect2() {
            $('.dropdown-select').select2({
                selectOnClose: true,

            });

            // Account Dropdown
            $('.account-dropdown-select').select2({
                selectOnClose: true,
            });
        }

        function InitAllDropDown() {
            $('.select2-container').remove();
            makeDropdownsSelect2();
        }

    </script>

@endpush
