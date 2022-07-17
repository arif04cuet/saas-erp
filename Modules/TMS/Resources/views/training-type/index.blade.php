@extends('tms::layouts.master')
@section('title', trans('tms::training_type.title'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="form-section"><i class="ft-user white"></i>
                                @lang('tms::training_type.title')
                            </h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        {!! Form::open(['route' =>  ['training-type.store'], 'class' => 'form wizard-circle training-type-form', 'novalidate', 'method' => 'post']) !!}
                                        <fieldset>
                                            @include('tms::training-type.form',['page'=>'index'])
                                        </fieldset>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="master table table-striped table-bordered alt-pagination">
                                                <thead>
                                                <tr>
                                                    <th width="10px">{{ trans('labels.serial') }}</th>
                                                    <th>{{ trans('labels.name') }}</th>
                                                    <th class="text-center">{{ trans('labels.action') }} </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($trainingTypes as $trainingType)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td>
                                                            <a href="{{ route('training-head.show', $trainingType->id) }}">
                                                                {{ $trainingType->getName() ?? trans('labels.not_found') }}
                                                            </a>
                                                        </td>
                                                        {{-- <td class="text-center">
                                                            <span class="dropdown">
                                                                <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false"
                                                                        class="btn btn-info dropdown-toggle">
                                                                    <i class="la la-cog"></i>
                                                                </button>
                                                                    <span aria-labelledby="imsRequestList" class="dropdown-menu mt-1 dropdown-menu-right">
                                                                        <a href="{{ route('training-type.edit',  $trainingType) }}"
                                                                            class="dropdown-item">
                                                                            <i class="ft-edit-2"></i> {{ trans('labels.edit') }}
                                                                        </a>
            
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="{{ route('training-type.show', $trainingType) }}"
                                                                        class="dropdown-item">
                                                                            <i class="ft-eye"></i> {{trans('labels.details')}}
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        {!! Form::open([
                                                                            'method'=>'DELETE',
                                                                            'url' => route('training-type.delete',$trainingType->id),
                                                                            'style' => 'display:inline'
                                                                            ]) !!}
                                                                            {!! Form::button('<i class="ft-trash"></i> '.trans('labels.delete'), array(
                                                                            'type' => 'submit',
                                                                            'class' => 'dropdown-item',
                                                                            'title' => 'Delete the user',
                                                                            'onclick'=>'return confirm("Confirm delete?")',
                                                                            )) !!}
                                                                            {!! Form::close() !!}
                                                                    </span>
                                                            </span>
                                                        </td> --}}
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <a href="{{ route('training-type.show', $trainingType) }}" class="master btn btn-info" title="{{trans('labels.details')}}">
                                                                    <i class="ft-eye white"></i>
                                                                    {{-- {{trans('labels.details')}} --}}
                                                                </a>
                                                                <a href="{{ route('training-type.edit',  $trainingType) }}" class="master btn btn-success" title="{{trans('labels.edit')}}">
                                                                    <i class="ft-edit white"></i>
                                                                    {{-- {{trans('labels.details')}} --}}
                                                                </a>
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
    {{-- <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('theme/css/vendors.css') }}">
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
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@push('page-js')
    {{-- <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script> --}}
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    {{-- <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script> --}}
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
    <script src="{{asset('theme/vendors/js/editors/tinymce/tinymce.js')}}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/core/app.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            validateForm('.training-type-form');
        });
    </script>
@endpush
