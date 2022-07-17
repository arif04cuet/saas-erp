@extends('accounts::layouts.master')
@section('title', trans('accounts::salary-rule.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('accounts::salary-rule.title')
                            @if($page == 'create')
                                @lang('labels.create')
                            @elseif($page == 'edit')
                                @lang('labels.edit')
                            @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                            @include('accounts::payroll.salary-rule.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script>

        $(document).ready(function () {

            let manageConditionInput = function () {
                var condition = $('#condition_type').val();
                if (condition == 1) {
                    $('.con-range').hide();
                    $('.con-expression').hide();
                } else if (condition == 2) {
                    $('.con-range').show();
                    $('.con-expression').hide();
                }else if (condition == 3){
                    $('.con-expression').show();
                    $('.con-range').hide();
                }
            };

            manageConditionInput();

            $('#condition_type').on('change', function () {
                manageConditionInput();
            });

            let manageAmountInput = function () {
                var amount_type = $('#amount_type').val();
                if (amount_type == 1) {
                    $('.amt-parc').hide();
                    $('.amt-fix').show();
                } else if (amount_type == 2) {
                    $('.amt-parc').show();
                    $('.amt-fix').hide();
                }
                else {
                    $('.amt-fix').hide();
                    $('.amt-parc').hide();
                }
            };

            manageAmountInput();

            $('#amount_type').on('change', function () {
                manageAmountInput();
            });

            let salaryRules = <?php echo $salaryRulesJson; ?>;

            $("#salary_rules").change(function () {
                var rules = $(this).val();
                $("#salary-rules-table > tbody").empty();
                $.each(rules, function (index, val) {
                    $("#salary-rules-table > tbody:last-child").append(
                        "<tr><td>" + (index +1) + "</td>" +
                        "<td><a href='"+ salaryRules[val]['url'] +"' target='_blank'> " + salaryRules[val]['name'] + "</a>" +
                        "<td>" + salaryRules[val]['code'] + "</td>" +
                        "<td>" + salaryRules[val]['category'] + "<td>" + salaryRules[val]['contribution_register'] + "</td>" +
                        "</tr>"
                    );
                })

            });

            $('#salary_rules').trigger('change');

        });

        $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );

        function getDecimal(elementId) {
            $element = $("#"+ elementId);
            $element.val($element.val().replace(/\D/g,''));
        }

    </script>
@endpush
