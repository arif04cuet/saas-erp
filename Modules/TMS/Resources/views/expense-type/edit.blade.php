@extends('tms::layouts.master')
@section('title', trans('tms::expense_type.title.edit'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-user black"></i> {{trans('tms::expense_type.title.edit')}}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements mr-1">
                                @include('tms::expense-type.partials.buttons.create')
                                {{-- @include('tms::venue.partials.buttons.show',['id'=>$venue->id]) --}}
                                @include('tms::expense-type.partials.buttons.list')
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                @include('tms::expense-type.partials.edit_form',['expense_type'=>$expense_type])
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