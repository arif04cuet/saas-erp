@extends('layouts.public')
@section('title', trans('tms::training.training_list'))

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('tms::training.training_list') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered alt-pagination">
                                <thead>
                                    <tr>
                                        <th>{{ trans('labels.serial') }}</th>
                                        <th>{{ trans('tms::training.training_name') }}</th>
                                        <th>{{ trans('tms::training.registration_deadline') }}</th>
                                        <th>{{ trans('tms::training.start_date') }}</th>
                                        <th>{{ trans('tms::training.end_date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($trainings as $training)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td><a
                                                    href="{{ route('trainings.trainees.registrations.check', ['training' => $training]) }}">{{ $training->title }}</a>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($training->registration_deadline)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($training->start_date)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($training->end_date)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
