@extends('accounts::layouts.master')
@section('title', __('accounts::budget.title').' '.__('labels.show'))

@section('content')
    <div class="container">
        <!-- General Information Card -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::budget.title') @lang('labels.show')</h4>
                        <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>

                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="col-md-8">
                                <table class="table">
                                    <tr>
                                        <th>@lang('labels.title')</th>
                                        <td>{{$budget->title}}</td>
                                        <th>@lang('accounts::fiscal-year.title')</th>
                                        <td>{{$budget->fiscalYear->name}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <h4 class="card-title">{{ trans('accounts::budget.sector_details') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            {{--<a href="{{route('cost-center.create',1)}}" class="btn btn-primary btn-sm"><i--}}
                            {{--class="ft-plus white"></i> {{ trans('accounts::cost-center.create') }}--}}
                            {{--</a>--}}
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="base-tab11" data-toggle="tab" aria-controls="tab11"
                                           href="#tab11" aria-expanded="true">@lang('accounts::budget.sector')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab12" data-toggle="tab" aria-controls="tab12" href="#tab12"
                                           aria-expanded="false">@lang('accounts::budget.cost_center.title')</a>
                                    </li>

                                </ul>
                                <div class="tab-content px-1 pt-1">
                                    <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true" aria-labelledby="base-tab11">
                                        <h4 class="card-title">@lang('accounts::budget.sectors')</h4>

                                        <table class="table repeater-category-request table-bordered">
                                            <thead>
                                            <tr>
                                                <th>@lang('labels.serial')</th>
                                                <th>@lang('accounts::accounts.title')</th>
                                                <th colspan="3">@lang('accounts::budget.budget_split_for_fiscal_year')</th>
                                                <th colspan="3">@lang('accounts::budget.revised_budget_split')</th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>@lang('accounts::budget.revenue_budget')</th>
                                                <th>@lang('accounts::budget.local_budget')</th>
                                                <th>@lang('labels.total')</th>
                                                <th>@lang('accounts::budget.revenue_budget')</th>
                                                <th>@lang('accounts::budget.local_budget')</th>
                                                <th>@lang('labels.total')</th>
                                            </tr>
                                            </thead>
                                            <tbody data-repeater-list="category">
                                            @foreach($budget->sectors as $amount)
                                                @php $economyCode = $amount->economyCode @endphp
                                                <tr>
                                                    <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($loop->iteration)}}</td>
                                                    <td>
                                                        {{\App\Utilities\EnToBnNumberConverter::en2bn($economyCode->code, false)}}-
                                                        @if(App::getLocale() == 'bn')
                                                            {{$economyCode->bangla_name}}
                                                        @else
                                                            {{$economyCode->english_name}}
                                                        @endif
                                                    </td>
                                                    <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($amount->revenue_amount)}}</td>
                                                    <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($amount->local_amount)}}</td>
                                                    <td>{{
    \App\Utilities\EnToBnNumberConverter::en2bn($amount->local_amount + $amount->revenue_amount)}}
                                                    </td>
                                                    <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($amount->revised_revenue_amount)}}</td>
                                                    <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($amount->revised_local_amount)}}</td>
                                                    <td>
                                                        {{\App\Utilities\EnToBnNumberConverter::en2bn($amount->revised_local_amount + $amount->revised_revenue_amount)}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane" id="tab12" aria-labelledby="base-tab12">
                                        <h4 class="card-title">@lang('accounts::budget.cost_center.index')</h4>
                                        @foreach($budget->budgetCostCenters as $budgetCostCenter)
                                            @php
                                                $costCenterSectors = $budgetCostCenter->sectors;
                                                $economyCode = $budgetCostCenter->economyCode;
                                            @endphp
                                            <table class="table repeater-category-request table-bordered">
                                                <thead>
                                                <tr>
                                                    <th colspan="4" class="text-center">
                                                        <a href="{{route('budget-cost-centers.edit',
                                                        $budgetCostCenter->id)}}">
                                                            @if(App::getLocale() == 'bn')
                                                                {{$economyCode->bangla_name}}
                                                            @else
                                                                {{$economyCode->english_name}}
                                                            @endif
                                                        </a>

                                                        , @lang('accounts::budget.allocation'):
                                                        {{\App\Utilities\EnToBnNumberConverter::en2bn($budgetCostCenter->budget_amount)}}/-
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>@lang('labels.serial')</th>
                                                    <th>@lang('accounts::budget.cost_center.sector')</th>
                                                    <th>@lang('labels.code')</th>
                                                    <th>@lang('accounts::budget.cost_center.amount_bdt')</th>
                                                </tr>
                                                </thead>
                                                <tbody data-repeater-list="category">
                                                @foreach($costCenterSectors as $costCenterSector)
                                                    @php
                                                        $economySector = $costCenterSector->economySector;
                                                    @endphp
                                                    <tr>
                                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($loop->iteration, false)}}</td>
                                                        <td>
                                                            {{(
    App::getLocale() == 'bn')? $economySector->title_bangla : $economySector->title}}
                                                        </td>
                                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($costCenterSector->economy_sector_code, false)}}</td>
                                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($costCenterSector->budget_amount)}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-footer">
                            <div class="col-md-12">
                                <a href="{{route('budgets.edit', $budget->id)}}" class="btn btn-success">
                                    <i class="la la-pencil"></i> @lang('labels.edit')
                                </a>
                                <a href="{{route('budgets.index')}}" class="btn btn-danger">
                                    <i class="la la-backward"></i> @lang('labels.back_page')
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- DataTable Card -->
        </div>
    </div>

@endsection



@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>



    <script>

        //        table export configuration
        $(document).ready(function () {
            $('#').DataTable({
                dom: 'Bfrtip',
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

        let categoryRepeater = $(`.repeater-category-request`).repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });


    </script>

@endpush
