<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <!-- Vehicle Type and Date -->
    <div class="row">
        <!-- Date  -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('date', trans('labels.pick_a_date'), ['class' => 'form-label']) !!}
                {{
                       Form::text('date', old('date') ?? date('F,Y'), [
                            'class' => 'form-control required date',
                            'data-msg-required'=> trans('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('date'))
                <div class="help-block text-danger">
                    {{ $errors->first('date') }}
                </div>
            @endif
        </div>

        <div class="col-6">

        </div>
    </div>
</div>
<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-outline-primary">
        <i class="la la-search"></i>@lang('labels.search')
    </button>
</div>
<!--/General Information -->



