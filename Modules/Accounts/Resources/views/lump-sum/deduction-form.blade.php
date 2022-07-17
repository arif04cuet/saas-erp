<h4 class="form-section">
    <i class="la la-area-chart"></i> @lang('accounts::pension.lump_sum.deduction.title')
</h4>
<div class="deduction-repeater">
    <div data-repeater-list="deduction">
        <div data-repeater-item>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- title -->
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('pension_deduction_id', trans('labels.title'),
                                                ['class' => 'form-label'])
                                !!}
                                <a href="{{route('pension.deduction.create')}}" target="_blank"
                                   class="pull-right">@lang('labels.create')</a>
                                {{ Form::select(
                                    'pension_deduction_id',
                                    $pensionDeductions,
                                     null,
                                    [
                                        'class' => 'form-control code-select'
                                    ]
                                ) }}
                            </div>
                        </div>

                        <!-- deduction amount -->
                        <div class="col fixed_div">
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
                                        'max'=>2147483647
                                    ]
                                ) }}
                            </div>
                        </div>

                        <!--Remarks-->
                        <div class="col fixed_div">
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
