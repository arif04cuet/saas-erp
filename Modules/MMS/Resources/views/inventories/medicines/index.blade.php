@extends('mms::layouts.master')
@section('title', trans('mms::medicine_inventory.site_titel'))
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('mms::medicine.list')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <a href="{{route('inventories.medicines.create')}}" class="btn btn-primary btn-sm"><i
                            class="ft-plus white"></i> {{ trans('mms::medicine.create') }}
                    </a>
                </div>
            </div>
            <div class="card-content ">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="medicine-list-table table table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">{{ trans('labels.serial') }}</th>
                                <th>{{trans('mms::medicine_inventory.medicine_name')}}</th>
                                <th>{{trans('mms::medicine_inventory.group')}}</th>
                                <th>{{trans('mms::medicine_inventory.total_quantity')}}</th>
                                {{--                                <th>{{trans('mms::medicine_inventory.last_update_date')}}</th>--}}
                                <th width="2%">@lang('labels.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($medicineList as $medicine)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$medicine->medicine->name}}</td>
                                    <td>{{$medicine->medicine->group->name}}</td>
                                    <td>{{$medicine->quantity}}</td>
                                    {{--                                <td>{{ date('d-m-Y', strtotime($info->updated_at)) }}</td>--}}
                                    <td>
                                    <span class="dropdown">
                                        <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"
                                                class="btn btn-info dropdown-toggle">
                                            <i class="la la-cog"></i>
                                        </button>
                                        <span aria-labelledby="imsRequestList"
                                              class="dropdown-menu mt-1 dropdown-menu-right">
                                            <a href="{{ route('inventories.medicines.show', $medicine->id) }}"
                                               class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
{{--                                            <div class="dropdown-divider"></div>--}}
                                            {{--                                                <a href="{{ route('inventories.medicines.edit', $info->id) }}"--}}
                                            {{--                                                   class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>--}}

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
@endsection

@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.medicine-list-table').DataTable({
                'stateSave': true
            });
        });
    </script>

@endpush
