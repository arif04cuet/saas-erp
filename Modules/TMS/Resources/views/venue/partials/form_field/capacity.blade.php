<label for="capacity" class="required">{{trans('tms::venue.form.capacity')}}</label>
<input

    type="text"
    class="form-control @if($errors->has('capacity')) is-invalid @endif"
    id="capacity"
    value="{{ old('capacity') ? old('capacity') : $value}}"
    name="capacity"

    placeholder="{{trans('tms::venue.placeholder.capacity')}}"
    required
    data-validation-required-message="{{trans('tms::venue.msg.requied')}}"

    min="1"
    data-validation-min-message="{{trans('tms::venue.msg.min')}}"
    max="500"
    data-validation-max-message="{{trans('tms::venue.msg.max')}}"


>
