@extends('vms::layouts.master')
@section('title', trans('vms::fuelLogBook.title'))

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('vms::fuelBillSubmit.index')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <a href="{{route('vms.fuel.bill.create')}}" class="btn btn-info btn-sm"><i
                            class="ft-plus white"></i> {{ trans('vms::fuelLogBook.registration') }}
                    </a>
                </div>
            </div>
            <div class="card-content ">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="fuel-bill-list-table table table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">{{ trans('labels.serial') }}</th>
                                <th>@lang('vms::fuelBillSubmit.form_elements.filling_station')</th>
                                <th>@lang('labels.date')</th>
                                <th>@lang('vms::fuelBillSubmit.form_elements.amount')</th>
                                <th>@lang('vms::fuelBillSubmit.attachment')</th>
                                <th>@lang('vms::fuelBillSubmit.attachment')</th>
                                <th>@lang('labels.status')</th>


{{--                                <th width="2%">@lang('labels.action')</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($fuelBill as $info)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $info->fillingStation->name ?? trans('labels.not_found')}}</td>
                                    <td>{{  date('d M Y', strtotime($info->date)) }}</td>
                                    <td>{{$info->amount ?? trans('labels.not_found')}}</td>
                                    @if(empty($info->acknowledgement_one))
                                        <td>
                                            {{trans('labels.not_found')}}
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ route('file.getfile',['filePath'=>$info['acknowledgement_one']]) }}"
                                               target="_blank" class="btn btn-info btn-sm">
                                                View
                                            </a>
                                        </td>
                                    @endif

                                    @if(!empty($info->acknowledgement_two))
                                        <td>
                                            <a href="{{ route('file.getfile',['filePath'=>$info['acknowledgement_two']]) }}"
                                               target="_blank" class="btn btn-info btn-sm">
                                                View
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                          {{trans('labels.not_found')}}
                                        </td>
                                    @endif
                                    <td>@lang("vms::fuelBillSubmit.status.$info->status")</td>
{{--                                    <td>@lang("vms::fuelBillSubmit.status.$info->status")</td>--}}


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
        function aplicationAttachmentAdd(id) {
            $('#acknowledgement_slip_id').val('');
            $('#acknowledgement_slip_id').val(id);
        }

        $(document).ready(function () {
            $('.fuel-bill-list-table').DataTable({
                'stateSave': true
            });
        });
    </script>
@endpush
