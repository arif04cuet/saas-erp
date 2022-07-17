@extends('layouts.master')
@section('title', trans('user-management.list_page_title'))

@section('content')
    <section id="role-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="las la-list-alt black"></i> @lang('user-management.list_page_title')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            @can('add_roles')
                            <a href="{{route('roles.create')}}" class="master btn btn-success btn-sm"><i class="las la-plus-circle white"></i> {{trans('user-management.create_button')}}</a>
                            @endcan
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="master table table-striped table-bordered alt-pagination">
                                    <thead>
                                        <tr>
                                            <th width="30">{{trans('labels.serial')}}</th>
                                            <th>{{trans('labels.name')}}</th>
                                            <th>{{trans('labels.description')}}</th>
                                            <th width="40">{{trans('labels.action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                            <td>{{$role->name}}</td>
                                            <td>{{$role->label}}</td>
                                            <td class="text-center">
                                                <button class="master btn btn-success btn-sm" id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="la la-cog white"></i></button>
                                                <span aria-labelledby="btnSearchDrop2" class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{route('roles.show',$role->id)}}" class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.details')}}</a>
                                                    <a href="{{route('roles.edit',$role->id)}}" class="dropdown-item"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                                                    {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => route('roles.destroy',$role->id),
                                                    'style' => 'display:inline'
                                                    ]) !!}
                                                    {!! Form::button('<i class="ft-trash"></i> '.trans('labels.delete'), array(
                                                        'type' => 'submit',
                                                        'class' => 'dropdown-item',
                                                        'title' => 'Delete the role',
                                                        'onclick'=>'return confirm("Confirm delete?")',
                                                    )) !!}
                                                    {!! Form::close() !!}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
