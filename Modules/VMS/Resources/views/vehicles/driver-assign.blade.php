@extends('vms::layouts.master')

{{--@section('title', trans('labels.HRM'))--}}
@section('title', 'VMS')

@section('content')

    <div class="vehicles">
        <div class="card p-2">
            <div class="card-header border-bottom pl-0">
                <h3 class="form-section">
                    <i class="ft-grid"></i> Driver Assign
                </h3>
            </div>
            <div class="card-content">
                <div class="card-body">
                    {!! Form::open(['route' =>  ['circular.store'], 'class' => 'form ', 'novalidate', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

                    @include('vms::vehicles.form.driver-assign.form')


                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>
@endsection
