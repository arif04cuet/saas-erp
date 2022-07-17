@extends($module . '::layouts.master')
@section('title', __('monthly-update.title'))

@section('content')
    <section id="user-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{ trans('monthly-update.edit_form_title') }}</h4>
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
                            {{ Form::open(['url' => $action, 'method' => 'PUT', 'class' => 'form', 'files' => 'true']) }}
                            @include('monthly-update.partials.form', [
                                'cardTitle' => trans('monthly-update.edit_form_title')
                            ])
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/ui/jquery-ui.min.css') }}">
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
@endpush

@push('page-js')
    <script src="{{ asset('theme/js/core/libraries/jquery_ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/ui/jquery-ui/date-pickers.js') }}"></script>
    <script src="{{ asset('js/month-year/custom-jquery-datepicker.js') }}"></script>
    <script>
        function deleteAttachment(id) {
            document.getElementById(id).className = 'list-group-item list-group-item-dark';
            $('#repeat-attachments').append('<input type="hidden" name="deleted_attachments[]" value="'+id+'">');
        }
        $(document).ready(function () {
            monthYearDatePicker('input[name=date]');

            $('#add').click(function () {
                $('#repeat-attachments').append('<br><input type="file" class="form-control" name="attachments[]">');
            });
            $('.select2').select2({
                multiple: true,
                placeholder: "{{ __('monthly-update.select_tasks') }}",
            });
        });
    </script>
@endpush
