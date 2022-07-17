@extends('publication::layouts.master')
@section('title', trans('publication::research-paper-free-request.index'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('publication::research-paper-free-request.create')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('publication::research-paper-free-request.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <!-- checkbox css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush


@push('page-js')

    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <script>
        $(document).ready(function() {
            hideReferenceTypeForm();
            validateForm('.research-paper-free-request-form');
            checkAvailablePublicationAmount();
        });


        var available_amount;
        $('.quantity').on("change", function() {
            var amount = $(this).val();
            if (amount > available_amount) {
                modifyDurationValidation(available_amount);
            }
        });

        function modifyDurationValidation(max) {
            message = '{{ trans('labels.max_validate_equal_or_less', ['max' => ':id']) }}'
            $('.quantity').rules("add", {
                max: max,
                messages: {
                    max: jQuery.validator.format(message.replace(":id", '{0}'))
                }
            });
        }


        function checkAvailablePublicationAmount() {
            $('.published_research_paper').on('change', function() {
                $('.quantity').removeAttr("readonly");
                var publicationId = this.value;
                let url = "{{ url('publication/get-inventory-available-amaount') }}";
                $.get(url + '/' +
                    publicationId,
                    function(data) {
                        available_amount = data['available_amount'];
                    });
            });
        }

        function hideReferenceTypeForm() {
            if ($('input[name=reference_type]:checked').val() == "employee") {
                changeReferenceTypeVisibility("employee")
            } else if ($('input[name=reference_type]:checked').val() == "organization") {
                changeReferenceTypeVisibility("organization")
            } else {
                changeReferenceTypeVisibility("HideAll")
            }
        }

        $('input[name=reference_type]').on('ifClicked', function() {
            if ($(this).val() == "employee") {
                changeReferenceTypeVisibility("employee")
            } else if ($(this).val() == "organization") {
                changeReferenceTypeVisibility("organization")
            }
        });


        function changeReferenceTypeVisibility(flag) {
            if (flag == 'employee') {
                showEmployeeDropdown();
            } else if (flag == 'organization') {
                showOrganizationDropdown();
            } else {
                hideBothDropdown();
            }
        }

        function showEmployeeDropdown() {
            $('.reference-type-employee').show();
            $('.reference-type-organization').hide();
            $('.reference_employee').addClass('required');
            $('.reference_organization').removeClass('required');
            $('.reference_employee').attr("name", "reference_id");
            $('.reference_organization').removeAttr("name");
        }

        function showOrganizationDropdown() {
            $('.reference-type-organization').show();
            $('.reference-type-employee').hide();
            $('.reference_organization').addClass('required');
            $('.reference_employee').removeClass('required');
            $('.reference_organization').attr("name", "reference_id");
            $('.reference_employee').removeAttr("name");

        }

        function hideBothDropdown() {
            $('.reference-type-organization').hide();
            $('.reference-type-employee').hide();
            $('.reference_employee').removeClass('required');
            $('.reference_organization').removeClass('required');
        }
    </script>
@endpush
