@extends('accounts::layouts.master')
@section('title', trans('accounts::pension.monthly.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('accounts::pension.contract.title')
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
                            @include('accounts::monthly-pension.contract.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')

    <script>
        $('#receiver').change(function () {
            $receiver = $(this).val();
            if ($receiver == '{{array_keys(config('constants.pension.contract.receiver_type'))[1]}}') {
                $('#nominee_dropdown').show();
                fetchNominees();
            } else {
                $('#nominee_dropdown').hide();
            }
        });

        $('#receiver').trigger('change');

        function fetchNominees() {
            $employeeId = $('#employee_id').val();
            if ($('#receiver').val() == 'nominee' && $employeeId) {
                $.ajax({
                    url: '{{url('accounts/pension/fetch-nominees')}}/' + $employeeId,
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        $("#nominee_id").empty();
                        $.each(data, function (index, value) {
                            $("#nominee_id").append("<option value='" + index + "'>" + value + "</option>");
                        })
                    }
                });
            }
        }

        $("#employee_id").change(function () {
            fetchNominees();
            $hasIncrement = $('input[name=has_payroll_increment]:checked').val();
            $.ajax({
                url: '{{url('accounts/pension/initial-basic')}}/' + $(this).val() + '/' + $hasIncrement,
                type: 'get',
                success: function (data) {
                    $("#initial_basic").val(data);
                    $("#current_basic").val(data);
                    $("#increment").val(0);
                }
            });
        });

        $("#increment").change(function () {
            $currentBasic = $("#initial_basic").val();
            if ($currentBasic === "") {
                return;
            }
            $increment = $(this).val();
            for ($i = 1; $i <= $increment; $i++) {
                $incrementAmount = $currentBasic * 0.05;
                $currentBasic = parseFloat($currentBasic) + parseFloat($incrementAmount);
            }
            if ($increment > 0) {
                $("#current_basic").val($currentBasic.toFixed(2));
            } else {
                $("#current_basic").val($("#initial_basic").val());
            }
        });

        $("#disbursement_type").change(function () {
            if ($(this).val() === 'bank') {
                $("#bank_div").show();
                // $('#bank_account_information').val('');
            } else {
                $("#bank_div").hide();
                $('#bank_account_information').val('null');

            }
        });

        $('input[name=has_payroll_increment]').click(function () {
            $('#employee_id').trigger('change');
        });

        $('#disbursement_type').trigger('change');
    </script>


@endpush
