@extends('pms::layouts.master')
@section('title', trans('pms::budget.title'))

@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('pms::budget.sector.list') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('pms-sectors.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> @lang('pms::budget.sector.create')
                            </a>

                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('pms::budget.sector.form.title_bangla')</th>
                                        <th>@lang('labels.title')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sectors as $sector)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <a href="{{route('pms-sectors.show', $sector->id)}}">
                                                    {{$sector->title_bangla}}
                                                </a>
                                            </td>
                                            <td>
                                                {{$sector->title_english}}
                                            </td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <!-- Details -->
                                                        <a href="{{route('pms-sectors.show', $sector->id)}}"
                                                           class="dropdown-item"><i class="ft-eye"></i>
                                                            {{trans('labels.details')}}
                                                        </a>
                                                    <div class="dropdown-divider"></div>
                                                    <!-- Edit -->
                                                     <a href="{{route('pms-sectors.edit',$sector->id)}}"
                                                        class="dropdown-item"><i class="ft ft-edit"></i>
                                                            {{trans('labels.edit')}}
                                                        </a>
                                                    <div class="dropdown-divider"></div>
                                                    {!! Form::open([
                                                     'method'=>'DELETE',
                                                     'url' => route('pms-sectors.destroy', $sector->id),
                                                     'style' => 'display:inline'
                                                     ]) !!}
                                                    {!! Form::button('<i class="la la-trash-o"></i> '.__('labels.delete'), array(
                                                    'type' => 'submit',
                                                    'class' => 'dropdown-item',
                                                    'onclick'=> 'return confirm("'.__('labels.confirm_delete').'")',
                                                    )) !!}
                                                    {!! Form::close() !!}
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
    <script>
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'csv', 'print'],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });
    </script>

@endpush
