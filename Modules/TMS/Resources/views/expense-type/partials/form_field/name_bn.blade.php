<label for="title_bn" class="required" >{{ trans('tms::expense_type.form.name.bn') }}</label>
<input
    
    type="text" 
    class="form-control form-control-sm @if($errors->has('title_bn')) is-invalid @endif" 
    id="title_bn"
    value="{{ old('title_bn') ? old('title_bn') : $value}}"
    name="title_bn" 
    
    data-validation-regex-regex = '^([\u0980-\u09FF\u005F\u0028\u0029\u0020\u002D])+$'
    data-validation-regex-message="{{trans('tms::expense_type.msg.regex.bn')}}"


    placeholder = "{{trans('tms::expense_type.placeholder.name.bn')}}"

    required 
    data-validation-required-message="{{trans('tms::expense_type.msg.requied')}}"

>


