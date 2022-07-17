@extends('layouts.master')
@section('title', trans('doptor.title.show'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-list"></i> {{trans('doptor.title.show')}}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements mr-1">
                                {{-- @include('doptor.partials.buttons.create') --}}
                                @include('doptor.partials.buttons.edit',['id'=>$doptor->id])
                                @include('doptor.partials.buttons.list')
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="master table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>{{ trans('doptor.th.name_bn') }}</th>
                                            <td>{{ $doptor->name_bng }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('doptor.th.name_en') }}</th>
                                            <td>{{ $doptor->name_eng }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('doptor.th.short_code') }}</th>
                                            <td>
                                               @foreach($doptor->modules as $key => $module)
                                               <span>{{$module->short_code}}</span>
                                               @if(!$loop->last),@endif
                                               @endforeach
                                            </td>
                                        </tr>

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
@push('page-js')
@endpush