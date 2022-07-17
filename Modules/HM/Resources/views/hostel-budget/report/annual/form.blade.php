{!!
    Form::open([
      'route' =>  'hm.accounts.report.annual-budgets.index',
      'class' => 'form hm-annual-budget-report-form','novalidate',
    ])
!!}
<!-- select a training -->
<h4 class="form-section"><i class="la  la-building-o"></i>
    @lang('hm::report.budget.annual.form_elements.card_title')
</h4>

<div class="row">
    <div class="col-8">
        <div class="form-group">
            {!! Form::label('hostel_budget_title_id', trans('hm::report.budget.annual.form_elements.hostel_budget_title_id'),
                            ['class' => 'form-label'])
            !!}
            {{ Form::select(
                'hostel_budget_title_id',
                $hostelBudgetTitles,
                 null,
                [
                    'class' => 'form-control required select2',
                    'data-msg-required'=> __('labels.This field is required'),
                    'placeholder'=>trans('labels.select'),
                ]
            ) }}
        </div>
    </div>
    <div class="col-4">
        <!-- Save & Cancel Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="margin-top: 23px">
                <i class="la la-search"></i> @lang('labels.search')
            </button>

        </div>
    </div>

</div>


<div class="information-section">
    <!-- training and booking related information -->
    <h4 class="form-section"><i class="la  la-building-o"></i>
        @lang('hm::report.budget.annual.index')
    </h4>
    <div class="dynamic-content">

    </div>
    <div class="text-center print-button">

    </div>
</div>


{{Form::close()}}
