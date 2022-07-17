@extends('ims::layouts.master')
@section('title', trans('ims::procurement.form_title'))

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <div class="heading-elements">
                        <ul class="list-inline">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                    <h4 class="card-title">
                        @lang('ims::procurement.title')
                        @if($page == 'create')
                            @lang('labels.create')
                        @else
                            @lang('labels.edit')
                        @endif
                    </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    @include('ims::procurement-billing.form')
                </div>
            </div>
        </div>

    </div>
@endsection


@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>
    <!-- Date Picker -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>


    <script>

        $(document).ready(function () {
            InitAllDropDown();
            showTotal();
        });

        let journalItemsRepeater = $(`.repeater-procurement-items`).repeater({

            show: function () {
               // $('input,select,textarea,text').jqBootstrapValidation('destroy');
                $(this).slideDown();
                // remove all the select2 container and reinitialise it
                InitAllDropDown();
                $(`.repeater-procurement-items`).draw(false);
                $('input,select,textarea,text').jqBootstrapValidation();

            },
            hide: function (deleteElement) {
                if (confirm('{{__('labels.confirm_delete')}}')) {
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
            // Account Dropdown
            $('.item-category-selector,.general-selector').select2({
                placeholder: "{{__('labels.select')}}",
                selectOnClose: true,
            });
        }

        function InitAllDropDown() {
            $('.select2-container').remove();
            makeDropdownsSelect2();
        }

        $('.pickadate').pickadate({
            max: new Date(),
        });

        $('.repeater-procurement-items').DataTable({
            paging: false,
            searching: false,
            scrollX: true,
            pageLength: false,
            info: false
        });
    </script>

@endpush
