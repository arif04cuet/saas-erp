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
                                        <td>{{$budget->fiscal_year}}</td>
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

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table repeater-category-request table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('accounts::accounts.title')</th>
                                        <th colspan="2">@lang('accounts::budget.budget_split_for_fiscal_year')</th>
                                        <th colspan="2">@lang('accounts::budget.revised_budget_split')</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>@lang('accounts::budget.revenue_budget')</th>
                                        <th>@lang('accounts::budget.local_budget')</th>
                                        <th>@lang('accounts::budget.revenue_budget')</th>
                                        <th>@lang('accounts::budget.local_budget')</th>
                                    </tr>
                                    </thead>
                                    <tbody data-repeater-list="category">
                                    @foreach($budget->amounts as $amount)
                                        @php $economyCode = $amount->economyCode @endphp
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{$economyCode->code}}-
                                                @if(App::getLocale() == 'bn')
                                                    {{$economyCode->bangla_name}}
                                                @else
                                                    {{$economyCode->english_name}}
                                                @endif
                                            </td>
                                            <td>{{$amount->revenue_amount}}</td>
                                            <td>{{$amount->local_amount}}</td>
                                            <td>{{$amount->revised_revenue_amount}}</td>
                                            <td>{{$amount->revised_local_amount}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
