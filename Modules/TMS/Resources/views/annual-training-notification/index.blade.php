@extends('tms::layouts.master')
@section('title', trans('tms::annual_training.list'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="las la-list-alt black"></i> @lang('tms::annual_training.list')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{ route('annual-training-notification.create') }}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i> {{trans('tms::annual_training.create_button')}}</a>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="master table table-striped table-bordered dataex-html5-export {{--dataex-select-multi--}}">
                                    <thead>
                                    <tr>
                                        <th  width="10%">{{trans('labels.serial')}}</th>
                                        <th>{{trans('tms::annual_training.year')}}</th>
                                        <th width="20%">{{trans('tms::annual_training.send_dd')}}</th>
                                        <th>{{trans('tms::annual_training.notified_date')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($notifications as $notification)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$notification->year}}</td>
                                            <td style="text-align: cent">
                                                {{$notification->send_to_divisional_director ?
                                                __('labels.yes') : __('labels.no')}}
                                            </td>
                                            <td>{{\Carbon\Carbon::parse($notification->created_at)->format('d F, Y')}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{route('annual-training-notification.show', $notification->id)}}" class="master btn btn-success" title="{{trans('labels.details')}}">
                                                        <i class="ft-eye white"></i>
                                                        {{-- {{trans('labels.details')}} --}}
                                                    </a>
                                                    {{--<!-- Edit -->--}}
                                                    <a href="{{route('tms-budgets.edit',$notification->id)}}" class="master btn btn-info" title="{{trans('labels.edit')}}"><i class="ft ft-edit"></i>
                                                        {{-- {{trans('labels.edit')}} --}}
                                                    </a>
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
        
    </section>
@endsection

@push('page-js')
    <script
        src="{{ asset('theme/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables-extensions/datatable-select.js') }}"></script>
@endpush
