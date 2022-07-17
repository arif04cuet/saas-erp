<div class="card-body">
    @if($page == 'create')
        {!! Form::open(['route' =>  'budget-cost-centers.store', 'class' => 'form budget-cost-center-form', 'novalidate']) !!}
    @else
        {!! Form::open(['route' =>  ['budget-cost-centers.update', $budgetCostCenter->id], 'class' => 'form budget-cost-center-form', 'novalidate']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i
                class="la la-tag"></i>@lang('accounts::budget.cost_center.form_title')</h4>

        <!-- Date  and  Journal Dropdown -->
        <div class="row">
            <!-- Budget -->
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('accounts_budget_id', __('accounts::budget.title'),
                    ['class' => 'form-label required']) !!}
                    {!! Form::select('accounts_budget_id', $budgets, $page == 'create'? old('accounts_budget_id') :
                    $budgetCostCenter->accounts_budget_id, ['class' => "form-control", 'required',
                    'data-validation-required-message' => __('validation.required', ['attribute' => __('accounts::budget.title')]),
                    "placeholder" => trans('labels.select')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('accounts_budget_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('accounts_budget_id') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Accounts Economy Code With Sectors -->
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('economy_code', __('accounts::economy-code.title'),
                    ['class' => 'form-label required']) !!}
                    {!! Form::select('economy_code', $economyCodes, $page == 'create'? old('economy_code') :
                    $budgetCostCenter->economy_code, ['class' => "form-control select2",
                    ($page == 'edit')? 'disabled' : '', "placeholder" => trans('labels.select')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('economy_code'))
                        <div class="help-block text-danger">
                            {{ $errors->first('economy_code') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('budget_amount', __('accounts::budget.cost_center.amount_bdt'),
                    ['class' => 'form-label required']) !!}
                    {!! Form::number('budget_amount', $page == 'create'? old('budget_amount') :
                    $budgetCostCenter->budget_amount, ['class' => "form-control", "placeholder" =>
                    __('accounts::budget.cost_center.amount_bdt'), 'data-validation-required-message' =>
                    __('labels.This field is required')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('budget_amount'))
                        <div class="help-block text-danger">
                            {{ $errors->first('budget_amount') }}
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
                        <th>@lang('accounts::budget.cost_center.sector_title')</th>
                        <th>@lang('labels.code')</th>
                        <th>@lang('accounts::budget.cost_center.amount_bdt')</th>
                        <th>@lang('labels.sequence')</th>
                    </tr>
                    </thead>

                    <tbody data-repeater-list="cost_center_sectors">
                    @if($page == 'edit')
                        @php
                            $subTotal = 0;
                        @endphp
                        @foreach($sectors as $sector)
                            @php
                                $subTotal += empty($sector['amount']) ? 0 : $sector['amount'];
                            @endphp
                            <tr data-repeater-item>
                                <td><label>{{$sector['title']}}</label></td>
                                <td width="25%">
                                    {!! Form::label('code', $sector['code'], $sector['code'], ['class' =>
                                    "form-label"])!!}
                                    <input type="hidden" name="budget_sector_id" value="{{$sector['id']}}">
                                </td>
                                <!-- Revised Budget -->
                                <td>
                                    {!! Form::number('sector_budget_amount['.$sector['code'].']', $sector['amount'],
                                    ['class' => 'form-control input-sm sector-amount', 'onkeyup' => 'calculateTotal()'])!!}
                                </td>
                                <td>
                                    {!! Form::number('sequence['.$sector['code'].']', $sector['sequence'],
['class' => 'form-control input-sm'])!!}
                                </td>

                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tbody id="economy_sectors">
                    </tbody>
                    <tr class="text-highlight">
                        <td colspan="2"><strong>@lang('labels.total')</strong></td>
                        <td id="sector_total" style="font-weight: bold">
                            @if($page == 'edit')
                                {{$subTotal}}
                            @endif
                        </td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <!--/ Journal Item Details -->

    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-success">
            <i class="la la-check-square-o"></i>
            @if($page == 'create')
                @lang('labels.save')
            @else
                @lang('labels.edit')
            @endif
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('budget-cost-centers.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
