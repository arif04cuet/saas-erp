@extends('vms::layouts.master')
@section('title', trans('vms::fillingStation.title'))

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('vms::fillingStation.index')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <a href="{{route('vms.fillingStation.create')}}" class="btn btn-info btn-sm"><i
                            class="ft-plus white"></i> {{ trans('vms::fillingStation.registration') }}
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
                                <th>@lang('vms::fillingStation.form_elements.station_name')</th>
                                <th>@lang('vms::fillingStation.form_elements.address')</th>
                                <th>@lang('vms::fillingStation.form_elements.contact_person_name')</th>
                                <th>@lang('vms::fillingStation.form_elements.mobile_number')</th>
                                <th width="2%">@lang('labels.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($fillingStation as $info)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $info->name }}</td>
                                    <td>{{ $info->address }}</td>
                                    <td>{{ $info->contact_person_name }}</td>
                                    <td>{{ $info->contact_person_mobile }}</td>
                                    <td>
                                    <span class="dropdown">
                                        <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"
                                                class="btn btn-info dropdown-toggle">
                                            <i class="la la-cog"></i>
                                        </button>
                                        <span aria-labelledby="imsRequestList"
                                              class="dropdown-menu mt-1 dropdown-menu-right">
                                            <a href="{{ route('vms.fillingStation.show', $info->id) }}"
                                               class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                            <div class="dropdown-divider"></div>
                                                <a href="{{ route('vms.fillingStation.edit', $info->id) }}"
                                                   class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>
                                            <div class="dropdown-divider"></div>
                                                    {!! Form::open([
                                                        'method'=>'DELETE',
                                                        'url' => route('vms.fillingStation.delete', $info->id),
                                                        'style' => 'display:inline'
                                                    ]) !!}
                                            {!! Form::button('<i class="ft-trash"></i>'.trans('labels.delete'), array(
                                                'type' => 'submit',
                                                'class' => 'dropdown-item',
                                                'title' => 'Delete the Medicine',
                                                'onclick'=>'return confirm("Confirm delete?")',
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
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.company-list-table').DataTable({
                'stateSave': true
            });
        });
    </script>
@endpush
