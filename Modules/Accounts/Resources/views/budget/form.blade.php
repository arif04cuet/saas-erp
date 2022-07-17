<div class="card-body">
    @if($page == 'create')
        {!! Form::open(['route' =>  'budgets.store', 'class' => 'form journal-entry-form']) !!}
    @else
        {!! Form::open(['route' =>  ['budgets.update', $budget->id], 'class' => 'form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i
                class="la la-tag"></i>@lang('accounts::budget.budget_info')</h4>

        <!-- Date  and  Journal Dropdown -->
        <div class="row">
            <!-- Date  -->
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('title', trans('labels.title'), ['class' => 'form-label required']) !!}
                    {{ Form::text('title', $page == 'create'? old('title') : $budget->title, ['class' => 'form-control',
                     'placeholder' => __('labels.title'), 'required']) }}
                </div>
                <!-- error message -->
                @if ($errors->has('title'))
                    <div class="help-block text-danger">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>

            <!-- Journal -->
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('fiscal_year_id', trans('accounts::fiscal-year.title'), ['class' => 'form-label required']) !!}
                    {!! Form::select('fiscal_year_id', $fiscalYears, $page == 'create'? old('fiscal_year_id') :
                    $budget->fiscal_year_id, ['class' => "form-control",
                    "placeholder" => trans('labels.select'), 'required']) !!}
                    <div class="help-block"></div>
                    <!-- error message -->
                    @if ($errors->has('fiscal_year_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('fiscal_year_id') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Journal Items Details -->
        <h4 class="form-section"><i
                class="la la-tag"></i>@lang('accounts::budget.sector_details')</h4>
        <div class="row">
            <div class="table-responsive col-sm-12">
                <table class="table table-bordered text-center repeater-budget-items">
                    <thead>
                    <tr>
                        <td></td>
                        <th colspan="3">@lang('accounts::budget.budget_split_for_fiscal_year')</th>
                        <th colspan="3">@lang('accounts::budget.revised_budget_split')</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>@lang('accounts::accounts.title')</th>
                        <th>@lang('accounts::budget.local_budget')</th>
                        <th>@lang('accounts::budget.revenue_budget')</th>
                        <th>@lang('labels.total')</th>
                        <th>@lang('accounts::budget.local_budget')</th>
                        <th>@lang('accounts::budget.revenue_budget')</th>
                        <th>@lang('labels.total')</th>
                        <th width="1%">
                            <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer"
                               id="repeater_create"></i>
                        </th>
                    </tr>

                    </thead>
                    <tbody data-repeater-list="budget_entries">

                    @if($page == 'edit')
                        @foreach($budget->sectors as $sector)
                            <tr data-repeater-item>
                                <td width="20%">
                                    {!! Form::select('code', $economyCodes, $sector->code, ['class' =>
                                    "form-control account-dropdown-select", "required"])!!}
                                    <input type="hidden" name="budget_amount_id" value="{{$sector->id}}">
                                </td>

                                <!-- Budget -->
                                <td>
                                    {!! Form::number('local_amount', $sector->local_amount,
                                    ['class' => 'form-control local-amount', 'onkeyup' =>  'calculateTotal(this.name)'])!!}
                                </td>
                                <td>
                                    {!! Form::number('revenue_amount', $sector->revenue_amount,
                                ['class' => 'form-control revenue-amount', 'onkeyup' =>  'calculateTotal(this.name)'])!!}
                                </td>
                                <td>
                                    {!! Form::text('local_total', ($sector->local_amount + $sector->revenue_amount),
                                    ['class' => 'form-control']) !!}
                                </td>

                                <!-- Revised Budget -->
                                <td>
                                    {!! Form::number('revised_local_amount', $sector->revised_local_amount,
                                ['class' => 'form-control revised-local-amount', 'onkeyup' =>  'calculateRevisedTotal(this.name)'])!!}
                                </td>
                                <td>
                                    {!! Form::number('revised_revenue_amount', $sector->revised_revenue_amount,
                                    ['class' => 'form-control revised-revenue-amount', 'onkeyup' =>  'calculateRevisedTotal(this.name)'])!!}
                                </td>
                                <td>
                                    {!! Form::text('revised_total', ($sector->revised_local_amount +
$sector->revised_revenue_amount), ['class' => 'form-control ']) !!}
                                </td>

                                <td>
                                    <i data-repeater-delete class="la la-trash-o text-danger"
                                       style="cursor: pointer"></i>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <tr data-repeater-item>
                        <!-- account dropdown -->
                        <td width="25%">
                            {!! Form::select('code', $economyCodes, null, ['class' =>
                            "form-control account-dropdown-select", "required"])!!}
                        </td>

                        <!-- Budget -->
                        <td> {!! Form::number('local_amount', null,['class' => 'form-control local-amount',
'onkeyup' =>  'calculateTotal(this.name)'])!!}</td>
                        <td> {!! Form::number('revenue_amount', null,['class' => 'form-control revenue-amount',
'onkeyup' =>  'calculateTotal(this.name)'])!!}</td>
                        <td> {!! Form::number('local_total', null,['class' => 'form-control' ])!!}</td>

                        <!-- Revised Budget -->
                        <td> {!! Form::number('revised_local_amount', null,['class' => 'form-control revised-local-amount',
'onkeyup' =>  'calculateRevisedTotal(this.name)'])!!}</td>
                        <td> {!! Form::number('revised_revenue_amount', null,['class' => 'form-control revised-revenue-amount',
'onkeyup' =>  'calculateRevisedTotal(this.name)'])!!}</td>
                        <td> {!! Form::number('revised_total', null,['class' => 'form-control'])!!}</td>

                        <td><i data-repeater-delete class="la la-trash-o text-danger"
                               style="cursor: pointer"></i>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="font-weight-bold">@lang('labels.total')</td>
                        <td>
                            <div class="font-weight-bold" id="local_total"></div>
                        </td>
                        <td>
                            <div class="font-weight-bold" id="revenue_total"></div>
                        </td>
                        <td>
                            <div class="font-weight-bold" id="budget_total"></div>
                        </td>
                        <td>
                            <div class="font-weight-bold" id="revised_local_total"></div>
                        </td>
                        <td>
                            <div class="font-weight-bold" id="revised_revenue_total"></div>
                        </td>
                        <td>
                            <div class="font-weight-bold" id="revised_total"></div>
                        </td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>

                <button class="btn btn-sm btn-primary" style="cursor: pointer" type="button"
                        onclick="$('#repeater_create').trigger('click');">
                    <i class="ft ft-plus"></i>@lang('labels.add')
                </button>
            </div>
        </div>
        <!--/ Journal Item Details -->

    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-success" id="submit">
            <i class="la la-check-square-o"></i>
            @if($page == 'create')
                @lang('labels.save')
            @else
                @lang('labels.edit')
            @endif
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('budgets.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
@push('page-js')
    <script>
        let budget_for_validation = 0;
        let revised_budget_for_validation = 0;

        $('#submit').on('click', function(e) {
            if(budget_for_validation <= 0 || revised_budget_for_validation <= 0) {
                let validation_message = "{{ trans('accounts::budget.validation.zero_budget')}}"
                alert(validation_message);
                e.preventDefault();
            }
        })
       
        function calculateTotal(name) {
            $index = name.match(/\d+/).toString();
            $localAmount = $("input[name='budget_entries[" + $index + "][local_amount]']");
            $revenueAmount = $("input[name='budget_entries[" + $index + "][revenue_amount]']");
            $totalBudget = $("input[name='budget_entries[" + $index + "][local_total]']");
            $totalAmount = Number($localAmount.val()) + Number($revenueAmount.val());
            $totalBudget.val($totalAmount);
            showTotal();
            //console.log($totalAmount    );
        }

        function calculateRevisedTotal(name) {
            $index = name.match(/\d+/).toString();
            $localAmount = $("input[name='budget_entries[" + $index + "][revised_local_amount]']");
            $revenueAmount = $("input[name='budget_entries[" + $index + "][revised_revenue_amount]']");
            $totalBudget = $("input[name='budget_entries[" + $index + "][revised_total]']");
            $totalAmount = Number($localAmount.val()) + Number($revenueAmount.val());
            $totalBudget.val($totalAmount);
            showRevisedTotal();
            //console.log($totalAmount    );
        }

        function showTotal() {
            let localTotal = 0;
            let revenueTotal = 0;
            $('.local-amount').each(function () {
                localTotal += Number($(this).val());
            });
            $('.revenue-amount').each(function () {
                revenueTotal += Number($(this).val());
            });
            $('#local_total').html(localTotal);
            $('#revenue_total').html(revenueTotal);
            $('#budget_total').html(Number(localTotal) + Number(revenueTotal));
            budget_for_validation = Number(localTotal) + Number(revenueTotal);
        }

        function showRevisedTotal() {
            let revisedLocalTotal = 0;
            let revisedRevenueTotal = 0;
            $('.revised-local-amount').each(function () {
                revisedLocalTotal += Number($(this).val());
            });
            $('.revised-revenue-amount').each(function () {
                revisedRevenueTotal += Number($(this).val());
            });
            $('#revised_local_total').html(revisedLocalTotal);
            $('#revised_revenue_total').html(revisedRevenueTotal);
            $('#revised_total').html(Number(revisedLocalTotal) + Number(revisedRevenueTotal));
            revised_budget_for_validation = Number(revisedLocalTotal) + Number(revisedRevenueTotal);
        }

    </script>
@endpush
