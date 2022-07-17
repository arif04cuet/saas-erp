@extends('accounts::layouts.master')
@section('title',trans('accounts::gpf.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::gpf.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('gpf.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> @lang('accounts::gpf.gpf_create')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination" style="text-align: center">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th>@lang('labels.name')</th>
                                    <td><strong>@lang('accounts::gpf.fund_number')</td>
                                    <td><strong>@lang('accounts::gpf.percentage')</strong></td>
                                    <td><strong>@lang('accounts::gpf.current_balance')</strong></td>
                                    <th>@lang('accounts::payscale.active_from')</th>
                                    <th>@lang('labels.status')</th>
                                    <th width="18%">@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($records as $record)
                                    @php
                                        $employee = $record->employee;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a href="{{route('gpf.show', $record->id)}}">
                                                {{$employee->getName()." - ".$employee->employee_id}}
                                            </a>
                                        </td>
                                        <td>{{$record->fund_number}}</td>
                                        <td>{{$record->current_percentage}}%</td>
                                        <td>{{$record->current_balance}} /=</td>
                                        <td>{{date('d F, Y', strtotime($record->start_date))}}</td>
                                        <td>
                                            @if($record->status == config('constants.gpf_status')[0])
                                                <span class="badge badge-success">
                                            @elseif($record->status == config('constants.gpf_status')[2])
                                                        <span class="badge badge-warning">
                                            @else
                                                                <span class="badge badge-danger">
                                            @endif
                                                                    {{ucwords($record->status)}}
                                                </span>
                                        </td>
                                        <td>

                                            {{--@if($record->status)--}}
                                            {{--<a href="{{route('gpf.activation', $record->id)}}"--}}
                                            {{--class="btn btn-danger btn-sm" title="Deactivate Payscale">--}}
                                            {{--<i class="la la-times-circle"></i>--}}
                                            {{--</a>--}}
                                            {{--@else--}}
                                            {{--<a href="{{route('payscales.activation', $record->id)}}"--}}
                                            {{--class="btn btn-success btn-sm" title="Activate Payscale">--}}
                                            {{--<i class="la la-check-circle"></i>--}}
                                            {{--</a>--}}
                                            {{--@endif--}}

                                            <a href="{{route('gpf.personal-ledger', $employee->id)}}"
                                               class="btn btn-sm btn-info" title="{{__('accounts::gpf.gpf_history')}}">
                                                <i class="la la-file-text-o"></i>
                                            </a>
                                            <a href="{{route('gpf.edit', $record->id)}}" title="{{__('labels.edit')}}"
                                               class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            @if($record->status == config('constants.gpf_status')[0])
                                                <a href="{{route('gpf.settlement', $record->id)}}"
                                                   title="{{__('accounts::gpf.settlement')}}"
                                                   class="btn btn-success btn-sm">
                                                    <i class="la la-check-circle"></i>
                                                </a>
                                            @endif
                                            {{--{!! Form::open([--}}
                                            {{--'method'=>'DELETE',--}}
                                            {{--'url' => route('gpf.destroy', $record->id),--}}
                                            {{--'style' => 'display:inline'--}}
                                            {{--]) !!}--}}
                                            {{--{!! Form::button('<i class="la la-trash-o"></i>', array(--}}
                                            {{--'type' => 'submit',--}}
                                            {{--'class' => 'btn btn-danger btn-sm',--}}
                                            {{--'title' => 'Delete GPF Record',--}}
                                            {{--'onclick'=> 'return confirm("Confirm delete?")',--}}
                                            {{--)) !!}--}}
                                            {{--{!! Form::close() !!}--}}
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
    </section>
@endsection

