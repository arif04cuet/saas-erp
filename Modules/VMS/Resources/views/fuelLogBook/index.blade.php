@extends('vms::layouts.master')
@section('title', trans('vms::fuelLogBook.title'))

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('vms::fuelLogBook.index')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <a href="{{route('vms.fuel.log.create')}}" class="btn btn-info btn-sm"><i
                            class="ft-plus white"></i> {{ trans('vms::fuelLogBook.registration') }}
                    </a>
                </div>
            </div>
            <div class="card-content ">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="company-list-table table table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">{{ trans('labels.serial') }}</th>
                                <th>@lang('vms::fuelLogBook.form_elements.vehicle')</th>
                                <th>@lang('vms::fuelLogBook.form_elements.type')</th>
                                <th>@lang('vms::fuelLogBook.form_elements.fuel_type')</th>
                                <th>@lang('vms::fuelLogBook.form_elements.fuel_quantity')</th>
                                <th>@lang('vms::fuelLogBook.form_elements.filling_station')</th>
                                <th>@lang('vms::fuelLogBook.form_elements.amount')</th>
                                <th>@lang('vms::fuelLogBook.attachment')</th>
                                <th>@lang('labels.status')</th>
                                <th>@lang('labels.date')</th>

                                <th width="2%">@lang('labels.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($fuelLog as $info)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$info->vehicle->name ?? trans('labels.not_found')}}</td>
                                    <td>{{$info->vehicleType->getTitle() ?? trans('labels.not_found')}}</td>
                                    <td>{{ trans("vms::fuelLogBook.fuel_type.".$info->fuel_type) }}</td>
                                    <td>{{ $info->fuel_quantity ?? trans('labels.not_found')}}</td>
                                    <td>{{ $info->fillingStation->name ?? trans('labels.not_found')}}</td>
                                    <td>{{ $info->amount ?? trans('labels.not_found') }}</td>
                                    @if(empty($info->acknowledgement_slip))
                                        <td>
                                            <button class="btn btn-sm btn-success" data-toggle="modal"
                                                    onclick="aplicationAttachmentAdd({{$info['id']}})"
                                                    data-target="#myModal">Attach
                                            </button>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ route('file.getfile',['filePath'=>$info['acknowledgement_slip']]) }}"
                                               target="_blank" class="btn btn-info btn-sm">
                                                View
                                            </a>
                                        </td>
                                    @endif
                                    <td>@lang("vms::fuelLogBook.status.$info->status")</td>
                                    <td>{{  date('d M Y', strtotime($info->date)) }}</td>
                                    <td>
                                    <span class="dropdown">
                                        <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"
                                                class="btn btn-info dropdown-toggle">
                                            <i class="la la-cog"></i>
                                        </button>
                                        <span aria-labelledby="imsRequestList"
                                              class="dropdown-menu mt-1 dropdown-menu-right">
                                            <a href="{{ route('vms.fuel.log.show', $info->id) }}"
                                               class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                            <div class="dropdown-divider"></div>
                                                <a href="{{ route('vms.fuel.log.edit', $info->id) }}"
                                                   class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>
                                            {{--                                            <div class="dropdown-divider"></div>--}}
                                            {{--                                                    {!! Form::open([--}}
                                            {{--                                                        'method'=>'DELETE',--}}
                                            {{--                                                        'url' => route('vms.fuel.log.delete', $info->id),--}}
                                            {{--                                                        'style' => 'display:inline'--}}
                                            {{--                                                    ]) !!}--}}
                                            {{--                                            {!! Form::button('<i class="ft-trash"></i>'.trans('labels.delete'), array(--}}
                                            {{--                                                'type' => 'submit',--}}
                                            {{--                                                'class' => 'dropdown-item',--}}
                                            {{--                                                'title' => 'Delete the Medicine',--}}
                                            {{--                                                'onclick'=>'return confirm("Confirm delete?")',--}}
                                            {{--                                            )) !!}--}}
                                            {{--                                            {!! Form::close() !!}--}}

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
    @include('vms::fuelLogBook.modal')
@endsection

@push('page-js')
    <script type="text/javascript">
        function aplicationAttachmentAdd(id) {
            $('#acknowledgement_slip_id').val('');
            $('#acknowledgement_slip_id').val(id);
        }
        $(document).ready(function () {
            $('.company-list-table').DataTable({
                'stateSave': true
            });
        });
    </script>
@endpush
