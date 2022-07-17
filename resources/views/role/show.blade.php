@extends('layouts.master')
@section('title', 'Role details')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form"><i class="ft-list black"></i> Role Details</h4>
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
                            <table class="master table">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$role->name}}</td>
    
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{$role->label}}</td>
                                </tr>
                                <tr>
                                    <th>Permissions</th>
                                    <td>
                                        <ul>
                                        @foreach($role->permissions as $item)
                                           <li> {{$item->label}} &nbsp; &nbsp;</li>
                                        @endforeach
                                    </ul>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="form-actions">
                                <a href="{{URL::to( 'roles/'.$role->id.'/edit')}}" class="master btn btn-primary"><i class="ft-edit-2"></i> Edit</a>
                                <a class="master btn btn-warning mr-1" role="button" href="{{url('/roles')}}">
                                    <i class="ft-x"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
