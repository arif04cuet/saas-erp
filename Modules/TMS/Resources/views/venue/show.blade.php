@extends('tms::layouts.master')
@section('title', trans('tms::venue.title.show'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-user black"></i> {{trans('tms::venue.title.show')}}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements mr-1">
                                @include('tms::venue.partials.buttons.create')
                                @include('tms::venue.partials.buttons.edit',['id'=>$venue->id])
                                @include('tms::venue.partials.buttons.list')
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>{{ trans('tms::venue.th.name_bn') }}</th>
                                            <td>{{ $venue->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('tms::venue.th.name_eng') }}</th>
                                            <td>{{ $venue->title_bn }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('tms::venue.th.capacity') }}</th>
                                            <td>{{ $venue->capacity }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('tms::venue.th.short_code') }}</th>
                                            <td>{{ $venue->short_code }}</td>
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