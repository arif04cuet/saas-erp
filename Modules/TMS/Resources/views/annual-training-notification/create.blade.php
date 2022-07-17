@extends('tms::layouts.master')
@section('title', trans('tms::annual_training.create_notification'))
@section('content')
    <section id="user-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('tms::annual_training.create_notification')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('tms::annual-training-notification.form', ['page'  => 'create'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    {{--    <script src="{{ asset('theme/vendors/js/vendors.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>--}}
    <script src="{{ asset('theme/vendors/js/editors/tinymce/tinymce.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/editors/editor-tinymce.js') }}"></script>
    {{--    <script src="{{ asset('theme/js/core/app-menu.js') }}"></script>--}}
    {{--    <script src="{{ asset('theme/js/core/app.js') }}"></script>--}}
    {{--    <script src="{{ asset('theme/js/scripts/customizer.js') }}"></script>--}}

    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
@endpush
