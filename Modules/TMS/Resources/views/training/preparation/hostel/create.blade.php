@extends('tms::layouts.master')
@section('title', trans('tms::training.preparation.hostel'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>@lang('tms::training.preparation.hostel') - <a
                        href="{{ route('training.show', $training->id) }}">{{ $training->training_title }}</a></h4>
        </div>
        <div class="card-body">
            <div class="repeater-hostel-preparation">
                <div data-repeater-list="hostels">
                    <div data-repeater-item>
                        <form class="form row">
                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                <label for="trainees">@lang('tms::training.training_participant_no')</label>
                                <br>
                                {{ Form::number('trainees', null, ['class' => 'form-control', 'min' => 1]) }}
                            </div>
                            <div class="form-group mb-1 col-sm-12 col-md-3">
                                <label for="hostel">@lang('hm::hostel.title')</label>
                                <br>
                                {{ Form::select('hostel', $hostelDropDowns, null, ['class' => 'select2', 'placeholder' => trans('labels.select')]) }}
                            </div>
                            <div class="form-group mb-1 col-sm-12 col-md-3">
                                <label>@lang('hm::booking-request.duration')</label>
                                <br>
                                <input name="duration" type='text' class="form-control"/>
                            </div>
                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                <label for="tel-input">@lang('tms::training.preparation.money_handler')</label>
                                <br>
                                {{ Form::select('handler', [trans('tms::training.trainee'), trans('tms::training.organization')], null, [
                                    'class' => 'select2',
                                    'placeholder' => trans('labels.select')
                                ]) }}
                            </div>
                            <div class="form-group col-sm-12 col-md-1 text-center mt-2">
                                <button type="button" class="btn btn-outline-danger" data-repeater-delete><i
                                            class="ft-x"></i></button>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
                <div class="form-group overflow-hidden">
                    <div class="col-12">
                        <div class="pull-right">
                            <button data-repeater-create class="btn btn-sm btn-primary">
                                <i class="ft-plus"></i> @lang('labels.add')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script>
        $('input[name=duration]').daterangepicker({
            autoApply: true
        });

    </script>

    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('div[class="repeater-hostel-preparation"]').repeater({
                show: function () {
                    $(this).find('input[name*="[duration]"]').daterangepicker({
                        autoApply: true
                    });

                    $(this).find('.select2-container').remove();
                    $(this).find('select').select2({
                        placeholder: '{!! trans('labels.select') !!}'
                    });

                    $(this).slideDown();
                }
            })
        });
    </script>
@endpush