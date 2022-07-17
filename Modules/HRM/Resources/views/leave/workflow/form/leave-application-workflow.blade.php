@extends('hrm::layouts.master')

@section('title', trans('hrm::leave.workflow.form.title'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
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
                            <div id="printable">
                                <h4 class="form-section"><i class="la  la-building-o"></i>
                                    {{ trans('hrm::leave.workflow.form.title') }}
                                </h4>
                                <hr>

                                <div class="row">
                                    <div class="col-6">
                                        <table class="table">
                                            <tr>
                                                <th>@lang('labels.requester')</th>
                                                <td>{{ $leaveRequest->requester ? $leaveRequest->requester->name : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('hrm::leave.workflow.request.leave_type')</th>
                                                <td>{{ trans('hrm::leave.' . $leaveRequest->type->name) }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('hrm::leave.leave_start_date')</th>
                                                <td>{{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d/m/Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('hrm::leave.leave_end_date')</th>
                                                <td>{{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d/m/Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('hrm::leave.workflow.request.leave_reason')</th>
                                                <td>{{ $leaveRequest->reason ?? 'Not Available' }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('labels.designation')</th>
                                                <td>{{ get_user_designation($leaveRequest->requester)->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('hrm::leave.duration')</th>
                                                <td>{{ $leaveRequest->duration }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('labels.status')</th>
                                                <td>@lang('labels.' . $leaveRequest->status)</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- @if (in_array('approve', $possibleTransitions)) --}}
                                        <table class="table">
                                            @if ($leaveCalculationConfig->is_subtractable)
                                                <tr>
                                                    <th>@lang('hrm::leave.available_leave_days')</th>
                                                    <th>{{ $availableLeaveDays }}</th>
                                                </tr>
                                            @endif

                                            @if (property_exists($leaveCalculationConfig, 'attendanceDivisor'))
                                                <tr>
                                                    <th>@lang('hrm::leave.leave_attendance_ratio')</th>
                                                    <th>1 / {{ $leaveCalculationConfig->attendanceDivisor }}</th>
                                                </tr>
                                            @endif

                                            @if (property_exists($leaveCalculationConfig, 'purpose'))
                                                <tr>
                                                    <th>@lang('hrm::leave.purpose')</th>
                                                    <th>@lang("hrm::leave.$leaveCalculationConfig->purpose")</th>
                                                </tr>
                                            @endif

                                            @if (property_exists($leaveCalculationConfig, 'service_period_leave_count_limit'))
                                                <tr>
                                                    <th>@lang('hrm::leave.service_period_leave_count_limit')</th>
                                                    <th>{{ $leaveCalculationConfig->service_period_leave_count_limit }}
                                                    </th>
                                                </tr>
                                            @endif

                                            @if (property_exists($leaveCalculationConfig, 'spent_leave_count'))
                                                <tr>
                                                    <th>@lang('hrm::leave.spent_leave_count')</th>
                                                    <th>{{ $leaveCalculationConfig->spent_leave_count }}</th>
                                                </tr>
                                            @endif

                                            @if (property_exists($leaveCalculationConfig, 'service_period_leave_limit'))
                                                <tr>
                                                    <th>@lang('hrm::leave.service_period_leave_limit')</th>
                                                    <th>{{ $leaveCalculationConfig->service_period_leave_limit }}</th>
                                                </tr>
                                            @endif

                                            @if (property_exists($leaveCalculationConfig, 'periodic_year'))
                                                <tr>
                                                    <th>@lang('hrm::leave.periodic_year')</th>
                                                    <th>{{ $leaveCalculationConfig->periodic_year }}</th>
                                                </tr>
                                            @endif

                                            @if (property_exists($leaveCalculationConfig, 'periodic_year_leave_limit'))
                                                <tr>
                                                    <th>@lang('hrm::leave.periodic_year_leave_limit')</th>
                                                    <th>{{ $leaveCalculationConfig->periodic_year_leave_limit }}</th>
                                                </tr>
                                            @endif

                                            @if (property_exists($leaveCalculationConfig, 'max_leave_duration_limit'))
                                                <tr>
                                                    <th>@lang('hrm::leave.max_leave_duration_limit')</th>
                                                    <th>{{ $leaveCalculationConfig->max_leave_duration_limit == PHP_INT_MAX ? '-' : $leaveCalculationConfig->max_leave_duration_limit }}
                                                    </th>
                                                </tr>
                                            @endif

                                            @if (property_exists($leaveCalculationConfig, 'has_earned_leave'))
                                                <tr>
                                                    <th>@lang('hrm::leave.has_earned_leave')</th>
                                                    <th>{{ $leaveCalculationConfig->has_earned_leave ? trans('labels.yes') : trans('labels.no') }}
                                                    </th>
                                                </tr>
                                            @endif

                                            @if (property_exists($leaveCalculationConfig, 'is_retired'))
                                                <tr>
                                                    <th>@lang('hrm::leave.retired')</th>
                                                    <th>{{ $leaveCalculationConfig->is_retired ? trans('labels.yes') : trans('labels.no') }}
                                                    </th>
                                                </tr>
                                            @endif

                                            <tr>
                                                <th>@lang('hrm::leave.requested_leave_days')</th>
                                                <th>{{ $leaveRequest->duration }}</th>
                                            </tr>
                                            @if (!$canApprove)
                                                <tfoot>
                                                    <tr>
                                                        <th style="letter-spacing: 1px" colspan="2"
                                                            class="text-center text-danger">
                                                            Leave application cannot be approved
                                                        </th>
                                                    </tr>
                                                </tfoot>
                                            @endif
                                        </table>
                                        {{-- @endif --}}

                                        @if ($leaveRequest->requester_id == auth()->id() && !in_array($leaveRequest->status, ['approved', 'rejected']))
                                            <a href="{{ route('leaves.edit', $leaveRequest->id) }}"
                                                class="btn btn-info">@lang('hrm::leave.leave_application')
                                                @lang('labels.edit')</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        @if (count($leaveRequest->stateDetails) > 0)
                                            <div class="col-md-12">
                                                <label class="black">@lang('labels.remarks'): </label>
                                                <div class="media">
                                                    <div class="media-body">
                                                        @foreach ($leaveRequest->stateDetails as $detail)
                                                            <p class="text-bold-600 mb-0">
                                                                {{ state_actor($detail->stateHistory->actor_id)->name }}
                                                            </p>
                                                            <p class="small m-0 comment-time">
                                                                {{ date('j F, Y, g:i a', strtotime($detail->created_at)) }}
                                                            </p>
                                                            <p class="m-0 comment-text">{!! $detail->remark !!}</p>
                                                            <hr />
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            {{ Form::open(['route' => 'hrm-leave-request.workflow.update', 'method' => 'PUT', 'class' => 'form', 'novalidate']) }}
                            {{ Form::hidden('leave_request_id', $leaveRequest->id) }}
                            @if (in_array('share', $possibleTransitions))
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""
                                                    class="form-label required">{{ __('ims::inventory.send_to') }}</label>
                                                {{ Form::select('recipients[]', $users, null, [
    'class' => 'form-control select2' . ($errors->has('recipients') || $errors->has('recipients.*') ? ' is-invalid' : ''),
    'placeholder' => trans('labels.select'),
]) }}
                                                <div class="help-block"></div>
                                                @if ($errors->has('recipients'))
                                                    <span class="invalid-feedback"
                                                        role="alert">{{ $errors->first('recipients') }}</span>
                                                @endif
                                                @if ($errors->has('recipients.*'))
                                                    @foreach ($errors->all() as $key => $error)
                                                        @if ($errors->has('recipients.' . $key))
                                                            <span class="invalid-feedback"
                                                                role="alert">{{ $errors->first('recipients.' . $key) }}</span>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!in_array($leaveRequest->status, ['approved', 'rejected']))
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""
                                                    class="form-label">{{ __('ims::inventory.remark.title') }}</label>
                                                {{ Form::textarea('remark', null, [
    'class' => 'editor form-control' . ($errors->has('remark') ? ' is-invalid' : ''),
    'placeholder' => __('ims::inventory.remark.placeholder'),
    'rows' => 5,
]) }}
                                                <div class="help-block"></div>
                                                @if ($errors->has('remark'))
                                                    <span class="invalid-feedback"
                                                        role="alert">{{ $errors->first('remark') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (in_array('share', $possibleTransitions))
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""
                                                    class="form-label">{{ __('ims::inventory.message.title') }}</label>
                                                {{ Form::textarea('message', null, [
    'class' => 'form-control',
    'placeholder' => __('ims::inventory.message.placeholder'),
    'rows' => 5,
]) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12 card-footer">
                                    <div class="float-left">
                                        @foreach ($possibleTransitions as $transition)

                                            @if ($transition == 'approve')
                                                @if ($canApprove)
                                                    <button class="btn btn-success" name="transition"
                                                        value="{{ $transition }}">
                                                        {{ trans('ims::workflow.transitions.' . $transition . '.title') }}
                                                    </button>
                                                @endif
                                            @else
                                                <button
                                                    class="btn btn-{{ config('constants.status_classes.' . $transition) }}"
                                                    name="transition" value="{{ $transition }}">
                                                    {{ trans('ims::workflow.transitions.' . $transition . '.title') }}
                                                </button>
                                            @endif

                                        @endforeach
                                        <a class="btn btn-warning" style="color: #fff;"
                                            href="{{ route('hrm-dashboard') }}">
                                            <i class="ft ft-x"></i>
                                            @lang('labels.cancel')
                                        </a>
                                        <a class="btn btn-success" style="color: #fff;" onclick='printDiv()'>
                                            @lang('labels.print')
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/editors/tinymce/tinymce.min.css') }} " />
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js"
        integrity="sha512-mPA/BA22QPGx1iuaMpZdSsXVsHUTr9OisxHDtdsYj73eDGWG2bTSTLTUOb4TG40JvUyjoTcLF+2srfRchwbodg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            tinymce.init({
                selector: 'textarea.editor',
                menubar: false,
                theme: 'modern',
                plugins: " advlist autolink lists link image charmap print preview textcolor anchor searchreplace visualblocks code fullscreen insertdatetime media table paste imagetools wordcount",
                toolbar: "textcolorinsertfile undo redo | fontselect fontsizeselect | styleselect| textcolor forecolor backcolor  | table  | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link | image | ",
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '{{ asset('theme/vendors/css/editors/tinymce/tinymce.min.css') }}'
                ]
            });

        });
        // Print The page 
        function printDiv() {
            $("#printable").printArea();
        }
    </script>


@endpush
