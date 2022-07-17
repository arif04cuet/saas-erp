@extends('ims::layouts.master')
@section('title', trans('ims::inventory.item.title') . ' ' . trans('labels.create'))

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <h4 class="card-title">
                        @lang('ims::inventory.item.title') @lang('labels.create')

                    </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @include('ims::inventory.item.form')
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
            showTotal();
            showRevisedTotal();
        });

        let inventoryItemsRepeater = $(`.repeater-inventory-items`).repeater({
            show: function () {
                // $("input,textarea,select").not("[type=submit]").jqBootstrapValidation("destroy");
                $(this).slideDown();
                $('input,select,textarea,text').jqBootstrapValidation();
                // $("input,textarea,select").not("[type=submit]").jqBootstrapValidation();
            },
            hide: function (deleteElement) {
                if (confirm('{{__('labels.confirm_delete')}}')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // making the first item not deletable
            isFirstItemUndeletable: true

        });

    </script>

@endpush
