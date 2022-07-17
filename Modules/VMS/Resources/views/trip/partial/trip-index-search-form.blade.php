<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <!-- Vehicle Type and Date -->
    <div class="row">
        <!-- From Date  -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('from', trans('labels.start'), ['class' => 'form-label required']) !!}
                {{
                       Form::text('start_date_time', isset($startDateTime) ? $startDateTime : \Carbon\Carbon::now()->format('Y-m-d'), [
                            'class' => 'form-control required month',
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('start_date_time'))
                <div class="help-block text-danger">
                    {{ $errors->first('start_date_time') }}
                </div>
            @endif
        </div>

        <!-- To Date  -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('end_date_time', trans('labels.end'), ['class' => 'form-label required']) !!}
                {{
                       Form::text('end_date_time', isset($endDateTime) ? $endDateTime : \Carbon\Carbon::now()->format('Y-m-d'), [
                            'class' => 'form-control required month',
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('end_date_time'))
                <div class="help-block text-danger">
                    {{ $errors->first('end_date_time') }}
                </div>
            @endif
        </div>
    </div>
</div>
<!--/General Information -->

<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-outline-primary">
        <i class="la la-search"></i>@lang('labels.search')
    </button>
</div>

