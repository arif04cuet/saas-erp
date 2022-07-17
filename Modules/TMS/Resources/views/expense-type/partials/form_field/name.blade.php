<label for="title" class="required" >{{ trans('tms::expense_type.form.name.eng') }}</label>
<input
    
    type="text" 
    class="form-control form-control-sm @if($errors->has('title')) is-invalid @endif" 
    id="title"
    value="{{ old('title') ? old('title') : $value}}"
    name="title" 
    placeholder = "{{trans('tms::expense_type.placeholder.name.eng')}}"

    required 
    data-validation-required-message="{{trans('tms::expense_type.msg.requied')}}"

>
