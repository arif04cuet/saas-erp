<label for="name_bn" class="required" >{{ trans('module.form.name.bn') }}</label>
<input
    
    type="text" 
    class="form-control form-control-sm @if($errors->has('name_bn')) is-invalid @endif" 
    id="name_bn"
    value="{{ old('name_bn') ? old('name_bn') : $value}}"
    name="name_bn" 
    data-validation-regex-regex = '^([\u0980-\u09FF\u005F\u0028\u0029\u0020\u002D])+$'
    data-validation-regex-message="{{trans('module.msg.regex.bn')}}"
    placeholder = "{{trans('module.placeholder.name.bn')}}"
    required 
    data-validation-required-message="{{trans('module.msg.requied')}}"

>


