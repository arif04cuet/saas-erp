@extends('vms::layouts.master')

{{--@section('title', trans('labels.HRM'))--}}
@section('title', 'VMS')

@section('content')

    <div class="vehicles">
        <div class="card p-2">
            <div class="card-header border-bottom pl-0">
                <h3 class="form-section">
                    <i class="ft-grid"></i> Vehicles Request
                </h3>
            </div>
            <div class="card-content">
                <div class="card-body">
                    {!! Form::open(['route' =>  ['circular.store'], 'class' => 'form ', 'novalidate', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

                    @include('vms::vehicles.form.request.form')

                    <div class="form-actions text-center">
                        <button class="btn btn-warning" type="button">
                            <i class="ft-x"></i> Cancel
                        </button>
                        <button type="button" class="btn btn-primary">
                            <i class="ft-check-square "></i>  Request
                        </button>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <style>
        .select2 .select2-selection,
        input.form-control {
            min-height: 45px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 32px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 10px !important;
        }
    </style>
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

@endpush
