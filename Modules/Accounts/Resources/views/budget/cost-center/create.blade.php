@extends('accounts::layouts.master')
@section('title', trans('accounts::budget.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('accounts::budget.cost_center.title')
                            @if($page == 'create')
                                @lang('labels.create')
                            @else
                                @lang('labels.edit')
                            @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('accounts::budget.cost-center.form')
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

        $("#economy_code").change(function () {
            $.ajax({
                url: '{{url('accounts/get-sectors')}}/' + $(this).val(),
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $("#economy_sectors").empty();
                    $('#sector_total').html('');
                },
                success: function (data) {
                    $.each(data, function (index, val) {
                        $html = "<tr>" +
                            "<td><label>" + val['title'] + "</label></td>" +
                            "<td><label>" + val['economy_sector_code'] + "</label></td>" +
                            "<td><input type='text' onkeyup='calculateTotal()' name='sector_budget_amounts[" + val['economy_sector_code'] + "]'" +
                            "placeholder='Amount in BDT' class='form-control input-sm sector-amount' maxlength='10' >" +
                            "<td><input type='text' placeholder='Sequence'" +
                            "name='sequence[" + val['economy_sector_code'] + "]' class='form-control input-sm'></td>" +
                            "<tr>";
                        $("#economy_sectors").append($html);
                    })
                }
            });
        });

        function calculateTotal() {
            let sectorTotal = 0;
            $('.sector-amount').each(function () {
                sectorTotal += $(this).val() ? parseInt($(this).val()) : 0;
            });
            $('#sector_total').html(sectorTotal);
            return sectorTotal;
        }

        $('.budget-cost-center-form').on('submit', function () {
            $sectorTotal = calculateTotal();
            $budgetAmount = $('#budget_amount').val();
            if ( $sectorTotal > $budgetAmount) {
                alert('@lang('accounts::budget.validation.budget_overflow')');
                $('#sector_total').css('color', 'red');
                return false;
            }
            return true;
        });

    </script>

@endpush
