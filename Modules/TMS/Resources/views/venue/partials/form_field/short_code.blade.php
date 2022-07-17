<label for="short_code" class="required" >{{ trans('tms::venue.form.short code') }}</label>
<input
    
    type="text" 
    class="form-control @if($errors->has('short_code')) is-invalid @endif" 
    id="short_code"
    value="{{ old('short_code') ? old('short_code') : $value}}"
    name="short_code" 

    placeholder = "{{trans('tms::venue.placeholder.short code')}}"

    required 
    data-validation-required-message="{{trans('tms::venue.msg.requied')}}"

>