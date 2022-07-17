@extends('layouts.master')
@section('title', trans('labels.doptor_list'))

@section('content')
    <section id="user-list">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-list black"></i> {{trans('labels.doptor_list')}}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="master table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('labels.english_name')}}</th>
                                        <th>{{trans('labels.bangla_name')}}</th>
                                        <th>{{trans('module.module')}}</th>
                                        <th width="100px">{{ trans('labels.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($doptors as $doptor)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{$doptor->name_eng}}</td>
                                            <td>{{$doptor->name_bng}}</td>
                                            <td>
                                                @if($doptor->modules)
                                                    @foreach($doptor->modules as $module)
                                                        <span>{{ $module->short_code }}</span>
                                                        @if( !$loop->last),@endif
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td class="text-center">
                                              <div class="btn-group">
                                                {{-- @can('update_trainings') --}}
                                                    <a href="{{ route('doptors.edit', $doptor->id) }}" class="master btn btn-info" title="{{trans('module.button.edit')}}">
                                                        <i class="ft-edit-2"></i>
                                                        <!-- {{ trans('labels.edit') }} -->
                                                    </a>
                                                {{-- @endcan --}}

                                                {{-- @can('view_trainings') --}}
                                                    <a href="{{ route('doptors.show', $doptor->id) }}" class="master btn btn-success" title="{{trans('module.button.show')}}">
                                                        <i class="ft-eye white"></i>
                                                        <!-- {{ trans('labels.details') }} -->
                                                    </a>
                                                {{-- @endcan --}}
                                            </div>
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
