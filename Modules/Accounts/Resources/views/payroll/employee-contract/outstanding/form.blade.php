<h4 class="form-section">
    <i class="la la-area-chart"></i> @lang('accounts::employee-contract.outstanding.title')
</h4>
<div class="outstanding-repeater">
    <div data-repeater-list="outstanding">
        <div data-repeater-item>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- Salary Rule Select -->
                        <div class="col-2">
                            <div class="form-group">
                                {!! Form::label('salary_rule_id', trans('labels.title'),
                                                ['class' => 'form-label required'])
                                !!}
                                {{ Form::select(
                                    'salary_rule_id',
                                    $rules,
                                     null,
                               [
                                    'class' => 'required salary-rule-select form-control',
                                     'data-msg-required'=> __('labels.This field is required')
                                ])}}
                                <div class="help-block"></div>
                            </div>
                        </div>

                        <!-- outstanding_month -->
                        <div class="col-4">
                            <div class="form-group">
                                {!! Form::label('month', trans('accounts::employee-contract.month'), ['class' => 'form-label required']) !!}
                                {!! Form::text('month',null,
                                    [
                                        'class' => ' required form-control outstanding-month',
                                        'data-msg-required' => trans('labels.This field is required')
                                    ])
                                !!}
                                <div class="help-block"></div>
                                @if ($errors->has('month'))
                                    <span class="invalid-feedback">{{ $errors->first('month') }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- deduction amount -->
                        <div class="col ">
                            <div class="form-group">
                                {!! Form::label('amount',
                                                    trans('accounts::pension.lump_sum.deduction.form_elements.amount'),
                                                    ['class' => 'form-label']) !!}
                                {{ Form::number(
                                    'amount',
                                    0,
                                    [
                                        'class' => 'form-control deduction-amount',
                                        'min'=>0,
                                    ]
                                ) }}
                            </div>
                        </div>

                        <!--Remarks-->
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('remark',
                                                   trans('accounts::pension.lump_sum.deduction.form_elements.remark'),
                                                   ['class' => 'form-label']) !!}
                                {{ Form::text(
                                    'remark',
                                    null,
                                    [
                                        'class' => 'form-control'
                                    ]
                                ) }}
                            </div>
                        </div>

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
