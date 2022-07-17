<?php
/**
 * Created by PhpStorm.
 * User: bs110
 * Date: 1/20/19
 * Time: 3:53 PM
 */
?>
@extends($module . '::layouts.master')
@section('title', __('pms::task.create_card_title'))

@section('content')
    <section id="user-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{ trans('pms::task.create_card_title') }}</h4>
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
                            {!! Form::open(['url' => $action, 'class' => 'form', 'method' => 'post', 'files' => 'true']) !!}

                            @include('task.partials.form')

                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">

    <link rel="stylesheet" type="text/css" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/checkbox-radio.min.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>

    <script type="text/javascript">
        $('#expected_start_time, #expected_end_time,#actual_end_time').pickadate({
            format: 'yyyy-mm-dd',
        });

        $('#expected_start_time').change(function () {
            $('#expected_end_time').pickadate('picker').set('min', new Date($(this).val()));
        });

        $('#add').click(function () {
            $('#repeat-attachments').append('<br><input type="file" class="form-control" name="attachments[]">');
        });
    </script>
@endpush
