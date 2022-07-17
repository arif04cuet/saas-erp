<label for="name_en" class="required" >{{ trans('module.form.name.eng') }}</label>
<input
    
    type="text" 
    class="form-control form-control-sm @if($errors->has('name_en')) is-invalid @endif" 
    id="name_en"
    value="{{ old('name_en') ? old('name_en') : $value}}"
    name="name_en" 
    data-validation-regex-regex = "^([\x3Aa-zA-Z0-9\u002D\u0028\u0029\u005F\u0020])+$"
    data-validation-regex-message="{{trans('module.msg.regex.eng')}}"
    placeholder = "{{trans('module.placeholder.name.eng')}}"
    required 
    data-validation-required-message="{{trans('module.msg.requied')}}"

>
