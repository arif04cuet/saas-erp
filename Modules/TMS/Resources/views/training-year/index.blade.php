@extends('tms::layouts.master')
@section('title', trans('tms::training_type.title'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="form-section"><i class="ft-user black"></i>
                                @lang('tms::training_year.title')
                            </h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        {!! Form::open(['route' =>  ['training-year.store'], 'class' => 'form wizard-circle training-year-form', 'novalidate', 'method' => 'post']) !!}
                                        <fieldset>
                                            @include('tms::training-year.form')
                                        </fieldset>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="master table table-striped table-bordered alt-pagination">
                                                <thead>
                                                <tr>
                                                    <th width="10px">{{ trans('labels.serial') }}</th>
                                                    <th>{{ trans('tms::training_year.title') }}</th>
                                                    <th class="text-center">{{ trans('labels.action') }} </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($trainingYears as $key => $trainingYear)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td>
                                                            <a href="{{ route('training-year.show', $trainingYear->id) }}">
                                                                {{ $trainingYear->getYear() ?? trans('labels.not_found') }}
                                                            </a>
                                                            {{-- <span>Testing Date</span> --}}
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <a href="{{ route('training-year.show', $trainingYear) }}" class="master btn btn-info" title="{{trans('labels.details')}}">
                                                                    <i class="ft-eye white"></i>
                                                                </a>
                                                                <a href="{{ route('training-year.edit', $trainingYear) }}" class="master btn btn-success" title="{{trans('labels.edit')}}">
                                                                    <i class="ft-edit white"></i>
                                                                </a>
                                                                <a href="#" class="master btn btn-danger"
                                                                    onclick="delete_form{{ $key }}.submit()" title="{{ trans('labels.delete') }}">
                                                                    <i class="la la-trash-o white"></i>
                                                                </a>
                                                                <!-- delete -->
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'url' => route('training-year.delete',$trainingYear->id),
                                                                    'style' => 'display:inline',
                                                                    'id' => 'delete_form' . $key,
                                                                    'onclick'=>'return confirm("Confirm delete?")',
                                                                ]) !!}

                                                                {!! Form::close() !!}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-css')
    {{-- <link rel="stylesheet" href="{{ asset('theme/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photo-upload.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/editors/tinymce/tinymce.min.css') }} "/>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
@endpush

@push('page-js')
    {{-- <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
    <script src="{{asset('theme/vendors/js/editors/tinymce/tinymce.js')}}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/core/app.js') }}" type="text/javascript"></script> --}}


    <script>
        $(document).ready(function () {
            validateForm('.training-year-form');

            const EndDateErrorMessage = `{!! trans('labels.end_date_greater_than_or_equal_start_date') !!}`;

            $('#start_date').pickadate({
                format: 'dd mmmm yyyy',
                container: "#start-date-container",
            });
            $('#end_date').pickadate({
                format: 'dd mmmm yyyy',
                container: "#end-date-container",

            });
            $('#registration_deadline').pickadate({
                format: 'dd mmmm yyyy',
                container: "#registration-deadline-container"
            });


            $('#start_date').change(function () {
                $('#end_date').pickadate('picker').set('min', new Date($(this).val()));
            });

            $('select').select2({
                placeholder: '{{ trans('labels.select') }}'
            });

            jQuery.validator.addMethod(
                "greaterThan",
                function (value, elements, params) {
                    let comparingDate = params === '#start_date' ? $(params).val() : params;
                    let diff = Date.parse(value) - Date.parse(comparingDate);
                    const oneMonth = 30000 * 24 * 60 * 60;
                    return diff > oneMonth
                },
                '{{ trans('labels.greaterThan', ['name' => trans('hrm::appraisal.start_date')]) }}'
            );

            //end date validation
            $('#end_date').rules('greaterThan', {
                    greaterThan: "#start_date",
                    messages: {
                        greaterThan: EndDateErrorMessage,
                    }
                }
            );

            $('#start-date').on('mousedown', function (event) {
                event.preventDefault();
            })


        });
    </script>
@endpush
