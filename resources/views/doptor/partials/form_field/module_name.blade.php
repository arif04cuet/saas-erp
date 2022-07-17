<label for="module_name">{{ trans('module.form.name.bn') }}</label>
<div class="clearfix"></div>
@if($module)
    @foreach($module as $key => $value)
    @if(in_array($value['id'], $doptor->modules->pluck('id')->toArray()))
        <label class="checkbox-inline mr-2">
            <input
            type="checkbox" 
            class="" 
            id="module_name"
            value="{{$value['id']}}"
            name="module_name[]" 
            checked
            > {{ $value['short_code'] }}
        </label>
    @else
        <label class="checkbox-inline mr-2">
            <input
            type="checkbox" 
            class="" 
            id="module_name"
            value="{{$value['id']}}"
            name="module_name[]" 

            > {{ $value['short_code'] }}
        </label>
    @endif
    @endforeach
@endif


