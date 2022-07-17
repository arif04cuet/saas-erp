@extends('hm::layouts.master')
@section('title', 'Rooms List')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Rooms List</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            {{--<a href="{{ route('hostels.create') }}" class="btn btn-primary btn-sm"><i--}}
                            {{--class="ft-plus white"></i> New Hostel</a>--}}
                        </div>
                    </div>

                    <div class="card-body">
                        @if(Session::get('message'))
                            <h4>
                                {{Session::get('message')}}
                            </h4>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Hostel</th>
                                    <th scope="col">Shortcode</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $room->hostel->name }}</td>
                                        <td>{{ $room->shortcode }}</td>
                                        <td>{{ $room->roomType->name }}</td>
                                        <td>{{ $room->level }}</td>
                                        <td>
                                             <span class="dropdown">
                                                 <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                         aria-haspopup="true"
                                                         aria-expanded="false" class="btn btn-info dropdown-toggle"><i
                                                             class="la la-cog"></i></button>
                                                 <span aria-labelledby="btnSearchDrop2"
                                                       class="dropdown-menu mt-1 dropdown-menu-right">
                                                 <a href="#"
                                                    class="dropdown-item"><i class="ft-eye"></i> Details</a>
                                                 <a href="{{ route('rooms.edit', $room->id) }}"
                                                    class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                                                 <div class="dropdown-divider"></div>
                                                     {!! Form::open([
                                                         'method'=>'DELETE',
                                                         'url' => route('rooms.destroy', $room->id),
                                                         'style' => 'display:inline'
                                                     ]) !!}
                                                     {!! Form::button('<i class="ft-trash"></i> Delete ', array(
                                                         'type' => 'submit',
                                                         'class' => 'dropdown-item',
                                                         'title' => 'Delete the hostel',
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
    </div>
@endsection
