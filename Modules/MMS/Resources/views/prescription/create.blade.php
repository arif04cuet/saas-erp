@extends('mms::layouts.master')
@section('title', trans('mms::prescription.title'))

@section('content')
    <div class="prescription">
        <div class="card p-2">
            <div class="card-header border-bottom pl-0">
                <h3 class="form-section">
                    <i class="ft-grid"></i> @lang('mms::prescription.title')
                </h3>
            </div>
            <div class="card-content ">
                <div class="card-body">
                    {!! Form::open(['route' =>  ['prescriptions.store'], 'class' => 'form', 'novalidate', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

                    {{--                    @include('mms::prescription.form.create.form')--}}
                    @include('mms::prescription.form.create.employee_list')
                    <div class="col-md-12 d-flex p-0">
                        <div class="col-md-6">
                            <h4 class="card-title">@lang('mms::prescription.tab.past_illness')</h4>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" name="past_illness" rows="8"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4 class="card-title">@lang('mms::prescription.tab.symptoms')</h4>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" name="symptoms" rows="8"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('mms::prescription.form.create.oe')
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="base-tab11" data-toggle="tab"
                                               aria-controls="tab11"
                                               href="#tab11"
                                               aria-expanded="true"
                                               style="min-width: 90px; text-align: center"><b>@lang('mms::prescription.tab.medicine')</b></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab12" data-toggle="tab" aria-controls="tab12"
                                               href="#tab12"
                                               aria-expanded="false"
                                               style="min-width: 90px; text-align: center"><b>@lang('mms::prescription.tab.attachment')</b></a>
                                        </li>


                                    </ul>
                                    <div class="tab-content px-1 pt-1">
                                        <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true"
                                             aria-labelledby="base-tab11">

                                            @include('mms::prescription.form.create.medicineTable')
                                            @include('mms::prescription.form.create.testTable')

                                        </div>

                                        <div class="tab-pane" id="tab12" aria-labelledby="base-tab12">
                                            <br>
                                            <h4 class="card-title">@lang('mms::prescription.prescriptions_attachment')</h4>
                                            <div class="col-md-6 col-md-offset-3">

                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>@lang('mms::medicine_distribution.image_size')</label>
                                                        <input class="form-control" accept=".png, .jpg, .jpeg"
                                                               name="acknowledgement_slip" type="file">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-12">
                            <h4 class="card-title">@lang('mms::prescription.tab.comments')</h4>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" name="comments" rows="8"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="form-actions text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="ft-check-square "></i> {{ trans('labels.save') }}
                        </button>
                        <button class="btn btn-warning" type="button"
                                onclick="window.location = '{{ route('prescriptions.index') }}'">
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
@push('page-css')
    <!-- checkbox css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>

    <script>
        $(`.repeater-medicine`).repeater({
            initEmpty: true,
            show: function () {
                $(this).find('.select2-container').remove();
                $(this).find('select').select2({selectOnClose: true});
                // $('.medicine_name').addClass('hidden');
                $(this).slideDown();
            },

        });

        $(`.repeater-test`).repeater({
            initEmpty: true,
        });

        $(`.repeater-oe`).repeater({
            initEmpty: false,
        });

        $(document).ready(function () {
            InitAllDropDown();
            validateForm('.patient-form');
            @if($page == 'edit')
            if ($('input[name="type"]:checked').val() !== 'employee') {
                $('.txt-div').show();
                $('.dropdown-div').hide();
                $('.dropdown-name').removeClass('required');
            } else {
                $('.txt-div').hide();
                $('.dropdown-div').show();
                $('.dropdown-name').addClass('required');
            }
            @endif
        });

        function InitAllDropDown() {
            $('.select2-container').remove();
            $('.employee-select').select2({
                selectOnClose: true,
            });
        }

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
                        alert("{{__('mms::prescription.duplicate_select_error')}}");
                        categorySelector.val('');
                        categorySelector.focus();
                        categoryId = "";
                        $(categorySelector).select2({
                            placeholder: "{{__('labels.select')}}",
                            allowClear: true // This is for clear get the clear button if wanted
                        });
                    }

                });
            }


            var token = '<?php echo csrf_token() ?>';
            let url = `{{ route('inventories.prescribed.quantity') }}`;
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                data: {'_token': token, 'medicineId': categoryId},
                success: function (data) {
                    $('input[name="medicine[' + repeaterIndex + '][piece]"]').attr('maxlength', data);
                    $('input[name="medicine[' + repeaterIndex + '][piece]"]').attr('data-rule-max', data);
                    $('input[name="medicine[' + repeaterIndex + '][piece]"]').attr('max', data);
                    var max_msg = "{{__('labels.Please enter a value less than')}}" + data;
                    $('input[name="medicine[' + repeaterIndex + '][piece]"]').attr('data-msg-max', max_msg);
                    var in_stock = "{{trans('mms::medicine_distribution.in_stock')}} ";
                    $('label[name="medicine[' + repeaterIndex + '][max]"]').text(in_stock + data);
                }

            });

        }
    </script>
@endpush
