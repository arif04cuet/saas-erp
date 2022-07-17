@extends('layouts.master')
@section('title', trans('labels.User list'))

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('user-management.user_list_page_title')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">

                            @can('add_users')
                            <a href="{{route('users.create')}}" class="btn btn-primary btn-sm"><i
                                class="ft-plus white"></i> {{trans('user-management.create_user_button')}}</a>
                            @endcan
                           
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            {{$dataTable->table(['class'=>'table table-bordered table-hover'])}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-js')
{{$dataTable->scripts()}}
@endpush

