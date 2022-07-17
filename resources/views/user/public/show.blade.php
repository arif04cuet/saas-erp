@extends('layouts.master')
@section('title', 'User details')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">{{__('user-management.show_user_page_title')}}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>{{trans('labels.name')}}</th>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <th>{{trans('labels.mobile')}}</th>
                                <td>{{$user->mobile}}</td>
                            </tr>
                            <tr>
                                <th>{{trans('labels.email_address')}}</th>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <th>{{trans('labels.username')}}</th>
                                <td>{{$user->username}}</td>
                            </tr>
                            <tr>
                                <th>{{trans('user-management.user_type')}}</th>
                                <td>{{$user->user_type}}</td>
                            </tr>
                            <tr>
                                <th>{{trans('labels.status')}}</th>
                                <td>{{$user->status}}</td>
                            </tr>
                            <tr>
                                <th>{{trans('user-management.roles')}}</th>
                                <td>
                                    
                                    <ul>
                                    @foreach ($user->getRoleNames() as $role)
                                     <li>{{$role}}</li>   
                                    @endforeach
                                </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-actions">
                            <a href="{{URL::to( '/system/user/'.$user->id.'/edit')}}" class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                            <a class="btn btn-warning mr-1" role="button" href="{{url('/system/user')}}">
                                <i class="ft-x"></i> {{trans('labels.back_page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
