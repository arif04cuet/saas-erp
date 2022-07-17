<h4 class="form-section">
    <i class="la la-"></i> @lang('accounts::pension.rule.title')
</h4>
<div class="pension-rule-repeater">
    <div data-repeater-list="pension">
        <div data-repeater-item>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- name -->
                        <div class="col">
                            <div class="form-group">
                                <label>@lang('accounts::pension.rule.form_elements.name')</label>
                                {{ Form::text(
                                    'name',
                                    null,
                                    [
                                        'class' => 'form-control','required'
                                    ]
                                ) }}
                            </div>
                        </div>
                        <!-- type -->
                        <div class="col">
                            <div class="form-group">
                                <label>@lang('accounts::pension.rule.form_elements.type')</label>
                                {{ Form::select(
                                    'type',
                                    Config::get('constants.pension.rule.type'),
                                     null,
                                    [
                                        'class' => 'form-control select'
                                    ]
                                ) }}
                            </div>
                        </div>
                        <!-- condition -->
                        <div class="col">
                            <div class="form-group">
                                <label>@lang('accounts::pension.rule.form_elements.condition')</label>
                                {{ Form::select(
                                    'condition',
                                     Config::get('constants.pension.rule.condition'),
                                     null,
                                    [
                                        'class' => 'form-control select'
                                    ]
                                ) }}
                            </div>
                        </div>
                        <!-- Amount type -->
                        <div class="col">
                            <div class="form-group">
                                <label>@lang('accounts::pension.rule.form_elements.amount_type')</label>
                                {{ Form::select(
                                    'amount_type',
                                    Config::get('constants.pension.rule.amount_type'),
                                    null,
                                    [
                                        'class' => 'form-control select amount-type'
                                    ]
                                ) }}
                            </div>
                        </div>
                        <!-- fixed amount -->
                        <div class="col fixed_div">
                            <div class="form-group">
                                <label>@lang('accounts::pension.rule.form_elements.fixed_amount')</label>
                                {{ Form::number(
                                    'fixed_amount',
                                    0,
                                    [
                                        'class' => 'form-control'
                                    ]
                                ) }}
                            </div>
                        </div>
                        <!-- percentage amount -->
                        <div class="col percentage_div">
                            <div class="form-group">
                                <label>@lang('accounts::pension.rule.form_elements.percentage_amount')</label>
                                {{ Form::number(
                                    'percentage_amount',
                                    0,
                                    [
                                        'class' => 'form-control'
                                    ]
                                ) }}
                            </div>
                        </div>

                        <!-- hidden: pension-rule-id -->
                        {{ Form::hidden('id',null) }}

                        <div class="col">
                            <div class="form-group col-sm-12 col-md-2" style="margin-top: 20px;">
                                <button type="button" class="btn btn-danger" data-repeater-delete="">
                                    <i
                                        class="ft-x"></i>
                                    @lang('labels.remove')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" data-repeater-create="" class="btn btn-primary addMore"><i
                    class="ft-plus"></i> @lang('labels.add')
            </button>
        </div>
    </div>
</div>
