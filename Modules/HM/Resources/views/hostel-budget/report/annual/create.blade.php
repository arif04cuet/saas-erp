@extends('hm::layouts.master')
@section('title', __('hm::report.budget.annual.title'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="repeat-form">
                            @lang('hm::report.budget.annual.index')
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
                            @include('hm::hostel-budget.report.annual.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <!-- checkbox Related -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
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

    <!-- custom js -->
    <script src="{{ asset('js/check-in/checkin.js') }}"></script>
    <script src="{{ asset('js/check-in/approved-training.js') }}"></script>
    <script>
        let placeholder = '{!! trans('labels.select') !!}';
        let print = '{!! trans('labels.print') !!}';
        let errorMessage = '{!! trans('hm::report.budget.annual.form_elements.card_title') !!}';
        let genericErrorMessage = '{!! trans('labels.generic_error_message') !!}';
        $(document).ready(function () {
            $('.information-section').hide();
        });

        // this is the id of the form
        $(".hm-annual-budget-report-form").submit(function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            let hostelBudgetTitleId = $('select[name=hostel_budget_title_id]').val();
            if (!hostelBudgetTitleId) {
                alert(errorMessage);
                return;
            }
            ;
            let url = '{{route('hm.accounts.report.annual-budgets.create',":id")}}';
            url = url.replace(":id", hostelBudgetTitleId);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    $('.dynamic-content').html(data);
                    $('.information-section').show();
                    $('.print-button').html(getPrintDiv(hostelBudgetTitleId));
                },
                error: function (request, status, error) {
                    alert(genericErrorMessage);
                    return;
                }
            });
        })

        function getPrintUrl(hostelBudgetTitleId) {
            let url = '{{route('hm.accounts.report.annual-budgets.print',":id")}}';
            url = url.replace(":id", hostelBudgetTitleId);
            return url;
        }

        function getPrintDiv(hostelBudgetTitleId) {
            $('.print-button').html('');
            let div = `
                        <a href="${getPrintUrl(hostelBudgetTitleId)}" class="btn btn-sm btn-warning">
                            <i class="la la-print"></i>${print}
                        </a>
                `;
            return div;
        }
    </script>

@endpush
