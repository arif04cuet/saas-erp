@extends('tms::layouts.master')
@section('title', trans('tms::training.training_preparation'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>@lang('tms::training.training_preparation')</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped alt-pagination">
                    <thead>
                    <tr>
                        <th>@lang('labels.serial')</th>
                        <th>@lang('tms::training.training_id')</th>
                        <th>@lang('tms::training.title')</th>
                        <th>@lang('tms::training.start_date')</th>
                        <th>@lang('tms::training.end_date')</th>
                        <th>@lang('tms::training.training_period')</th>
                        <th>@lang('tms::training.training_participant_no')</th>
                        <th>@lang('tms::training.hostel')</th>
                        <th>@lang('tms::training.cafeteria')</th>
                        <th>@lang('tms::training.venue')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trainings as $training)
                        @php
                            $startDate = \Carbon\Carbon::parse($training->start_date);
                            $endDate = \Carbon\Carbon::parse($training->end_date);
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $training->training_id }}</td>
                            <td>{{ $training->training_title }}</td>
                            <td>{{ $startDate->format('d/m/Y') }}</td>
                            <td>{{ $endDate->format('d/m/Y') }}</td>
                            <td>{{ $startDate->diffInDays($endDate) }}</td>
                            <td>{{ $training->no_of_trainee }}</td>
                            <td class="text-center">
                                <a href="{{ route('trainings.hostels.preparations.create', $training->id) }}"
                                   class="btn btn-sm btn-info">@lang('tms::training.plan')</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('trainings.cafeterias.preparations.create', $training->id) }}"
                                   class="btn btn-sm btn-info">@lang('tms::training.plan')</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('trainings.venues.preparations.create', $training->id) }}"
                                   class="btn btn-sm btn-info">@lang('tms::training.plan')</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection