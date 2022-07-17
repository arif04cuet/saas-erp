@extends('hm::layouts.master')
@section('title', __('hm::hostel.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="ft-list"></i> @lang('hm::hostel.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('hostels.create') }}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> @lang('labels.new') @lang('hm::hostel.title')</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="hostel" class="master table table-striped table-bordered alt-pagination">
                                <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('labels.name')</th>
                                        <th scope="col">@lang('hm::hostel.total_floor')</th>
                                        <th scope="col">@lang('hm::hostel.total_rooms')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hostels as $hostel)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $hostel->getName() }}</td>
                                            <td>{{ $hostel->total_floor }}</td>
                                            <td>{{ count($hostel->rooms) }}</td>
                                            <td>
                                                {{-- <span class="dropdown">
                                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        class="btn btn-info dropdown-toggle"><i
                                                            class="la la-cog"></i></button>
                                                    <span aria-labelledby="btnSearchDrop2"
                                                        class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('hostels.show', $hostel->id) }}"
                                                            class="dropdown-item"><i class="ft-eye"></i>
                                                            @lang('labels.details')</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('rooms.create', $hostel->id) }}"
                                                            class="dropdown-item"><i class="ft-plus"></i>
                                                            @lang('hm::hostel.add_room')</a>
                                                        <a href="{{ route('hostels.edit', $hostel->id) }}"
                                                            class="dropdown-item"><i class="ft-edit-2"></i>
                                                            @lang('labels.edit')</a>
                                                        <div class="dropdown-divider"></div>
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'url' => route('hostels.destroy', $hostel->id),
                                                            'style' => 'display:inline',
                                                        ]) !!}
                                                        {!! Form::button('<i class="ft-trash"></i>' . trans('labels.delete'), [
                                                            'type' => 'submit',
                                                            'class' => 'dropdown-item',
                                                            'title' => 'Delete the hostel',
                                                            'onclick' => 'return confirm("Confirm delete?")',
                                                        ]) !!}
                                                        {!! Form::close() !!}
                                                    </span>
                                                </span> --}}

                                                <div class="btn-group">
                                                    {{-- @can('update_trainings') --}}
                                                        {{-- <a href="{{ route('room-types.edit', $type->id) }}" class="master btn btn-info">
                                                            <i class="ft-edit-2"></i>
                                                            <!-- {{ trans('labels.edit') }} -->
                                                        </a> --}}
                                                    {{-- @endcan --}}

                                                    {{-- @can('view_trainings') --}}
                                                        <a href="{{ route('hostels.show', $hostel->id) }}" class="master btn btn-success">
                                                            <i class="ft-eye white"></i>
                                                            <!-- {{ trans('labels.details') }} -->
                                                        </a>
                                                    {{-- @endcan --}}

                                                </div>
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
@endsection
