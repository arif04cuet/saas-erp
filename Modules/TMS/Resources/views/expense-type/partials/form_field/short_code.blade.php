<label for="short_code" class="required" >{{ trans('tms::expense_type.form.short code') }}</label>
<input
    
    type="text" 
    class="form-control @if($errors->has('short_code')) is-invalid @endif" 
    id="short_code"
    value="{{ old('short_code') ? old('short_code') : $value}}"
    name="short_code" 

    placeholder = "{{trans('tms::expense_type.placeholder.short code')}}"

    required 
    data-validation-required-message="{{trans('tms::expense_type.msg.requied')}}"

>