<span class="dropdown">
    <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" class="btn btn-info dropdown-toggle"><i class="la la-cog"></i></button>
      <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">

        @can('impersonate_users')
        <a href="{{route('impersonate',$user->id)}}" class="dropdown-item"><i class="ft-eye"></i> Impersonate</a>
        @endcan

        @can('view_users')
        <a href="{{route('users.show',$user->id)}}" class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.details')}}</a>
        @endcan

        @can('edit_users')
        <a href="{{route('users.edit',$user->id)}}" class="dropdown-item"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
        @endcan

        @can('delete_users')
        
        <div class="dropdown-divider"></div>
          {!! Form::open([
          'method'=>'DELETE',
          'url' => route('users.destroy',$user->id),
          'style' => 'display:inline'
          ]) !!}
          {!! Form::button('<i class="ft-trash"></i> '.trans('labels.delete'), array(
          'type' => 'submit',
          'class' => 'dropdown-item',
          'title' => 'Delete the user',
          'onclick'=>'return confirm("Confirm delete?")',
          )) !!}
          {!! Form::close() !!}
          @endcan
      </span>
    </span>