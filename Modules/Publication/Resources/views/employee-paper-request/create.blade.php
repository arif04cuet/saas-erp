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
                            @if ($page == 'create')
                                @lang('publication::research-paper-free-request.create')
                            @else
                                @lang('publication::research-paper-free-request.edit')
                            @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('publication::employee-paper-request.form')
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
    @if ($page == 'edit')
        <script>
            $(document).ready(function() {
                var publicationId = $('.published_research_paper').val();
                getAvailableAmount(publicationId);
            });
        </script>
    @endif

    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <script>
        $(document).ready(function() {
            validateForm('.employee-paper-request-form');
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
                var publicationId = this.value;
                getAvailableAmount(publicationId);
            });
        }

        function getAvailableAmount(publicationId) {
            $('.quantity').removeAttr("readonly");
            let url = "{{ url('publication/get-inventory-available-amaount') }}";
            $.get(url + '/' + publicationId, function(data) {
                available_amount = data['available_amount'];
            });
        }
    </script>
@endpush
