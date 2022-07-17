@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::food-menu.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('cafeteria::food-menu.title')
                           @if ($page == "create")
                                @lang('labels.create')
                           @else
                                @lang('labels.edit')
                           @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('cafeteria::food-menu.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')

    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <script>
        $(document).ready(function () {
            validateForm('.food-menu-form');
        })
        /**dropdown select*/
        $('.material-dropdown-select').select2({
                selectOnClose: true,
        });

    </script>
@endpush
