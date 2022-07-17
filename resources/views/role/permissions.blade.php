<p class="font-weight-bold text-uppercase">
    {{trans('user-management.permission_list_title')}}
</p>

@foreach ($permissions as $moduleId=>$modulePermissions)
<div class=" mb-2">    
    
    <p class="">
        {{$modules[$moduleId]['name_'.$lang]}}
    </p>
    <div class="d-flex flex-wrap">
        @foreach ($modulePermissions as $permission)
            
            <label class="checkbox-inline col-md-3">
                <input
                type="checkbox" 
                class="" 
                name="permissions[]" 
                value="{{$permission->id}}"
                {{ $role->permissions()->get()->contains('id',$permission->id) ? 'checked':''}}
                > {{$permission->label}}
            </label>

        @endforeach
    </div>
</div>
@endforeach
