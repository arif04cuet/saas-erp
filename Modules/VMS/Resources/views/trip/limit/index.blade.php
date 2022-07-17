@extends('vms::layouts.master')
@section('title',trans('vms::trip.title'))

@section('content')

    <section id="">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('vms::trip.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('vms.trip.limit.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('vms::trip.limit.create') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination text-center"
                                       id="journal_entry_table">
                                    <thead>
                                    <tr>
                                        <th width="5%">@lang('labels.serial')</th>
                                        <th width="20%">@lang('vms::trip.limit.form_elements.designation_id')</th>
                                        <th width="10%">@lang('vms::trip.limit.form_elements.limit')</th>
                                        <th width="30%">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tripLimits as $tripLimit)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{optional($tripLimit->designation)->getName() ?? trans('labels.not_found')}}</td>
                                            <td>{{$tripLimit->limit ?? trans('labels.not_found')}}</td>
                                            <td>
                                                 <span class="dropdown">
                                        <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"
                                                class="btn btn-info dropdown-toggle">
                                            <i class="la la-cog"></i>
                                        </button>
                                        <span aria-labelledby="imsRequestList"
                                              class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="{{ route('vms.trip.limit.edit', $tripLimit) }}"
                                                   class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>
                                        </span>
                                    </span>
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
