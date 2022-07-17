@extends('accounts::layouts.master')
@section('title', trans('accounts::budget.revenue_budget'))


@section('content')

    @php
        $sectors =[
            'accounts::budget.sectors.general',
            'accounts::budget.sectors.welfare_grants',
            'accounts::budget.sectors.private_educational_institution_grants',
            'accounts::budget.sectors.capital_allowance',
        ]
    @endphp

    <div class="container">


        <!-- General Information Card -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::fiscal-year.title')</h4>
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
                                        <th>@lang('accounts::fiscal-year.title')</th>
                                        <td>{{$fiscalyear}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable Card -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('accounts::budget.local_budget') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>

                    <!-- Table Values -->
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('accounts::budget.local_budget')}}</th>
                                        <th>{{trans('accounts::budget.local_budget_details.receipt')}}</th>
                                        <th>{{trans('accounts::budget.local_budget_details.payment')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($resourceTypes as $resourceType)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <a href="{{route('local-budget.details',[1,$resourceType])}}">
                                                    {{trans('accounts::budget.local_budget_details.resources.'.$resourceType)
                                                    }}</a>
                                            </td>
                                            <td>113002 (BDT)</td>
                                            <td>113002 (BDT)</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-center">Total</td>
                                        <td> {!! Form::number('', 113002*4,['class' => 'form-control','readonly'])!!}</td>
                                        <td> {!! Form::number('', 113002*4,['class' => 'form-control','readonly'])!!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection



@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <script>

        //        table export configuration
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1],
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1],
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'pdf',
                        exportOptions: {
                            columns: [0, 1],
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1],
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });


    </script>

@endpush
