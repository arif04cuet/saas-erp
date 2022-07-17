<label for="capacity" class="required">{{trans('tms::expense_type.form.capacity')}}</label>
<input

    type="text"
    class="form-control @if($errors->has('capacity')) is-invalid @endif"
    id="capacity"
    value="{{ old('capacity') ? old('capacity') : $value}}"
    name="capacity"

    placeholder="{{trans('tms::expense_type.placeholder.capacity')}}"
    required
    data-validation-required-message="{{trans('tms::expense_type.msg.requied')}}"

    min="1"
    data-validation-min-message="{{trans('tms::expense_type.msg.min')}}"
    max="500"
    data-validation-max-message="{{trans('tms::expense_type.msg.max')}}"


>
