@extends('accounts::layouts.master')
@section('title', trans('accounts::budget.index'))


@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('accounts::budget.index') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('budgets.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('labels.add') }}
                            </a>

                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('accounts::budget.title')}}</th>
                                        <th>{{trans('accounts::fiscal-year.title')}}</th>
                                        <th>{{trans('labels.status')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($budgets as $budget)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td><a href="{{route('budgets.show', $budget->id)}}">{{$budget->title}}</a></td>
                                            <td>
                                                {{ $budget->fiscalYear ? $budget->fiscalYear->name : trans('labels.not_found') }}
                                            </td>
                                            <td>{{$budget->status}}</td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <!-- Details -->
                                                        <a href="{{route('budgets.show', $budget->id)}}"
                                                           class="dropdown-item"><i class="ft-eye"></i>
                                                            {{trans('labels.details')}}
                                                        </a>
                                                    <div class="dropdown-divider"></div>
                                                    <!-- Edit -->
                                                     <a href="{{route('budgets.edit',$budget->id)}}"
                                                        class="dropdown-item"><i class="ft-pencil"></i>
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
