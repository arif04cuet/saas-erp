@extends('accounts::layouts.master')
@section('title', trans('accounts::budget.cost_center.index'))

@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('accounts::budget.cost_center.index') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('budget-cost-centers.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>
                                @lang('labels.new')
                                @lang('accounts::budget.cost_center.index')
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
                                        <th>{{trans('accounts::cost-center.title')}}</th>
                                        <th>{{trans('accounts::budget.title')}}</th>
                                        <th>{{trans('accounts::fiscal-year.title')}}</th>
                                        <th>{{trans('labels.status')}}</th>
                                        <th>{{trans('accounts::budget.cost_center.amount_bdt')}}</th>

                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--{{dd($budgetCostCenters, $budgetCostCenters[0]->budget)}}--}}
                                    @foreach($budgetCostCenters as $budgetCostCenter)
                                        @php
                                            $budget = $budgetCostCenter->budget;
                                            $economyCode = $budgetCostCenter->economyCode;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                @if(App::getLocale() == 'bn')
                                                    {{$economyCode->bangla_name}}
                                                @else
                                                    {{$economyCode->english_name}}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('budgets.show', $budget->id)}}">{{$budget->title}}</a>
                                            </td>
                                            <td>
                                                {{$budget->fiscal_year}}
                                            </td>
                                            <td>{{$budget->status}}</td>
                                            <td>{{$budgetCostCenter->budget_amount}}</td>
                                            <td>
                                                <a class="btn btn-sm btn-info"
                                                   href="{{route('budget-cost-centers.edit', $budgetCostCenter->id)}}">
                                                    <i class="ft ft-edit"></i>
                                                </a>
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
