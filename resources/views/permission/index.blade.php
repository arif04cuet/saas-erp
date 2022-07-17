@extends('layouts.master')
@section('title', trans('user-management.permission_list_title'))
@section('content')
    <section id="permission-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-user black"></i> {{trans('user-management.permission_list_title')}}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                {{-- <a href="{{url('/user/permission/create')}}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i> {{trans('user-management.permission_create_button')}}</a>
                                <a href="{{url('/user/permission/create')}}" class="btn btn-warning btn-sm"> <i
                                        class="ft-download white"></i></a> --}}
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="master table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Label</th>
                                        <th>Module</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $index = 1; ?>
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$permission->name}}</td>
                                            <td>{{$permission->label}}</td>
                                            <td>{{$permission->module->name_bn}}</td>
                                        </tr>
                                        <?php $index++; ?>
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
