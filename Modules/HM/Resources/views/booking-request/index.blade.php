@extends('hm::layouts.master')
@section('title', trans('hm::booking-request.booking_request') . ' ' . trans('labels.list'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form"><i class="ft-list black"></i> @lang('hm::booking-request.booking_request') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                        <div class="heading-elements">
                            <a href="{{ route('booking-requests.create') }}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('hm::booking-request.new_booking_request') }}
                            </a>
                            <a href="{{ route('booking-requests.check') }}" class="btn btn-warning btn-sm"><i
                                    class="ft-trash"></i> {{ trans('hm::booking-request.cancel.title') }}
                            </a>

                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="master booking-request-table table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>@lang('labels.id')</th>
                                            <th>@lang('hm::booking-request.booked_by')</th>
                                            <th>@lang('hm::booking-request.check_in_date')</th>
                                            <th>@lang('hm::booking-request.check_out_date')</th>
                                            <th>@lang('hm::booking-request.organization')</th>
                                            <th>@lang('hm::booking-request.bard_reference')</th>
                                            <th>@lang('hm::booking-request.guests')</th>
                                            <th>@lang('labels.status')</th>
                                            <th>@lang('labels.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($bookingRequests as $bookingRequest)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ route('booking-requests.show', $bookingRequest->id) }}">{{ $bookingRequest->requester->getName() }}</a>
                                                </td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $bookingRequest->start_date)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $bookingRequest->end_date)->format('d/m/Y') }}</td>
                                                <td>{{ $bookingRequest->requester->organization }}</td>
                                                <td>{{ $bookingRequest->referee ? $bookingRequest->referee->getName() : null }}</td>
                                                <td>
                                                    @if($bookingRequest->booking_type == \Modules\HM\Entities\RoomBooking::getBookingTypes()['training']
                                                   && !is_null($bookingRequest->training_id))
                                                        {{ $bookingRequest->training->no_of_trainee ?? 0 }}
                                                    @else
                                                        {{ $bookingRequest->guestInfos->count() ?? 0  }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @lang('hm::booking-request.' . $bookingRequest->status)
                                                </td>
                                                <td>
                                                    {{-- @can('hm-access') --}}
                                                        @if( $bookingRequest->status == 'pending' )
                                                            <a href="{{ route('booking-requests.edit', $bookingRequest->id) }}"
                                                               class="btn btn-sm btn-primary"><i class="ft-edit-2"></i></a>
                                                        @endif
                                                    {{-- @endcan --}}
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
    </div>
@endsection

@push('page-js')
    <script>
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                let filterValue = $('#filter-select').val() || '{!! trans('hm::booking-request.pending') !!}';
                if (data[7] == filterValue) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function () {
            let table = $('.booking-request-table').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 8}
                ],
                "language": {
                    "search": "{{ trans('labels.search') }}",
                    "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                    "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                    "info": "{{trans('labels.showing')}} _START_ {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
                    "infoFiltered": "( {{ trans('labels.total')}} _MAX_ {{ trans('labels.infoFiltered') }} )",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "{{ trans('labels.next') }}",
                        "previous": "{{ trans('labels.previous') }}"
                    },
                }
            });

            $("div.dataTables_length").append(`
                <label style="margin-left: 20px">
                    {{ trans('labels.filtered') }}
            <select id="filter-select" class="form-control form-control-sm" style="width: 100px">
                <option value="{{ trans('hm::booking-request.pending') }}">{{ trans('hm::booking-request.pending') }}</option>
                        <option value="{{ trans('hm::booking-request.approved') }}">{{ trans('hm::booking-request.approved') }}</option>
                        <option value="{{ trans('hm::booking-request.rejected') }}">{{ trans('hm::booking-request.rejected') }}</option>
                        <option value="{{ trans('hm::booking-request.verified') }}">{{ trans('hm::booking-request.verified') }}</option>
                        </select>
                    {{ trans('labels.records') }}
            </label>
`);

            $('#filter-select').on('change', function () {
                table.draw();
            });
        });
    </script>
@endpush
