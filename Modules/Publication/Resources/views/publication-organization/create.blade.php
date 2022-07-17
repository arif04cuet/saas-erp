@extends('publication::layouts.master')
@section('title', trans('publication::organization.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @if ($page == 'create')
                                @lang('publication::organization.organization_create')
                            @else
                                @lang('publication::organization.organization_edit')
                            @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('publication::publication-organization.form')
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
        $(document).ready(function() {
            validateForm('.organization-form');
        });
    </script>


@endpush
