<label for="name_eng">{{ trans('module.form.name.eng') }}</label>
<input
    
    type="text" 
    class="form-control form-control-sm" 
    id="name_eng"
    value="{{ old('name_eng') ? old('name_eng') : $value}}"
    name="name_eng" 
    readonly
    placeholder = "{{trans('module.placeholder.name.eng')}}"

>
