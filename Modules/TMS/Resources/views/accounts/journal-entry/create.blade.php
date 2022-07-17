@extends('tms::layouts.master')
@section('title', trans('accounts::journal.title'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- General Information -->
                        <h4><i class="la la-tag"></i>
                            @lang('accounts::accounts.general_information')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' =>  'tms.journal-entries.store',
                                'class' => 'form tms-journal-entry-form']) !!}
                                         @include('tms::accounts.journal-entry.form')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('page-css')

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <!-- checkbox css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

@endpush

@push('page-js')

    <!-- pickadate -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <!-- custom -->
    <script src="{{ asset('js/tms-accounts/journal-entry.js') }}"></script>
    <script>
        const placeholder = @json(trans('labels.select'));
        const allBudgetMaxValues = @json($maxBudgetValues);
        const tmsSubSectors = @json($tmsSubSectors);
        let budgetMaxValues;
        $(document).ready(function () {
            initAllRepeater('.tms-journal-entry-repeater');
            validateForm('.tms-journal-entry-form');
            validateJournalEntryForm()
            $('input[name="date"]').pickadate({
                format: 'yyyy-mm-dd'
            });
            makeDropdownNotSelectable();
            changeElementVisibility('.employee-dropdown', false);
            changeElementVisibility('.radio-options', false);
            // toggle required attributes
            toggleRequiredAttribute('.select-employee', false)
            toggleRequiredAttribute('input[name=advance_entry]', false)

        });

        function validateJournalEntryForm() {
            var maxLengthMessage = '{{trans('labels.At most 50 characters')}}';
            // to title field
            $('input[name="title"]').rules("add", {
                messages: {
                    maxlength: maxLengthMessage,
                }
            });

            $('.text-remark').rules("add", {
                messages: {
                    maxlength: maxLengthMessage,
                }
            });
        }

        function addMaxValidationToCredit(element) {
            if (!$('.training-select').val()) {
                return;
            }
            var value = $(element).val();
                var max = budgetMaxValues[value];
            var name = $(element).attr("name");
            var index = getNumberFromString(name);
            var debitPattern = "tms_journal_entries[" + index + "][debit_amount]";
            debitPattern = $('input[name="' + debitPattern + '"]');
            message = '{{trans('labels.budget_exceed_message')}}' + ' ' + '{{trans('labels.max_validate_equal_or_less',['max'=>':id'])}}';
            $(debitPattern).rules("add", {
                max: max,
                messages: {
                    max: jQuery.validator.format(message.replace(":id", '{0}'))
                }
            });
        }

        $('input[name=is_advance_payment]').on('ifChanged', function () {
            if ($(this).is(":checked")) {
                changeElementVisibility('.employee-dropdown', true)
                changeElementVisibility('.radio-options', true)
                // toggle hidden attribute
                toggleRequiredAttribute('.select-employee', true)
                toggleRequiredAttribute('input[name=advance_entry]', true)
            } else {
                changeElementVisibility('.employee-dropdown', false);
                changeElementVisibility('.radio-options', false);
                // toggle hidden attribute
                toggleRequiredAttribute('.select-employee', false)
                toggleRequiredAttribute('input[name=advance_entry]', false)
            }
        });
    </script>
@endpush
