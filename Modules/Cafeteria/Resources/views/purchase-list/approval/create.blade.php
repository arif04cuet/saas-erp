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
                        @lang('labels.approve')
                    </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    @include('cafeteria::purchase-list.approval.form')
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


<script>
    $(document).ready(function () {
            showGrandTotal();
            InitAllDropDown();
            $('.approveBtn').prop("disabled", true);
        });

        $(`.purchase-list-items`).repeater({
            show: function () {
                $(this).slideDown();
                InitAllDropDown();

                /** added delete button in new element  */
                $(this).find('.support-td').css('display', 'none');
                $(this).find('.delBtn').css('display', '');

                /** unit all select option remove in new element  */
                $(this).find('.unit').find('option').remove();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                    setTimeout(function(){ showGrandTotal(); }, 1000);
                }
            },
        });

        function InitAllDropDown() {
            $('.select2-container').remove();
            makeDropdownsSelect2();
        }

        function makeDropdownsSelect2() {
            //material and unit dropdown in purchase list
            $('.material-dropdown-select, .unit-dropdown-select').select2({
                selectOnClose: true,
            });
        }

        //date picker init
        $('input[name=purchase_date]').pickadate({
            format: 'yyyy-mm-dd',
            drops: 'up',
        });


</script>
@endpush
