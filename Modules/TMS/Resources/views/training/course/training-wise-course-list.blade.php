@extends('tms::layouts.master')
@section('title', trans('tms::training.training_list'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-list"></i> {{ trans('tms::training.course.list') }}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            {{-- <div class="heading-elements">
                                <a href="{{route('trainings.courses.create',[$training->id])}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{trans('tms::training.course.add_course')}}</a>
                            </div> --}}
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="master table table-striped table-bordered training-table">
                                        <thead>
                                            <tr>
                                                <th width="10px">{{ trans('labels.serial') }}</th>
                                                <th>{{ trans('tms::training.training_name') }}</th>
                                                <th>@lang('tms::training.evaluation.course_name')</th>
                                                <th>{{ trans('tms::course.start_time') }}</th>
                                                <th>{{ trans('tms::course.end_time') }}</th>
                                                <th>{{ trans('tms::training.venue') }}</th>
                                                <th>{{ trans('labels.action') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($courses as $course)
                                                <tr>
                                                    <td scope="row">
                                                        {{ $loop->iteration }}</th>
                                                    <td>
                                                        <a href="{{ route('training.show', $training->id) }}">
                                                            {{ $training->title }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{ $course->name ?? trans('labels.not_found') }}
    
                                                    </td>
                                                    <td>
                                                        {{ date('d/m/Y', strtotime($course->start_date)) }}
                                                    </td>
                                                    <td>
                                                        {{ date('d/m/Y', strtotime($course->end_date)) }}
                                                    </td>
                                                    <td>
                                                        {{ App::isLocale('bn') ? optional($course->venue)->title_bn : optional($course->venue)->title }}
                                                    </td>
    
                                                    <td class="text-center">
                                                        {{-- <span class="dropdown">
                                                            <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                class="btn btn-info dropdown-toggle">
                                                                <i class="la la-cog"></i>
                                                            </button>
                                                            <span aria-labelledby="imsRequestList"
                                                                class="dropdown-menu mt-1 dropdown-menu-right">
                                                                <a href="{{ route('trainings.courses.show', [$training, $course]) }}"
                                                                    class="dropdown-item">
                                                                    <i class="ft-eye"></i>
                                                                    {{ trans('labels.details') }}
                                                                </a>
                                                            </span>
                                                        </span> --}}

                                                        <div class="btn-group">
                                                            {{-- @can('update_trainings') --}}
                                                                <a href="{{ route('trainings.courses.show', [$training, $course]) }}" class="master btn btn-info" title="{{ trans('labels.details') }}">
                                                                    <i class="ft-eye"></i>
                                                                    <!-- {{ trans('labels.edit') }} -->
                                                                </a>
                                                            {{-- @endcan --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script>
        function getMomentDates(dateRange) {
            let dateFormat = 'DD/MM/YYYY';
            let [startDate, endDate] = dateRange.split('-');
            startDate = moment(startDate.trim(), dateFormat);
            endDate = moment(endDate.trim(), dateFormat);
            return {
                startDate,
                endDate
            };
        }

        $(document).ready(function() {
            let categoryFilterElementId = 'filter-category';
            let statusFilterElementId = 'filter-status';
            let dateFilterElementId = 'filter-date';

            let table = $('.training-table').dataTable({});


        });
    </script>
@endpush
