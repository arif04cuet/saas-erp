<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>

<div class="col">

    <div class="row">
        <!-- Salary Rule -->
        <div class="col-6">
            <div class="form-group">
            {!! Form::label('salary_rule_id', trans('vms::integration.form_elements.salary_rule_id'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('salary_rule_id', $salaryRules ?? [],old('salary_rule_id') ?? null, [
                        'class' => 'form-control required select2',
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('salary_rule_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('salary_rule_id') }}
                    </div>
                @endif
            </div>
        </div>
        <!-- TMS Sub Sector Id -->
        <div class="col-6">
            <div class="form-group">
            {!! Form::label('tms_sub_sector_id', trans('vms::integration.form_elements.tms_sub_sector_id'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('tms_sub_sector_id', $tmsSubSectors ?? [],old('tms_sub_sector_id') ?? null, [
                        'class' => 'form-control required select2',
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('tms_sub_sector_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('tms_sub_sector_id') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Fuel Bill and Vehicle Maintenance & Project Code -->
    <div class="row">
        <!-- Salary Rule -->
        <div class="col-4">
            <div class="form-group">
            {!! Form::label('fuel_bill_economy_code', trans('vms::integration.form_elements.fuel_bill_economy_code'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('fuel_bill_economy_code', $economyCodes ?? [],old('fuel_bill_economy_code') ?? null, [
                        'class' => 'form-control required select2',
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('fuel_bill_economy_code'))
                    <div class="help-block text-danger">
                        {{ $errors->first('fuel_bill_economy_code') }}
                    </div>
                @endif
            </div>
        </div>
        <!-- Vehicle Maintenance Economy Code -->
        <div class="col-4">
            <div class="form-group">
            {!! Form::label('vehicle_maintenance_economy_code', trans('vms::integration.form_elements.vehicle_maintenance_economy_code'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('vehicle_maintenance_economy_code', $economyCodes ?? [],old('vehicle_maintenance_economy_code') ?? null, [
                        'class' => 'form-control required select2',
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('vehicle_maintenance_economy_code'))
                    <div class="help-block text-danger">
                        {{ $errors->first('vehicle_maintenance_economy_code') }}
                    </div>
                @endif
            </div>
        </div>
        <!-- Project Economy Code -->
        <div class="col-4">
            <div class="form-group">
            {!! Form::label('project_economy_code', trans('vms::integration.form_elements.project_economy_code'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('project_economy_code', $economyCodes ?? [],old('project_economy_code') ?? null, [
                        'class' => 'form-control required select2',
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('project_economy_code'))
                    <div class="help-block text-danger">
                        {{ $errors->first('project_economy_code') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

<!-- Trip Details -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('vms::integration.bank_cash_title')
</h4>

<div class="col">
    <!-- Bank/Cash Economy Codes  -->
    <div class="row">
        <!-- Accounts -->
        <div class="col-4">
            <div class="form-group">
            {!! Form::label('accounts_bank_cash_economy_code', trans('vms::integration.form_elements.accounts_bank_cash_economy_code'),
                        ['class' => 'form-label required']) !!}
            {{
                   Form::select('accounts_bank_cash_economy_code', $economyCodes ?? [],old('accounts_bank_cash_economy_code') ?? null, [
                        'class' => 'form-control required select2',
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('accounts_bank_cash_economy_code'))
                    <div class="help-block text-danger">
                        {{ $errors->first('accounts_bank_cash_economy_code') }}
                    </div>
                @endif
            </div>
        </div>
        <!-- TMS -->
        <div class="col-4">
            <div class="form-group">
            {!! Form::label('tms_bank_cash_economy_code', trans('vms::integration.form_elements.tms_bank_cash_economy_code'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('tms_bank_cash_economy_code', $tmsSubSectors ?? [],old('tms_bank_cash_economy_code') ?? null, [
                        'class' => 'form-control required select2',
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('tms_bank_cash_economy_code'))
                    <div class="help-block text-danger">
                        {{ $errors->first('tms_bank_cash_economy_code') }}
                    </div>
                @endif
            </div>
        </div>
        <!-- PMS -->
        <div class="col-4">
            <div class="form-group">
            {!! Form::label('pms_bank_cash_economy_code', trans('vms::integration.form_elements.pms_bank_cash_economy_code'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('pms_bank_cash_economy_code', $economyCodes ?? [],old('pms_bank_cash_economy_code') ?? null, [
                        'class' => 'form-control required select2',
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('pms_bank_cash_economy_code'))
                    <div class="help-block text-danger">
                        {{ $errors->first('pms_bank_cash_economy_code') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-outline-primary">
        <i class="la la-check-square"></i>@lang('labels.submit')
    </button>
    <a class="btn btn-outline-warning mr-1" role="button" href="#">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>



