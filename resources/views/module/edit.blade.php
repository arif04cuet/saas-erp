@extends('layouts.master')
@section('title', trans('module.title.edit'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-tag black"></i> {{trans('module.title.edit')}}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements mr-1">
                                @include('module.partials.buttons.create')
                                {{-- @include('module.partials.buttons.show',['id'=>$venue->id]) --}}
                                @include('module.partials.buttons.list')
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                @include('module.partials.edit_form',['module'=>$module])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-js')

<script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
<script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
<script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>
<script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
<script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
<script src="{{ asset('theme/js/core/app.js') }}"></script>

@endpush