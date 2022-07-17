@extends('layouts.master')
@section('title', trans('module.title.create'))

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('module.title.create')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements mr-1">
                            @include('module.partials.buttons.list')
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            {{-- form start --}}
                            <div class="form-body">
                                @include('module.partials.create_form')
                            </div>
                            {{-- form end --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-js')
@endpush