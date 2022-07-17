@extends('accounts::layouts.master')
@section('title', trans('accounts::economy-head.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('accounts::economy-head.title') @lang('labels.create')</h4>
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
                            @include('accounts::economy-head.form', ['page' => 'create'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-js')
    <script>
        // select2 placeholder localization
        let selectPlaceholder = '{!! trans('labels.select') !!}';

        $(document).ready(function () {

            $('.economy-head-select').select2({
                placeholder: selectPlaceholder
            });

        });

    </script>
@endpush