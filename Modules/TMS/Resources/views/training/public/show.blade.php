@extends('layouts.public')
@section('title', trans('tms::training.training_list'))
@push('page-css')
    <style>
        .dataTables_length {
            text-align: left !important;
        }

        .dataTables_filter label {
            margin-left: 10px;
        }
    </style>
@endpush()
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="card col-md-10">
            <div class="card-header">
                @lang('tms::training.training_list')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>@lang('labels.serial')</th>
                            <th>@lang('tms::training.title')</th>
                            <th>@lang('tms::course.title')</th>
                            <th>@lang('tms::module.title')</th>
                            <th>@lang('tms::session.title')</th>
                            <th>@lang('tms::speaker.title')</th>
                            <th>@lang('labels.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($traineeRecords as $traineeRecord)
                            @if($traineeRecord->speaker_name != null)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $traineeRecord->training_name }}</td>
                                    <td>{{ $traineeRecord->course_name }}</td>
                                    <td>{{ $traineeRecord->module_name }}</td>
                                    <td>{{ $traineeRecord->session_name }}</td>
                                    <td>{{ $traineeRecord->speaker_name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('public.speakers.evaluations.create', [
                                            $traineeRecord->course_id,
                                            $traineeRecord->session_id,
                                            $traineeRecord->speaker_id,
                                            $traineeRecord->trainee_id
                                        ]) }}" class="btn btn-sm btn-info">@lang('tms::speaker.evaluation.button.title')</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <style>
        .custom-filter {
            width: 100px;
            float: right;
            margin-left: 10px;
            margin-top: -6px;
            height: 35px;
        }
    </style>
@endpush

@push('page-js')
    <script>
        function addSpeakerFilter() {
            let traineeRecords = @json($traineeRecords);

            let speakers = @json($traineeRecords->pluck('speaker_name')->unique()->values());

            let speakerOptionsHtml = speakers.map(speaker => {
                return `<option>${speaker}</option>`;
            });

            let selectPlaceholder = '{!! trans('labels.select') !!}';
            let speakerFilter = `<label>
                {{ trans('tms::speaker.title') }}
            <select id="speaker-filter" class="form-control form-control-sm custom-filter">
                <option>${selectPlaceholder}</option>
                    ${speakerOptionsHtml}
                </select>
            </label>`;
            $('.dataTables_filter').prepend(speakerFilter);
        }

        $(document).ready(function () {
            let table = $('.table').DataTable();

            addSpeakerFilter();

            $('#speaker-filter').on('change', function () {
                table.draw();
            });

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    let speakerName = data[5];
                    let selectedSpeakerName = $("#speaker-filter").val();
                    let selectPlaceholder = '{!! trans('labels.select') !!}';

                    if (selectedSpeakerName === selectPlaceholder) {
                        return true;
                    }
                    return speakerName === selectedSpeakerName;
                }
            );
        });
    </script>
@endpush
