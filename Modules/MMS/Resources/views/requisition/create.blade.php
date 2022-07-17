@extends('mms::layouts.master')
@section('title', trans('mms::requisition.site_title'))
@section('content')
    <div class="prescription">
        <div class="card p-2">
            <div class="card-header border-bottom pl-0">
                <h3 class="form-section">
                    <i class="ft-grid"></i>  {{trans('mms::requisition.site_title')}}
                </h3>
            </div>
            <div class="card-content">
                <div class="card-body">
                    {!! Form::open(['route' =>  ['requisition.store'], 'class' => 'form form-prescribed', 'name'=>'prescribed','method' => 'post', 'enctype' => 'multipart/form-data']) !!}

                    @include('mms::requisition.form.create.form')
                    @include('mms::requisition.form.create.medicineTable')
                    <div class="form-actions text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="ft-check-square "></i> {{ trans('labels.save') }}
                        </button>
                        <button class="btn btn-warning" type="button" onclick="window.location = '{{ route('requisition.index') }}'">
                            <i class="ft-x"></i> {{ trans('labels.cancel') }}
                        </button>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>

@endsection

@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <script>
        $('.datepicker').pickadate({
            selectMonths: true,
            selectYears: true,
            format: 'd mmm yyyy'
        });
        let inventoryItems = @json($medicine);
        function loadItems(categoryObject) {
            let categoryId = categoryObject.options[categoryObject.selectedIndex].value;
            let objectName = categoryObject.name;
            let categorySelector = $('select[name="' + objectName + '"]');
            let repeaterIndex = objectName.match(/\d+/).toString();
            if (categorySelector.val() !== "") {
                $('.item-category-select').each(function () {
                    if (!isNaN($(this).val()) && objectName != $(this).attr('name') && categorySelector.val() == $(this).val()) {
                        alert("{{__('ims::inventory.duplicate_select_error')}}");
                        categorySelector.val('');
                        categorySelector.focus();
                        categoryId = "";
                        // $(categorySelector).select2("val", "");
                        $(categorySelector).select2({
                            placeholder: "{{__('labels.select')}}",
                            allowClear: true // This is for clear get the clear button if wanted
                        });
                    }

                });
            }

            var token='<?php echo csrf_token() ?>';
            $.ajax({
                type:'GET',
                url:'/mms/inventories/prescribed/inventory/quantity',
                dataType: 'json',
                data:{'_token':token,'medicineId':categoryId},
                success:function(data) {
                    // $('input[name="medicine['+repeaterIndex+'][piece]"]').attr('maxlength',data);
                    // $('input[name="medicine['+repeaterIndex+'][piece]"]').attr('data-rule-max',data);
                    // $('input[name="medicine['+repeaterIndex+'][piece]"]').attr('max',data);
                    {{--var max_msg="{{__('labels.Please enter a value less than')}}"+data;--}}
                    // $('input[name="medicine['+repeaterIndex+'][piece]"]').attr('data-msg-max',max_msg);
                    var in_stock="{{trans('mms::medicine_distribution.in_stock')}} ";
                    $('label[name="medicine['+repeaterIndex+'][max]"]').text(in_stock+data);
                }

            });

        }
        $(`.repeater-medicine`).repeater({
            initEmpty: true,
            show: function () {
                $(this).find('.select2-container').remove();
                $(this).find('select').select2({
                    placeholder:"{{trans('labels.select')}}"
                });

                $(this).slideDown();
            },

        });

        $(`.repeater-test`).repeater({
            initEmpty: true,
        });
        // $("form[name='prescribed']").validate();

        $(document).ready(function () {
            validateForm('.form-prescribed');

        });
    </script>

@endpush
