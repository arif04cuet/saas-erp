@extends('layouts.master')
@section('title', trans('module.title.index'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-list black"></i> {{trans('module.title.index')}}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements mr-1">
                                @include('module.partials.buttons.create')
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="master table table-striped table-bordered venue-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th width="30px">{{ trans('module.th.serial') }}</th>
                                                <th width="40px">{{ trans('module.th.name_en') }}</th>
                                                <th width="30px">{{ trans('module.th.name_bn') }}</th>
                                                <th width="30px">{{ trans('module.th.short_code') }}</th>
                                                <th width="30px">{{ trans('module.th.status') }}</th>
                                                <th width="100px">{{ trans('labels.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($modules as $key => $module)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{ $module->name_en }}</td>
                                                    <td>{{ $module->name_bn }}</td>
                                                    <td>{{ $module->short_code }}</td>
                                                    <td>{{ $module->status == 1 ? trans('module.th.active') : trans('module.th.inactive')}}</td>
                                                    {{-- <td>
                                                      <span class="dropdown">
                                                        <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                class="btn btn-info dropdown-toggle">
                                                            <i class="la la-cog"></i>
                                                        </button>
                                                        <span aria-labelledby="imsRequestList" class="dropdown-menu dropdown-menu-right">
                                                            <a href="{{ route('module.edit', $module->id) }}" class="dropdown-item"><i class="ft-edit-2"></i> {{trans('module.button.edit')}}</a>
                                                            <a href="{{ route('module.show',$module->id) }}" class="dropdown-item"><i class="ft-eye"></i> {{trans('module.button.show')}}</a>
                                                            <a href="{{ route('module.destroy',$module->id) }}" class="dropdown-item"><i class="ft-trash"></i> {{trans('module.button.delete')}}</a>
                                                        </span>
                                                    </span>
                                                    </td> --}}
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                          {{-- @can('update_trainings') --}}
                                                              <a href="{{ route('module.edit', $module->id) }}" class="master btn btn-info" title="{{trans('module.button.edit')}}">
                                                                  <i class="ft-edit-2"></i>
                                                                  <!-- {{ trans('labels.edit') }} -->
                                                              </a>
                                                          {{-- @endcan --}}
          
                                                          {{-- @can('view_trainings') --}}
                                                              <a href="{{ route('module.show',$module->id) }}" class="master btn btn-success" title="{{trans('module.button.show')}}">
                                                                  <i class="ft-eye white"></i>
                                                                  <!-- {{ trans('labels.details') }} -->
                                                              </a>
                                                              <a href="{{ route('module.destroy',$module->id) }}" class="master btn btn-warning" title="{{trans('module.button.delete')}}">
                                                                  <i class="ft-trash white"></i>
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
        </div> 
    </section>
@endsection
@push('page-js')
    <script>
        let table = $('.venue-table').DataTable({});
    </script>
@endpush
