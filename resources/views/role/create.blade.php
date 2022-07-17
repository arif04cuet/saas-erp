@extends('layouts.master')
@section('title', trans('user-management.create_role_title'))
@section('content')
    <section id="role-form-layouts">
            @include('role.form')
    </section>
@endsection
