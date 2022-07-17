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
        @media screen and (max-width: 1200px) {
            .header-navbar .navbar-container ul.nav li > a.nav-link {
                font-size: 14px;
                padding: 1.9rem 0.6rem;
            }
        }

        @media screen and (max-width: 992px)  {
            .content-body .card {
                padding: 0;
            }
        }
        .header-navbar {
            box-shadow: 0 2px 15px 0px rgba(0, 0, 0, 0.05);
        }

    </style>
@endpush()
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="card col-md-10">
            <div class="card-header">
                @lang('tms::training.course.list')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>@lang('labels.serial')</th>
                            <th>@lang('tms::training.title')</th>
                            <th>@lang('tms::course.title')</th>
                            <th>@lang('tms::course.start_time')</th>
                            <th>@lang('tms::course.end_time')</th>
                            <th>@lang('tms::course.deadline')</th>
                            <th>@lang('labels.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($traineeCourses as $traineeCourse)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $traineeCourse->training_name }}</td>
                                <td>{{ $traineeCourse->course_name }}</td>
                                <td>{{ $traineeCourse->start_date }}</td>
                                <td>{{ $traineeCourse->end_date }}</td>
                                <td>{{ $traineeCourse->deadline }}</td>
                                <td class="text-center">
                                    <a href="{{ $traineeCourse->evaluation_url }}"
                                       class="btn btn-sm btn-info">@lang('tms::course_evaluation.title')</a>
                                </td>
                            </tr>
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
        table.dataTable td.dataTables_empty {
            color: red;
        }

    </style>
@endpush

@push('page-js')
    <script>
        $('.table').DataTable( {
            "language": {
                "emptyTable": "@lang('tms::course_evaluation.course_empty_lists')"
            }
        } );
    </script>
@endpush


