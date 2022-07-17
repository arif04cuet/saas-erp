@extends('tms::layouts.master')
@section('title', trans('tms::committee.create'))
@section('content')
    <section id="user-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('tms::committee.create')</h4>
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
                            {!! Form::open(['class' => 'form', 'novalidate', 'method' => 'post']) !!}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> @lang('tms::committee.create') @lang('labels.form')</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date" class="form-label required">@lang('labels.date')</label>
                                            {{ Form::text('date', date('j F, Y'), [
                                                    'id' => 'date',
                                                    'class' => 'form-control required' . ($errors->has('date') ? ' is-invalid' : ''),
                                                    'placeholder' => 'Pick start date',
                                                    'required' => 'required',
                                                    'disabled'
                                                ]) }}
                                            {{ Form::hidden('date', date('j F, Y')) }}
                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="program_manager" class="form-label required">{{trans('tms::committee.program_manager')}}</label>
                                            <select class="select2 form-control">
                                                <option value="CA">Sahib Bin Mahmood</option>
                                                <option value="NV">Yousha Farukey</option>
                                            </select>
                                            <div class="help-block"></div>
                                            @if ($errors->has('program_manager'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('program_manager') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="trainingID" class="form-label required">@lang('tms::committee.training_id')</label>
                                            <select class="select2 form-control">
                                                <option value="CA">BARD-TRN-2019-08-5489648</option>
                                                <option value="NV">BARD-TRN-2019-08-5489649</option>
                                                <option value="NV">BARD-TRN-2019-08-5489650</option>
                                            </select>
                                            <div class="help-block"></div>
                                            @if ($errors->has('trainingID'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('trainingID') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="training_title" class="form-label required">{{trans('tms::committee.training_name')}}</label>
                                            <input type="text" class="form-control" value="Title automatically appeared" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="training_start_date"
                                                   class="form-label required">{{trans('tms::committee.start_date')}}</label>
                                            {{ Form::text('date', '4 August, 2018', [
                                                    'id' => 'date',
                                                    'class' => 'form-control',
                                                    'readonly'
                                                ]) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="training_end_date" class="form-label required">{{trans('tms::committee.end_date')}}</label>
                                            {{ Form::text('date', '4 August, 2018', [
                                                    'id' => 'date',
                                                    'class' => 'form-control',
                                                    'readonly'
                                                ]) }}
                                        </div>
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-user"></i> @lang('tms::committee.resources')</h4>
                                <div class="form-group col-12 mb-2 file-repeater">
                                    <div data-repeater-list="repeater-list">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name" class="form-label required">@lang('labels.name')</label>
                                                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('labels.name')])}}">
                                                                <div class="help-block"></div>
                                                                @if ($errors->has('name'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="department" class="form-label required">{{trans('tms::committee.department')}}</label>
                                                                <select class="select2 form-control">
                                                                    <option value="CA">Administration</option>
                                                                    <option value="NV">Accounts</option>
                                                                    <option value="NV">Training </option>
                                                                </select>
                                                                <div class="help-block"></div>
                                                                @if ($errors->has('department'))
                                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('department') }}</strong>
                                            </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="designation" class="form-label required">@lang('tms::committee.designation')</label>
                                                                <select class="select2 form-control">
                                                                    <option value="CA">Faculty Member</option>
                                                                    <option value="NV">Asst. Director Training</option>
                                                                    <option value="NV">Director Training </option>
                                                                </select>
                                                                <div class="help-block"></div>
                                                                @if ($errors->has('designation'))
                                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('designation') }}</strong>
                                            </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="program_manager" class="form-label required">{{trans('tms::committee.role')}}</label>
                                                                <select class="select2 form-control">
                                                                    <option value="CA">Consultant</option>
                                                                    <option value="NV">Design Trainer</option>
                                                                    <option value="NV">Developer Trainer </option>
                                                                </select>
                                                                <div class="help-block"></div>
                                                                @if ($errors->has('program_manager'))
                                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('program_manager') }}</strong>
                                            </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-center mt-2">
                                                    <button type="button" data-repeater-delete class="btn btn-icon btn-danger mr-1"><i class="ft-x"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <button type="button" data-repeater-create class="btn btn-primary">
                                        <i class="ft-plus"></i>@lang('labels.add')
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="type" class="form-label required">@lang('tms::committee.note')</label>
                                            <textarea class="tinymce"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ft-check-square"></i> {{trans('tms::committee.save_notify')}}
                                </button>
                                <button class="btn btn-warning" type="button" onclick="window.location = '{{route('organization.index')}}'">
                                    <i class="ft-x"></i> {{trans('labels.cancel')}}
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('page-js')
    <script src="{{ asset('theme/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/editors/tinymce/tinymce.js') }}"></script>
    <script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('theme/js/core/app.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/customizer.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/editors/editor-tinymce.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    {{--<script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>--}}
    <script>
        (function(window, document, $) {
            'use strict';

            // Default
            $('.repeater-default').repeater();

            // Custom Show / Hide Configurations
            $('.file-repeater, .contact-repeater').repeater({
                show: function () {
                    $(this).slideDown();
                },
                hide: function(remove) {
                        $(this).slideUp(remove);
                }
            });


        })(window, document, jQuery);
    </script>
@endpush
