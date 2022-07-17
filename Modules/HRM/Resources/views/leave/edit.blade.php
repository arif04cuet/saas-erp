@extends('hrm::layouts.master')
@section('title', trans('hrm::leave.leave_application'))

@section("content")
    <div class="card">
        <div class="card-header"></div>
        <div class="card-content">
            <div class="container">
                {{ Form::open(['route' => ['leaves.update', $leaveRequest->id], 'method' => 'PUT']) }}
                <h5 class="form-section"><i class="ft-calendar"></i> {{trans('hrm::leave.leave_details')}}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">@lang('labels.requester')</label>
                        <br>
                        {{ $leaveRequest->requester->name }}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">@lang('hrm::leave.leave_type')</label>
                        <br>
                        @lang("hrm::leave.{$leaveRequest->type->name}")
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">@lang('labels.attachments')</label>
                        <br>
                        @foreach($leaveRequest->attachments as $attachment)
                            <span class="badge badge-pill badge-info">{{ $attachment->file_name }}</span>
                        @endforeach
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">@lang('hrm::leave.leave_reason')</label>
                        <br>
                        {{ $leaveRequest->reason }}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">@lang('hrm::leave.leave_start_date')</label>
                        <input type="text"
                               class="form-control required {{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                               name="start_date"
                               placeholder="{{trans('labels.pick_a_date')}}"
                               id="leave_start_date"
                               autocomplete="off"
                               value="{{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d/m/Y') }}"
                               required
                               data-validation-required-message="{{trans('validation.required', ['attribute' => trans('hrm::leave.leave_start_date')])}}"
                        />
                        @if($errors->has('start_date'))
                            <strong class="danger">{{ $errors->first('start_date') }}</strong>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">@lang('hrm::leave.leave_end_date')</label>
                        <input type='text'
                               class="form-control required"
                               value="{{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d/m/Y') }}"
                               placeholder="{{ trans('labels.pick_a_date') }}"
                               id="leave_end_date"
                               name="end_date"
                               autocomplete="off"
                               required
                               data-validation-required-message="{{trans('validation.required', ['attribute' => trans('hrm::leave.leave_end_date')])}}"
                        />
                        @if($errors->has('end_date'))
                            <strong class="danger">{{ $errors->first('end_date') }}</strong>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('labels.save')</button>
                            <a href="{{ route('leaves.index') }}" class="btn btn-warning">@lang('labels.cancel')</a>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#leave_start_date, #leave_end_date').daterangepicker({
                minDate: new Date(),
                singleDatePicker: true,
                showDropdowns: true,
                drops: 'up',
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });
        });
    </script>
@endpush