<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> {{ trans('hm::hostel_budget.add_form_card_title') }}</h4>
    <div class="row">

        <div class="col-md-5">
            <div class="form-group {{ $errors->hostelBudget->has('hostel_budget_title_id') ? ' error' : '' }} ">
                {{ Form::label('hostel_budget_title_id', trans('hm::hostel_budget.budget_for') ,  ['class' => 'form-label required'])}}
                {{ Form::select('hostel_budget_title_id', $budgetTitles, null,
                    [
                        'class' => 'form-control required',
                        'placeholder' =>trans('labels.select'),
                        'data-msg-required'=> trans('labels.This field is required'),
                    ])
                }}
                <div class="help-block"></div>
                @if ($errors->hostelBudget->has('hostel_budget_title_id'))
                    <div class="help-block">  {{ $errors->hostelBudget->first('hostel_budget_title_id') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="repeater_hostel_budget">
                <div data-repeater-list="hostel_budgets">
                    @php
                        $oldBudget = old();
                    @endphp
                    @if(isset($oldBudget['hostel_budgets']) && count($oldBudget['hostel_budgets'])>0)
                        @foreach($oldBudget['hostel_budgets'] as $key => $budget)

                            <div data-repeater-item="" style="">
                                <div class="form row">
                                    <div
                                        class="form-group  mb-1 col-sm-12 col-md-5 {{ $errors->hostelBudget->has("hostel_budgets.".$key.".hostel_budget_section_id") ? 'error' : '' }}">

                                        {{ Form::label('hostel_budget_title_id', trans('hm::hostel_budget.section') ,  ['class' => 'form-label required'])}}
                                        {{ Form::select('hostel_budget_section_id', $budgetSections, $budget['hostel_budget_section_id'],
                                            [
                                                'placeholder' =>trans('labels.select'),
                                                'class' => ' form-control required ',
                                                'data-msg-required'=> trans('labels.This field is required'),

                                             ])
                                          }}
                                        <div class="help-block"></div>
                                        @if ($errors->hostelBudget->has("hostel_budgets.".$key.".hostel_budget_section_id"))
                                            <div
                                                class="help-block">  {{ trans('labels.This field is required')  }}</div>
                                        @endif

                                    </div>
                                    <div
                                        class="form-group  mb-1 col-sm-12 col-md-5 {{ $errors->hostelBudget->has("hostel_budgets.".$key.".budget_amount") ? 'error' : '' }}">
                                        {{ Form::label('budget_amount', trans('hm::hostel_budget.amount'), ['class' => 'required']) }}
                                        {{ Form::number('budget_amount', $budget['budget_amount'],
                                            [
                                                'class' => 'form-contro required',
                                                'min'=>0,
                                                'max'=>999999999,
                                                'data-rule-number'=>true,
                                                'data-msg-number'=> trans('labels.Please enter a valid number'),
                                                'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                                                'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                                                'data-msg-required'=> __('labels.This field is required')
                                             ])
                                          }}
                                        <div class="help-block"></div>
                                        @if ($errors->hostelBudget->has("hostel_budgets.".$key.".budget_amount"))
                                            <div
                                                class="help-block">  {{ trans('labels.This field is required')  }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                        <button type="button" class="btn btn-outline-danger"
                                                data-repeater-delete=""><i
                                                class="ft-x"></i>
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    @else
                        <div data-repeater-item="">
                            <div class="form row">
                                <div class="form-group mb-1 col-sm-12 col-md-5">
                                    {{--<br>--}}
                                    {{ Form::label('hostel_budget_section_id', trans('hm::hostel_budget.section'), ['class' => 'required']) }}
                                    {{--selectize-select--}}
                                    {{ Form::select('hostel_budget_section_id', $budgetSections, null,
                                            [
                                                'class' => 'item-select   form-control  required',
                                                'placeholder' =>trans('labels.select'),
                                                'data-msg-required'=> trans('labels.This field is required'),
                                             ])
                                     }}
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-5">
                                    {{ Form::label('budget_amount', trans('hm::hostel_budget.amount'), ['class' => 'required']) }}
                                    {{ Form::number('budget_amount', null,
                                             [
                                                 'class' => 'form-control required',
                                                 'min'=>0,
                                                 'max'=>999999999,
                                                 'data-rule-number'=>true,
                                                 'data-msg-number'=> trans('labels.Please enter a valid number'),
                                                 'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                                                 'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                                                 'data-msg-required'=> __('labels.This field is required')
                                             ])
                                     }}
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-sm-12 col-md-2 text-center mt-2" id="cd">
                                    <button type="button" class="btn btn-outline-danger"
                                            data-repeater-delete=""><i
                                            class="ft-x"></i>
                                    </button>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endif
                </div>
                <div class="form-group overflow-auto">
                    <div class="col-12">
                        <div class="text-center">
                            <b>@lang('labels.total'): <span id="total_budget_amount">0</span></b>
                        </div>
                        <button type="button" data-repeater-create=""
                                class="pull-right btn btn-sm btn-outline-primary addMoreBudgetSection">
                            <i class="ft-plus"></i> {{ trans('labels.add') }}
                        </button>
                    </div>
                </div>

                <div class="form-actions text-center">
                    <button type="submit" class="btn btn-primary submit">
                        <i class="la la-check-square-o"></i> {{ trans('labels.save') }}
                    </button>
                    <a class="btn btn-warning mr-1" role="button" href="{{ route('hostel-budgets.index') }}">
                        <i class="ft-x"></i> {{ trans('labels.cancel') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
