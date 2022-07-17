@if($langPreference == $langOptions['only_english'])
    <!-- english -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="shortDescription1" class="required">@lang('tms::training.present_address') :</label>
                {!! Form::textarea('present_address', old('present_address') ?? optional($trainee->generalInfos)->present_address, [
                    'id' => 'shortDescription1',
                    'data-rule-maxlength'=>'55',
                    'data-msg-required' => Lang::get('labels.This field is required'),
                    'data-msg-maxlength'=>Lang::get('labels.At most 55 characters'),
                    'data-rule-regex-en' => config('regex.en'),
                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                    'rows' => 4,
                    'class' => 'form-control required'
                ]) !!}
            </div>
        </div>
    </div>
@elseif($langPreference == $langOptions['only_bangla'])
    <!-- bangla -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="shortDescriptionBn" class="required">@lang('tms::training.present_address_bn')
                    :</label>
                {!! Form::textarea('present_address_bn', old('present_address_bn') ?? optional($trainee->generalInfos)->present_address_bn,
                    [
                    'id' => 'shortDescriptionBn',
                    'data-rule-maxlength'=>'55',
                    'data-msg-required' => Lang::get('labels.This field is required'),
                    'data-msg-maxlength'=>Lang::get('labels.At most 55 characters'),
                    'data-rule-regex-bn' => config('regex.bn'),
                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                    'rows' => 4,
                    'class' => 'form-control required'
                ]) !!}
            </div>
        </div>
    </div>
@else
    <!-- english -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="shortDescription1" class="required">@lang('tms::training.present_address') :</label>
                {!! Form::textarea('present_address', old('present_address') ?? optional($trainee->generalInfos)->present_address, [
                    'id' => 'shortDescription1',
                    'data-rule-maxlength'=>'55',
                    'data-msg-required' => Lang::get('labels.This field is required'),
                    'data-msg-maxlength'=>Lang::get('labels.At most 55 characters'),
                    'data-rule-regex-en' => config('regex.en'),
                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                    'rows' => 4,
                    'class' => 'form-control required'
                ]) !!}
            </div>
        </div>
    </div>
    <!-- bangla -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="shortDescriptionBn" class="required">@lang('tms::training.present_address_bn')
                    :</label>
                {!! Form::textarea('present_address_bn', old('present_address_bn') ?? optional($trainee->generalInfos)->present_address_bn, [
                    'id' => 'shortDescriptionBn',
                    'data-rule-maxlength'=>'55',
                    'data-msg-required' => Lang::get('labels.This field is required'),
                    'data-msg-maxlength'=>Lang::get('labels.At most 55 characters'),
                    'data-rule-regex-bn' => config('regex.bn'),
                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                    'rows' => 4,
                    'class' => 'form-control required'
                ]) !!}
            </div>
        </div>
    </div>
@endif
