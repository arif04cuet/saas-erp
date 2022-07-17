<label for="name_bng" >{{ trans('doptor.form.name.bn') }}</label>
<input

    type="text" 
    class="form-control form-control-sm" 
    id="name_bng"
    value="{{ old('name_bng') ? old('name_bng') : $value}}"
    name="name_bng" 
    readonly
    placeholder = "{{trans('doptor.placeholder.name.bn')}}"

>


