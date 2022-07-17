@extends('layouts.master')
@section('title', trans('module.title.show'))

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('module.title.show')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements mr-1">
                            @include('module.partials.buttons.create')
                            @include('module.partials.buttons.edit',['id'=>$module->id])
                            @include('module.partials.buttons.list')
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>{{ trans('module.th.name_bn') }}</th>
                                        <td>{{ $module->name_bn }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('module.th.name_eng') }}</th>
                                        <td>{{ $module->name_en }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('module.th.short_code') }}</th>
                                        <td>{{ $module->short_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('module.th.slug') }}</th>
                                        <td>{{ $module->slug }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-js')
@endpush