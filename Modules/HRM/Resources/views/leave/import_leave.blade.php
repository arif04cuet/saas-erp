@extends('hrm::layouts.master')
@section('title', trans('hrm::leave.leave_application'))

@section('content')
    <div id="loader"></div>
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::leave.leave_application')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('consumed-leave-import') }}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> Import</a>

                            <a href="{{ route('leaves.create') }}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> @lang('hrm::leave.leave_application')</a>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            {!! Form::open(['route' => ['consumed-leave-store'], 'class' => 'form', 'novalidate', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                            <h3 class="form-section"><i class="ft-grid"></i> </h3>
                            <div class="row">
                                <div class="col-md-6">
                                    {!! Form::label('attachment', __('labels.attachments'), ['class' => 'form-label']) !!}
                                    {!! Form::file('attachment', [
    'class' => 'form-control' . ($errors->has('attachment') ? ' is-invalid' : ''),
    'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf',
    'data-rule-attachment-or-details' => 'details',
    'data-msg-attachment-or-details' => trans('hrm::leave.leave_application'),
]) !!}
                                    <div class="help-block"></div>
                                    @if ($errors->has('attachment'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('attachment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary" onclick="play()">
                                    <i class="ft-check-square"></i> {{ trans('labels.save') }}
                                </button>
                                <button class="btn btn-warning" type="button"
                                    onclick="window.location = '{{ route('leaves.index') }}'">
                                    <i class="ft-x"></i> {{ trans('labels.cancel') }}
                                </button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="loader">
        <div class="loading">
        </div>
    </div>


@endsection


@push('page-js')
    <script>
        var spinner = $('#loader');

        function play() {
            var spinner = $('#loader');
            spinner.show();
        }
        $(document).ready(function() {


        });
    </script>
@endpush
