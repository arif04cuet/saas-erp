@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::purchase-list.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('cafeteria::purchase-list.title')
                           @if ($page == "create")
                                @lang('labels.create')
                           @else
                                @lang('labels.edit')
                           @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('cafeteria::purchase-list.form')
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
<!-- repeater -->
<script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

<!-- pickadate -->
<script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

<!-- validation -->
<script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
</script>

        <script>

        $(document).ready(function () {
            showGrandTotal();
            InitAllDropDown();
            validateForm('.purchase-list-form');
        });

        $(`.purchase-list-items`).repeater({
            show: function () {
                $(this).slideDown();
                InitAllDropDown();
                /** unit all select option remove in new element  */
                @if($page == 'edit')
                    $(this).find('.unit').find('option').remove();
                @endif
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                    setTimeout(function(){ showGrandTotal(); }, 1000);
                }
            },

            /** making the first item not deletable */
            isFirstItemUndeletable: true
        });

        /**dropdown select*/
        function makeDropdownsSelect2() {
            /**material and unit dropdown in purchase list */
            $('.material-dropdown-select, .unit-dropdown-select').select2({
                selectOnClose: true,
            });
        }

        function InitAllDropDown() {
            $('.select2-container').remove();
            makeDropdownsSelect2();
        }

        /**date picker init*/
        $('input[name=purchase_date]').pickadate({
            format: 'yyyy-mm-dd',
            drops: 'up',
        });


        </script>
@endpush
