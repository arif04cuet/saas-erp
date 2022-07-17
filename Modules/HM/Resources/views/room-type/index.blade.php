@extends('hm::layouts.master')
@section('title', __('hm::roomtype.title'))
@section('content')
    <section id="room-type-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{trans('hm::roomtype.card_title')}}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{url(route('room-types.create'))}}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i>{{trans('hm::roomtype.create_button')}}</a>
    
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="master room-type-rate-list-table table table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('labels.name')}}</th>
                                        <th>{{trans('hm::roomtype.capacity')}}</th>
                                        <th>{{trans('hm::roomtype.rate')}}</th>
                                        {{-- <th>{{trans('hm::roomtype.government_personal_rate')}}</th>
                                        <th>{{trans('hm::roomtype.non_government_rate')}}</th>
                                        <th>{{trans('hm::roomtype.international_rate')}}</th>
                                        <th>{{trans('hm::roomtype.bard_rate')}}</th>
                                        <th>{{trans('hm::roomtype.other_rate')}}</th> --}}
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roomTypes as $type)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{$type->name}}</td>
                                            <td>{{$type->capacity}}</td>
                                            <td>{{$type->government_official_rate}} &#2547;</td>
                                            {{-- <td>{{$type->government_personal_rate}} &#2547;</td>
                                            <td>{{$type->non_government_rate}} &#2547;</td>
                                            <td>{{$type->international_rate}} &#2547;</td>
                                            <td>{{$type->bard_rate}} &#2547;</td> --}}
                                            {{-- <td>{{$type->others_rate}} &#2547;</td> --}}
                                            <td class="text-center">
                                                {{-- <span class="dropdown">
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle"><i class="la la-cog"></i></button>
                                                  <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <a href="{{URL::to( '/hm/room-types/'.$type->id.'/edit')}}" class="dropdown-item"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                                                    <div class="dropdown-divider"></div>
                                                      {!! Form::open([
                                                      'method'=>'DELETE',
                                                      'url' => [ '/hm/room-types', $type->id],
                                                      'style' => 'display:inline'
                                                      ]) !!}
                                                      {!! Form::button('<i class="ft-trash"></i> '.trans('labels.delete'), array(
                                                      'type' => 'submit',
                                                      'class' => 'dropdown-item',
                                                      'title' => 'Delete the room type',
                                                      'onclick'=>'return confirm("Confirm delete?")',
                                                      )) !!}
                                                      {!! Form::close() !!}
                                                  </span>
                                                </span> --}}

                                                <div class="btn-group">
                                                    {{-- @can('update_trainings') --}}
                                                        <a href="{{ route('room-types.edit', $type->id) }}" class="master btn btn-info">
                                                            <i class="ft-edit-2"></i>
                                                            <!-- {{ trans('labels.edit') }} -->
                                                        </a>
                                                    {{-- @endcan --}}

                                                    {{-- @can('view_trainings') --}}
                                                        {{-- <a href="{{ route('room-types.show', $type->id) }}" class="master btn btn-success">
                                                            <i class="ft-eye white"></i>
                                                            <!-- {{ trans('labels.details') }} -->
                                                        </a> --}}
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
    </section>
@endsection

@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {

            let table = $('.room-type-rate-list-table').DataTable({
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
                // scrollY:        500,
                scrollX: true,
                scrollCollapse: true,
                // paging:         false,
                // fixedColumns:   true,
                fixedColumns: {
                    leftColumns: 3
                },
                // select: true
            });
        });
    </script>
@endpush

