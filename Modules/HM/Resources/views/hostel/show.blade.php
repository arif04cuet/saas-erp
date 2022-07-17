@extends('hm::layouts.master')
@section('title', __('hm::hostel.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('hm::hostel.title') @lang('labels.details')</h4>
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
                            <div class="row">
                                <div class="col-md-2">
                                    <b>@lang('labels.name'):</b>
                                    {{ $hostel->name }}
                                </div>
                                <div class="col-md-2">
                                    <b>@lang('hm::hostel.total_floor'):</b>
                                    {{ $hostel->total_floor }}
                                </div>
                                <div class="col-md-2">
                                    <b>@lang('hm::hostel.total_rooms'):</b>
                                    {{ count($hostel->rooms) }}
                                </div>
                            </div>

                            <hr/>
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>@lang('hm::hostel.room') @lang('labels.details')</h3>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <a href="{{ route('rooms.create', $hostel->id) }}" class="btn btn-primary btn-sm"><i
                                            class="ft-plus white"></i> @lang('hm::hostel.add_room')</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="room-table" class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th>@lang('hm::roomtype.title')</th>
                                        <th>@lang('hm::hostel.room') @lang('labels.number')</th>
                                        <th>@lang('labels.status')</th>
                                        <th>@lang('hm::hostel.floor')</th>
                                        <th>@lang('hm::roomtype.capacity')</th>
                                        <th>{{trans('hm::roomtype.government_official_rate')}}</th>
                                        <th>{{trans('hm::roomtype.government_personal_rate')}}</th>
                                        <th>{{trans('hm::roomtype.non_government_rate')}}</th>
                                        <th>{{trans('hm::roomtype.bard_rate')}}</th>
                                        <th><i class="ft-activity"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($hostel->rooms as $room)
                                        @php
                                            $type = $room->roomType;
                                            $badgeClass = [
                                                'available'=>'success',
                                                'unavailable'=>'danger',
                                                'partially-available'=>'danger',
                                                'not-in-service'=>'danger',
                                            ];
                                        @endphp
                                        <tr>
                                            <td>{{ $type->name ?? trans('labels.not_found') }}</td>
                                            <td>{{ $room->room_number ?? 0  }}</td>
                                            <td><span
                                                    class="badge-{{$badgeClass[$room->status]}} badge">{{ trans('hm::room.status_' . $room->status) }}</span>
                                            </td>
                                            <td>{{ $room->floor ?? 0 }}</td>
                                            <td>{{ $type->capacity ?? 0 }}</td>
                                            <td>{{$type->government_official_rate ?? 0}} &#2547;</td>
                                            <td>{{$type->government_personal_rate ?? 0 }} &#2547;</td>
                                            <td>{{$type->non_government_rate ?? 0}} &#2547;</td>
                                            <td>{{$type->bard_rate ?? 0}} &#2547;</td>
                                            <td>
                                                <span class="dropdown">
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle"><i
                                                        class="la la-cog"></i></button>
                                                    <span aria-labelledby="btnSearchDrop2"
                                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                                        @if($room->status == 'available')
                                                            <!-- Edit option -->
                                                                <div class="dropdown-divider"></div>
                                                                {{ Form::open([
                                                                    'route' => ['rooms.status.update', $room->id],
                                                                    'method' => 'PUT',
                                                                    'style' => 'display: inline'
                                                                ]) }}
                                                                {{ Form::hidden('status', 'not-in-service') }}
                                                                <button class="dropdown-item"
                                                                        onclick="return confirm('{{ trans('labels.confirm_action') }}?')">
                                                                <i class="ft-alert-circle"></i>
                                                                @lang('hm::room.status_not-in-service')
                                                            </button>
                                                                {{ Form::close() }}
                                                            @elseif($room->status == 'unavailable')
                                                                <div class="dropdown-divider"></div>
                                                                {{ Form::open([
                                                                    'route' => ['rooms.status.update', $room->id],
                                                                    'method' => 'PUT',
                                                                    'style' => 'display: inline'
                                                                ]) }}
                                                                {{ Form::hidden('status', 'available') }}
                                                                <button class="dropdown-item"
                                                                        onclick="return confirm('{{ trans('labels.confirm_action') }}?')">
                                                                <i class="ft-check"></i>
                                                                @lang('hm::room.status_available')
                                                            </button>
                                                                {{ Form::close() }}
                                                            @endif
                                                        <div class="dropdown-divider"></div>
                                                              <a href="{{ route('rooms.edit', $room) }}"
                                                                 class="dropdown-item">
                                                                    <i class="ft-edit-2"></i>
                                                                    @lang('labels.edit')
                                                            </a>
                                                        <div class="dropdown-divider"></div>
                                                        {!! Form::open([
                                                            'method'=>'DELETE',
                                                            'route' => [ 'rooms.destroy', $room->id],
                                                            'style' => 'display:inline'
                                                        ]) !!}
                                                            {!! Form::button('<i class="ft-trash"></i>'.trans('labels.delete'), array(
                                                                'type' => 'submit',
                                                                'class' => 'dropdown-item',
                                                                'title' => __('labels.delete'),
                                                                'onclick' => 'return confirm("' . trans('labels.confirm_delete') . '")',
                                                            )) !!}
                                                            {!! Form::close() !!}
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <a class="btn btn-warning mr-1" role="button" href="{{route('hostels.index')}}">
                                    <i class="ft-arrow-left"></i> @lang('labels.back_page')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-js')
    <script>
        $(document).ready(function () {
            $('#room-table').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'lB><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7],
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7],
                        }
                    },
                    // {
                    //     extend: 'pdf', className: 'pdf',
                    //     exportOptions: {
                    //         columns: [0, 1, 2, 3, 4, 5, 6, 7],
                    //     }
                    // },
                    {
                        extend: 'print', className: 'print',
                        text: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7],
                        }
                    },
                ],
                "columnDefs": [
                    {"orderable": false, "targets": 9}
                ],
                "bDestroy": true,


            });
        });
    </script>
@endpush
