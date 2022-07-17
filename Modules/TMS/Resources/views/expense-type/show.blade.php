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
                                @include('tms::expense-type.partials.buttons.create')
                                @include('tms::expense-type.partials.buttons.edit',['id'=>$expense_type->id])
                                @include('tms::expense-type.partials.buttons.list')
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="master table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>{{ trans('tms::expense_type.th.name_bn') }}</th>
                                            <td>{{ $expense_type->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('tms::expense_type.th.name_eng') }}</th>
                                            <td>{{ $expense_type->title_bn }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('tms::expense_type.th.capacity') }}</th>
                                            <td>{{ $expense_type->capacity }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('tms::expense_type.th.short_code') }}</th>
                                            <td>{{ $expense_type->short_code }}</td>
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