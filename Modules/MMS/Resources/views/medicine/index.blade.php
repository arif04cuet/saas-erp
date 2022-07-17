@extends('mms::layouts.master')
@section('title', trans('mms::medicine.title'))

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('mms::medicine.list')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <a href="{{route('medicine.create')}}" class="btn btn-primary btn-sm"><i
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
                                <th>@lang('mms::medicine.name')</th>
                                <th>@lang('mms::medicine.generic_name')</th>
                                <th>@lang('mms::medicine.group')</th>
                                <th>@lang('mms::medicine.company')</th>
                                <th>@lang('mms::medicine.category_name')</th>
                                <th width="2%">@lang('labels.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($medicinelist as $medicine)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $medicine->name }}</td>
                                    <td>{{ $medicine->generic_name }}</td>
                                    <td>{{ $medicine->group->name }}</td>
                                    <td>{{ $medicine->company_name }}</td>
                                    <td>{{$medicine->inventoryCategory['name'] ?? trans('labels.not_found')}}</td>
                                    <td>
                                    <span class="dropdown">
                                        <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"
                                                class="btn btn-info dropdown-toggle">
                                            <i class="la la-cog"></i>
                                        </button>
                                        <span aria-labelledby="imsRequestList"
                                              class="dropdown-menu mt-1 dropdown-menu-right">
                                            <a href="{{ route('medicine.show', $medicine->id) }}"
                                               class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                            <div class="dropdown-divider"></div>
                                                <a href="{{ route('medicine.edit', $medicine->id) }}"
                                                   class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>
                                                   <div class="dropdown-divider"></div>
                                                    {!! Form::open([
                                                        'method'=>'DELETE',
                                                        'url' => route('medicine.delete', $medicine->id),
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
            $('.medicine-list-table').DataTable({
                'stateSave': true
            });
        });
    </script>
@endpush
