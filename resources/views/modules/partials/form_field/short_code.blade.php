<label for="short_code" class="required" >{{ trans('module.form.short code') }}</label>
<input
    
    type="text" 
    class="form-control @if($errors->has('short_code')) is-invalid @endif" 
    id="short_code"
    value="{{ old('short_code') ? old('short_code') : $value}}"
    name="short_code" 

    placeholder = "{{trans('module.placeholder.short code')}}"

    required 
    data-validation-required-message="{{trans('module.msg.requied')}}"

>