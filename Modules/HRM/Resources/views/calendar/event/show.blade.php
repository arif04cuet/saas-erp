@extends('hrm::layouts.master')

@section('title', trans('hrm::calendar.event_detail'))

@section('content')
    <section id="card-footer-options">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::calendar.event_detail')
                            {{--                            <span class="badge bg-teal">Type</span>--}}
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        </h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @if(!empty($calendarEvent))
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>{{trans('hrm::calendar.create_event_title')}}</th>
                                        <td>{{$calendarEvent->title}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{trans('hrm::calendar.event_detail')}}</th>
                                        <td>{{$calendarEvent->description}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{trans('hrm::calendar.event_start_date')}}</th>
                                        <td>{{date('d F, Y', strtotime($calendarEvent->start))}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{trans('hrm::calendar.event_end_date')}}</th>
                                        <td>{{date('d F, Y', strtotime($calendarEvent->end))}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{trans('hrm::calendar.event_total_days')}}</th>
                                        <td>{{$calendarEvent->days}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{trans('labels.status')}}</th>
                                        <td>{{(strtotime($calendarEvent->end) <= strtotime(date('Y-m-d')))? "Active":"Inactive"}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                                <div class="form-actions">
                                    <a href="{{route('calendar-event.edit', $calendarEvent->id)}}" class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                                    {{--<a href="{{URL::to( '/tms/trainee/show/'.$training->id)}}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a>--}}
                                    <a class="btn btn-warning" onclick="window.history.back()" href="#">
                                        <i class="ft-x"></i> {{trans('labels.back_page')}}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection

@push('page-js')
@endpush