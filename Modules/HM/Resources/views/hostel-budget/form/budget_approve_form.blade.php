<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> {{ trans('hm::hostel_budget.approve_form_title') }} </h4>
    <div class="row">

        <div class="col-md-5">
            <div class="form-group">
                <div class="form-group {{ $errors->has('hostel_budget_title_id') ? ' error' : '' }}">
                    <h3>{{ $budgetWithTitles->name }}</h3>
                    {{--                    {{ Form::select('hostel_budget_title_id', $budgetTitles, isset($budgetWithTitles->id) ? $budgetWithTitles->id : null, ['disabled', 'class' => 'form-control', 'placeholder' => 'Select Budget Year', 'required' => 'required', 'data-validation-required-message'=>'Please select budget title']) }}--}}
                    {{ Form::hidden('hostel_budget_title_id', isset($budgetWithTitles->id) ? $budgetWithTitles->id : null ) }}
                    <div class="help-block"></div>
                    @if ($errors->has('hostel_budget_title_id'))
                        <div class="help-block">  {{ $errors->first('hostel_budget_title_id') }}</div>
                    @endif
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="repeater_hostel_budget">
                <div data-repeater-list="hostel_budgets">

                    @foreach($budgetWithTitles->hostelBudgets as $budget)
                        <div data-repeater-item="" style="">
                            <div class="form row">
                                {{ Form::hidden('id', $budget->id) }}
                                {{ Form::hidden('hostel_budget_title_id', $budgetWithTitles->id) }}


                                <div class="form-group mb-1 col-sm-12 col-md-4">
                                    {{ Form::label('hostel_budget_title_id', trans('hm::hostel_budget.section') ,  ['class' => 'form-label required'])}}

                                    {{ Form::select('hostel_budget_section_id', $budgetSections, $budget->hostel_budget_section_id,
                                            [
                                                'class' => 'item-select   form-control required',
                                                'disabled',
                                                'placeholder' =>trans('labels.select'),
                                                'data-msg-required'=> trans('labels.This field is required'),
                                            ])
                                    }}
                                    {{ Form::hidden('hostel_budget_section_id', $budget->hostel_budget_section_id) }}
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-4">
                                    {{ Form::label('budget_amount', trans('hm::hostel_budget.amount'), ['class' => 'required']) }}
                                    {{ Form::number('budget_amount', $budget->budget_amount,
                                            [
                                                'disabled',
                                                'class' => 'form-control required',
                                                'data-msg-required'=> trans('labels.This field is required'),
                                            ])
                                     }}
                                    {{ Form::hidden('budget_amount', $budget->budget_amount) }}
                                </div>

                                @if(auth()->user()->hasAnyRole(['ROLE_DIRECTOR_ADMIN']))
                                    <div class="form-group mb-1 col-sm-12 col-md-4">
                                        {{ Form::label('budget_amount', trans('hm::hostel_budget.approve_amount'), ['class' => 'required']) }}
                                        {{ Form::number('budget_approved_amount', $budget->budget_amount,
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
                                        @if ($errors->has('budget_approved_amount'))
                                            <div
                                                class="help-block">  {{ $errors->first('budget_approved_amount') }}</div>
                                        @endif
                                    </div>
                                @endif

                            </div>
                            <hr>

                        </div>
                    @endforeach
                    <div class="form row">
                        <div class="form-group mb-1 col-sm-12 col-md-4">
                            <b>@lang('labels.total'):</b>
                        </div>
                        <div class="form-group mb-1 col-sm-12 col-md-4">
                            <b>{{ $budgetWithTitles->hostelBudgets->sum('budget_amount' ) }}</b>
                        </div>
                        @if(auth()->user()->hasAnyRole('ROLE_DIRECTOR_ADMIN'))
                            <div class="form-group mb-1 col-sm-12 col-md-4">
                                <b id="total_budget_amount">{{ $budgetWithTitles->hostelBudgets->sum('budget_amount' ) }}</b>
                            </div>
                        @endif
                    </div>
                </div>


                {{--<div class="form-group overflow-auto">--}}
                {{--<div class="col-12">--}}
                {{--<button type="button" data-repeater-create=""--}}
                {{--class="pull-right btn btn-sm btn-outline-primary addMoreBudgetSection">--}}
                {{--<i class="ft-plus"></i> Add--}}
                {{--</button>--}}
                {{--</div>--}}
                {{--</div>--}}

                <div class="form-actions text-center">
                    @if(auth()->user()->hasAnyRole(['ROLE_DIRECTOR_ADMIN']))
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> {{ trans('hm::hostel_budget.approve') }}
                        </button>
                    @endif
                    <a class="btn btn-warning mr-1" role="button" href="{{ route('hostel-budgets.index') }}">
                        <i class="ft-x"></i> {{trans('labels.cancel')}}
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
