<h4 class="form-section"><i class="la la-tag"></i>@lang('pms::project_budget.title')</h4>
<div class="row">
    <div class="table-responsive col-sm-12">
        <table class="table table-bordered text-center project-budgets">
            <thead>
                <tr>
                    <th width="22%">@lang('accounts::fiscal-year.title')</th>
                    <th width="22%">@lang('accounts::economy-code.title')</th>
                    <th width="22%">@lang('pms::project_budget.activity')</th>
                    <th width="11%">@lang('pms::project_budget.budget')</th>
                    <th width="11%">@lang('pms::project_budget.revised_budget')</th>
                    <th width="11%">@lang('pms::project_budget.expense')</th>
                    <th width="1%">
                        <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer"
                            id="repeater_create"></i>
                    </th>
                </tr>
            </thead>
            <tbody data-repeater-list="peoject-budget-entries">
                <!-- edit form start -->
                @if ($page == 'edit')
                    @foreach ($projectBudget as $item)
                    <tr data-repeater-item>
            
                        <td>
                            {!! Form::select('fiscal_year_id', $fiscalYear, $item['fiscal_year_id'], ['class
                            ' => 'form-control fiscal-year-dropdown-select required', 'data-msg-required' 
                            => __('labels.This field is required')]) 
                            !!}

                        </td>
                        <td>
                            {!! Form::select('economy_code_id', $economyCode,$item['economy_code_id'], ['class' =>
                             'form-control economy-code-dropdown-select required', 
                             'data-msg-required' => __('labels.This field is required')]) !!}
                        </td>

                        <td>
                            {!! Form::select('activity_id', $activity,$item['activity_id'], ['class' =>
                             'form-control activity-dropdown-select required', 
                             'data-msg-required' => __('labels.This field is required')]) !!}
                        </td>

                        <td>
                        {!! Form::number('budget',$item['budget'], ['class' => 
                        'form-control required budget spin',
                        'data-msg-required' =>__('labels.This field is required'), 
                        'min' => 1, 'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'), 
                        'placeholder' => 'Amount']) !!}
                        <label class="warning d-block" name="in-stock"></label>
                        </td>

                        <td>
                            {!! Form::number('revised_budget',$item['revised_budget'], ['class' => 
                            'form-control required revised_budget spin',
                            'data-msg-required' =>__('labels.This field is required'), 
                            'min' => 1, 'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'), 
                            'placeholder' => 'Amount']) !!}
                        <label class="warning d-block" name="in-stock"></label>
                        </td>

                        <td>
                            {!! Form::number('expense',$item['expense'], ['class' => 
                            'form-control expense spin',
                            'min' => 1, 'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'), 
                            'placeholder' => 'Amount']) !!}
                        <label class="warning d-block" name="in-stock"></label>
                        </td>

                            

                        <td><i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                        </td>
                    </tr>

                    @endforeach
                @else
                    <tr data-repeater-item>

                        <td>
                            {!! Form::select('fiscal_year_id', $fiscalYear, null, ['class' =>
                             'form-control fiscal-year-dropdown-select required', 'data-msg-required'
                              => __('labels.This field is required')])
                            !!}
                        </td>
                        
                        <td>
                            {!! Form::select('economy_code_id', $economyCode, null, ['class' =>
                             'form-control economy-code-dropdown-select required', 
                             'data-msg-required' => __('labels.This field is required')]) !!}
                        </td>

                        <td>
                            {!! Form::select('activity_id', $activity, null, ['class' =>
                             'form-control activity-dropdown-select required', 
                             'data-msg-required' => __('labels.This field is required')]) !!}
                        </td>

                        <td>
                        {!! Form::number('budget', null, ['class' => 
                        'form-control required budget spin', 
                        'data-msg-required' =>__('labels.This field is required'), 
                        'min' => 1, 'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'), 
                        'placeholder' => 'Amount']) !!}
                        <label class="warning d-block" name="in-stock"></label>
                        </td>

                        <td>
                            {!! Form::number('revised_budget',null, ['class' => 
                            'form-control required revised_budget spin',
                            'data-msg-required' =>__('labels.This field is required'), 
                            'min' => 1, 'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'), 
                            'placeholder' => 'Amount']) !!}
                        <label class="warning d-block" name="in-stock"></label>
                        </td>

                        <td>
                            {!! Form::number('expense',null, ['class' => 
                            'form-control expense spin',
                            'min' => 1, 'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'), 
                            'placeholder' => 'Amount']) !!}
                        <label class="warning d-block" name="in-stock"></label>
                        </td>

                        <td><i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                        </td>
                    </tr>
                @endif
            </tbody>

        </table>

        <button class="btn btn-sm btn-primary" style="cursor: pointer" type="button"
            onclick="$('#repeater_create').trigger('click');">
            <i class="ft ft-plus"></i>@lang('labels.add')
        </button>
    </div>
</div>
