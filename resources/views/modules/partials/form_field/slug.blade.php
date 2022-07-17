<label for="slug" class="required">{{trans('module.form.slug')}}</label>
<input

    type="text"
    class="form-control @if($errors->has('slug')) is-invalid @endif"
    id="slug"
    value="{{ old('slug') ? old('slug') : $value}}"
    name="slug"

    placeholder="{{trans('module.placeholder.slug')}}"
    required
    data-validation-required-message="{{trans('module.msg.requied')}}"

    min="1"
    data-validation-min-message="{{trans('module.msg.min')}}"
    max="500"
    data-validation-max-message="{{trans('module.msg.max')}}"


>
