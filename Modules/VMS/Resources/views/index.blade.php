@extends('vms::layouts.master')
@section('title',trans('labels.VMS'))

@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('labels.notification')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{trans('labels.serial')}}</th>
                                        <th scope="col">@lang('labels.name')</th>
                                        <th scope="col">@lang('labels.message')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pendingNotifications as $pendingNotification)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{  optional($pendingNotification->type)->name ?? trans('labels.not_found') }}</td>
                                            <td>{{ $pendingNotification->message ?? trans('labels.not_found') }}</td>
                                            <td>
                                                <a href="{{$pendingNotification->item_url}}"
                                                   class="btn btn-primary">@lang('labels.details')</a>
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
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

@endpush
