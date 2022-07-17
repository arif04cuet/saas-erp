@extends('hm::layouts.master')
@section('title', trans('hm::hostel_budget.page_title'))
@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if($budgetWithTitles->status == 1)

                    <div class="card">
                        <div class="card-header bg-gradient-success ">
                            <h4 class="card-title ">Budget List for {{ $budgetWithTitles->name }}</h4>
                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered alt-pagination"
                                           id="budgetDetailsTable">
                                        <thead>
                                        <tr>
                                            <th scope="col">{{trans('labels.serial')}}</th>
                                            <th scope="col">{{trans('labels.name')}}</th>
                                            <th scope="col">{{trans('hm::hostel_budget.budget_form_elements.budget_amount')}}</th>
                                            <th scope="col">{{trans('hm::hostel_budget.budget_form_elements.budget_approved_amount')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($budgetWithTitles['income_budgets']['data']) && count($budgetWithTitles['income_budgets']['data'])>0)
                                            @foreach($budgetWithTitles['income_budgets']['data'] as $budget)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $budget->budgetSection->getTitle() ?? '' }}</td>
                                                    <td>{{ $budget->budget_amount ?? 0 }}</td>
                                                    <td>{{ $budget->budget_approved_amount ?? 0  }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <th style="text-align:right">{{trans('hm::hostel_budget.budget_form_elements.total_income_budget')}}</th>
                                                <th>{{$budgetWithTitles['income_budgets']['total_approved_amount'] ?? 0 }}</th>
                                            </tr>
                                        @endif
                                        @if(isset($budgetWithTitles['expense_budgets']['data']) && count($budgetWithTitles['expense_budgets']['data'])>0)
                                            @foreach($budgetWithTitles['expense_budgets']['data'] as $budget)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $budget->budgetSection->getTitle() ?? '' }}</td>
                                                    <td>{{ $budget->budget_amount }}</td>
                                                    <td>{{ $budget->budget_approved_amount }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <th style="text-align:right">{{trans('hm::hostel_budget.budget_form_elements.total_expense_budget')}}</th>
                                                <th>{{$budgetWithTitles['expense_budgets']['total_approved_amount'] ?? 0 }}</th>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif(isset($budgetWithTitles->hostelBudgets) && count($budgetWithTitles->hostelBudgets)>0)

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"
                                id="basic-layout-form">{{ trans('hm::hostel_budget.approve_cancel_card_title') }}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                {!! Form::open(['route' => ['hostel-budgets.approve', $budgetWithTitles->id], 'class' => 'form budgetCreateForm',' novalidate']) !!}
                                    @include('hm::hostel-budget.form.budget_approve_form')
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form">{{trans('labels.generic_error_message')}}</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('page-css')
    <style>
        th {
            white-space: nowrap;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
@endpush


@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>
    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <script src="{{ asset('js/hostel-budget/sum.js') }}"></script>
    <script>
        $(document).ready(function () {
            calculateBudgetSum('budget_approved_amount');
            validateForm('.budgetCreateForm');
            $('.item-select').select2({
//                    placeholder: 'Select item',
                tags: true,
                delimiter: ',',
                tokenSeparators: [',', ' ', '`'],
            });

            $('.repeater_hostel_budget').repeater({
                show: function () {
                    $(this).find('.select2-container').remove();
                    $(this).find('select').select2({
//                            placeholder: 'Select item',
                        tags: true,
                    });
                    $(this).slideDown();
                }
            });


            $('#budgetDetailsTable').DataTable({
                dom: 'Bfrtip',
                columnDefs: [
                    {targets: 'no-sort', orderable: false}
                ],
                buttons: [
                    {
                        extend: 'copy',
                        className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2, 3],
                        }
                    },
                    {
                        extend: 'excel',
                        'title': 'Hostel Budget Report ( {{ $budgetWithTitles->name }} )',
                        className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3],
                        },
                    },
                    {
                        extend: 'print',
                        className: 'print',
                        text: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3],

                        },
                    },
                ],
                paging: false,
                "aaSorting": [],
                searching: true,
                "bDestroy": true,
            });

        });


    </script>
@endpush
