@extends('tms::layouts.master')
@section('title', trans('tms::budget.title'))

@section('content')
    <section id="role-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="ft-list black"></i> {{ trans('tms::budget.sector.list') }}</h4>
                            {{-- <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a> --}}
                            <div class="heading-elements">
                                <a href="{{route('tms-sectors.create')}}" class="btn btn-primary btn-sm">
                                    <i class="ft-plus white"></i> @lang('tms::budget.sector.create')
                                </a>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="master table table-striped table-bordered alt-pagination" id="Example1">
                                        <thead>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>@lang('tms::budget.sector.form.title_bangla')</th>
                                            <th>@lang('labels.title')</th>
                                            <th>@lang('labels.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sectors as $key => $sector)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>
                                                    <a href="{{route('tms-sectors.show', $sector->id)}}">
                                                        {{$sector->title_bangla}}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{$sector->title_english}}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{{route('tms-sectors.show', $sector->id)}}" class="master btn btn-info" title="{{trans('labels.details')}}">
                                                            <i class="ft-eye white"></i>
                                                        </a>
                                                        <a href="{{route('tms-sectors.edit',$sector->id)}}" class="master btn btn-success" title="{{trans('labels.edit')}}">
                                                            <i class="ft-edit white"></i>
                                                        </a>
                                                        <a href="#" class="master btn btn-danger"
                                                            onclick="delete_form{{ $key }}.submit()" title="{{ trans('labels.delete') }}">
                                                            <i class="la la-trash-o white"></i>
                                                        </a>
                                                        <!-- delete -->
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'url' => route('tms-sectors.destroy', $sector->id),
                                                            'style' => 'display:inline',
                                                            'id' => 'delete_form' . $key,
                                                            'onclick'=>'return confirm("Confirm delete?")',
                                                        ]) !!}

                                                        {!! Form::close() !!}
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
