@extends('layouts.app')
@section('title', trans('labels.User list'))

@section('content')

    @can('beneficiary_dashboard')
        @include('dashboard.beneficiary-dashboard')
    @else   
    <div class="container">
        @include('dashboard.modules')
    </div>
    @endcan

@endsection

