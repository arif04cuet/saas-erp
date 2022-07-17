@extends('mms::layouts.master')
@section('title', trans('mms::prescription.title'))
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{trans('mms::prescription.list')}}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements" style="top: 10px;">
                    <ul class="list-inline mb-1">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="prescriptions-list-table table table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">{{ trans('labels.serial') }}</th>
                                <th>{{trans('mms::prescription.id')}}</th>
                                <th>{{trans('labels.name')}}</th>

                                <th>@lang('mms::prescription.mobile')</th>
                                <th>@lang('mms::prescription.age')</th>
                                <th>@lang('mms::prescription.gender')</th>
{{--                                <th>{{trans('labels.date')}}</th>--}}
{{--                                <th width="2%">@lang('labels.action')</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($prescriptions as $prescription)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$prescription->patient['patient_id']}}</td>
                                    <td>
                                        <a href="{{ route('prescriptions.list_by_user',$prescription->patient['patient_id']) }}">
                                        {{$prescription->name}}
                                        <a>
                                    </td>
                                    <td>{{$prescription->mobile_no}}</td>
                                    <td>{{$prescription->age}}</td>
                                    <td>
                                        @php $gender=$prescription->gender; @endphp
                                        {{trans("mms::prescription.$gender")}}
                                    </td>

{{--                                    <td>{{ date('d-m-Y', strtotime($prescription->date)) }}</td>--}}

{{--                                    <td>--}}
{{--                                    <span class="dropdown">--}}
{{--                                        <button id="imsRequestList" type="button" data-toggle="dropdown"--}}
{{--                                                aria-haspopup="true" aria-expanded="false"--}}
{{--                                                class="btn btn-info dropdown-toggle">--}}
{{--                                            <i class="la la-cog"></i>--}}
{{--                                        </button>--}}
{{--                                        <span aria-labelledby="imsRequestList"--}}
{{--                                              class="dropdown-menu mt-1 dropdown-menu-right">--}}
{{--                                            <a href="{{ route('prescription.show',$prescription->id) }}"--}}
{{--                                               class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>--}}
{{--                                            <div class="dropdown-divider"></div>--}}
{{--                                            @if (Auth::user()->hasRole(['ROLE_DOCTOR']))--}}
{{--                                                <a href="{{ route('prescription.edit',$prescription->id) }}"--}}
{{--                                                   class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>--}}
{{--                                            @endif--}}

{{--                                        </span>--}}
{{--                                    </span>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.prescriptions-list-table').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 1}
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
                },
            });
        });
    </script>
@endpush
