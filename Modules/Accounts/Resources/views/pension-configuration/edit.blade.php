@extends('accounts::layouts.master')
@section('title', trans('accounts::pension.configuration.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('accounts::pension.configuration.create')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('accounts::pension-configuration.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $initialPensionRuleData = [];

        if($pensionConfiguration->rules->count())
        {
             $initialPensionRuleData = $pensionConfiguration->rules->map(function ($rule) {
                return [
                    'id' => $rule->id,
                    'name' => $rule->name,
                    'type' => $rule->type,
                    'condition' => $rule->condition,
                    'amount_type' => $rule->amount_type,
                    'percentage_amount' => $rule->percentage_amount,
                    'fixed_amount' => $rule->fixed_amount,
                ];
            });
        }
    @endphp

@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush


@push('page-js')
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            hideElements();

            let PensionRuleRepeaterContainer = $('.pension-rule-repeater'),
                initialPensionRuleData = @json($initialPensionRuleData, JSON_UNESCAPED_UNICODE);
            let pensionRuleFormRepeater = PensionRuleRepeaterContainer.repeater({
                show: function () {
                    $(this).slideDown();
                },
                defaultValues: {
                    'type': 'allowance',
                    'condition': 'always_true',
                    'amount_type': 'fixed_amount',
                    'fixed_amount': '0',
                    'percentage_amount': '0',
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
            // bind change method to amount type
            bindAmountTypeChange();
            if (initialPensionRuleData.length) {
                pensionRuleFormRepeater.setList(initialPensionRuleData);
                adjustDropdown();
            }
        });


        function bindAmountTypeChange() {
            $(document).on('change', '.amount-type', function () {
                let value = $(this).val();
                let index = parseInt(getNumberFromString($(this).attr('name')));
                toggleHiddenElement(value, index);
            })
        }


        function hideElements() {
            $('.percentage_div').hide();
        }

        function getNumberFromString(name) {
            return name.replace(/[^0-9]/g, '');
        }

        function toggleHiddenElement(needle, index) {
            let amountTypes = @json(\Illuminate\Support\Facades\Config::get('constants.pension.rule.amount_type'));
            // iterate over each amount types
            $.each(amountTypes, function (key, value) {
                if (key === needle) {
                    $('input[name="pension[' + index + '][' + key + ']"]').parent().parent().closest('div').show();
                } else {
                    $('input[name="pension[' + index + '][' + key + ']"]').parent().parent().closest('div').hide();
                }
            });
        }

        function adjustDropdown() {
            $('.amount-type').each(function (index) {
                let indexNumber = parseInt(getNumberFromString($(this).attr('name')));
                let value = $(this).val();
                toggleHiddenElement(value, indexNumber);
            });
        }
    </script>

@endpush
