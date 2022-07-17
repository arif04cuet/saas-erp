@extends('hm::layouts.master')
@section('title', trans('hm::booking-request.check_in') . ' ' . trans('labels.list'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('hm::booking-request.check_in') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('check-in.create-options') }}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i> @lang('hm::booking-request.check_in') @lang('hm::booking-request.create')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="master table table-bordered alt-pagination">
                                            <thead>
                                            <tr>
                                                <th>@lang('labels.serial')</th>
                                                <th>@lang('hm::checkin.check_in_number')</th>
                                                <th>@lang('hm::checkin.booking_id')</th>
                                                <th>@lang('labels.name')</th>
                                                <th>@lang('hm::booking-request.no_of_guests')</th>
                                                <th>@lang('hm::booking-request.check_in')</th>
                                                <th>@lang('hm::checkin.estimated_check_out_time')</th>
                                                <th>@lang('hm::checkin.estimated_no_of_day')</th>
                                                <th>@lang('labels.status')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($checkins as $checkin)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="{{ route('check-in.show', $checkin->id) }}">{{ $checkin->shortcode }}</a>
                                                    </td>
                                                    <td>{{ $checkin->booking ? $checkin->booking->roomBooking->shortcode : null }}</td>
                                                    <td>{{ $checkin->requester->getName() }}</td>
                                                    <td>{{ $checkin->guestInfos()->count() }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($checkin->start_date)->format('d/m/Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($checkin->end_date)->format('d/m/Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($checkin->start_date)->diffInDays(\Carbon\Carbon::parse($checkin->end_date)) }}</td>
                                                    <td>{{ $checkin->actual_end_date ? trans('hm::checkin.absent') : trans('hm::checkin.present') }}</td>
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
    </div>
@endsection

@push('page-js')
    <script>
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                let filterValue = $('#filter-select').val() || '{!! trans('hm::checkin.present') !!}';
                if (data[8] == filterValue) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function () {
            $("div.dataTables_length").append(`
                <label style="margin-left: 20px">
                    {{ trans('labels.filtered') }}
                    <select id="filter-select" class="form-control form-control-sm" style="width: 100px">
                        <option value="{{ trans('hm::checkin.present') }}">{{ trans('hm::checkin.present') }}</option>
                        <option value="{{ trans('hm::checkin.absent') }}">{{ trans('hm::checkin.absent') }}</option>
                    </select>
                    {{ trans('labels.records') }}
                </label>
            `);

            $('#filter-select').on('change', function () {
                $('.table').DataTable().draw();
            });
        });
    </script>
@endpush
