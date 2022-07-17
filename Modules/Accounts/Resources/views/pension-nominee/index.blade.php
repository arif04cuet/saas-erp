@extends('accounts::layouts.master')
@section('title', trans('accounts::pension.nominee.list'))

@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('accounts::pension.nominee.list') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('pension-nominees.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>
                                {{ trans('accounts::pension.nominee.add') }}
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
                                        <th>@lang('accounts::pension.lump_sum.form_elements.employee')</th>
                                        <th>@lang('accounts::pension.nominee.nominee_name')</th>
                                        <th>@lang('accounts::pension.nominee.birth_date')</th>
                                        <th>@lang('accounts::pension.nominee.relation')</th>

                                        <th>@lang('labels.status')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($nominees as $nominee)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <a href="{{route('pension-nominees.show', $nominee->id)}}">
                                                    {{$nominee->employee ? $nominee->employee->getName() : ''}}
                                                </a>
                                            </td>
                                            <td>
                                                {{$nominee->name}}
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse($nominee->birth_date)->format('d F, Y')}}
                                            </td>
                                            <td>{{$nominee->relation}}</td>
                                            <td>{{$nominee->status}}</td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <!-- Details -->
                                                        <a href="{{route('pension-nominees.show', $nominee->id)}}"
                                                           class="dropdown-item"><i class="ft-eye"></i>
                                                            {{trans('labels.details')}}
                                                        </a>
                                                    <hr>
                                                    <!-- Edit -->
                                                        <a href="{{route('pension-nominees.edit', $nominee->id)}}"
                                                           class="dropdown-item"><i class="ft-edit"></i>
                                                            {{trans('labels.edit')}}
                                                        </a>

                                                 {{--@if(rand(1,2) == 1)--}}
                                                    {{--<!-- Variance -->--}}
                                                    {{--<a href="{{route('variance-analysis.show',1)}}"--}}
                                                    {{--class="dropdown-item"><i class="ft-eye"></i> Submit for approval</a>--}}
                                                    {{--@else--}}
                                                    {{--<!-- Variance -->--}}
                                                    {{--<a href="{{route('variance-analysis.show',1)}}"--}}
                                                    {{--class="dropdown-item"><i class="ft-eye"></i> {{trans('accounts::budget.variance.analysis')}}</a>--}}
                                                    {{--@endif--}}
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
            $('#').DataTable({
                dom: 'Bfrtip',
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });
    </script>

@endpush
