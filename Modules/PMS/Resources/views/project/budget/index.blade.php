@extends('pms::layouts.master')
@section('title', trans('pms::project_budget.title'))

@section('content')
    <div class="container">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12">
                <div class="btn-group float-md-left" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                        <a class="btn btn-outline-info round" href="{{ route('project.show', $project->id) }}">
                            <i class="ft-eye"></i> @lang('pms::project.title') @lang('labels.details')
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                        @if ($project->budgetCreate->isEmpty())
                            <a href="{{ route('project-budget.create', $project->id) }}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> @lang('labels.create')
                                @lang('pms::project_budget.budgeting')
                            </a>
                        @else
                            <a href="{{ route('project-budget.edit', $project->id) }}" class="btn btn-success btn-sm">
                                <i class="ft-edit-2 white"></i> @lang('labels.edit') @lang('pms::project_budget.budgeting')
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <section id="number-tabs">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('pms::project_budget.title')</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
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
                                        @if (!$project->budgetCreate->isEmpty())
                                        {!! Form::open(['route' =>  ['project-budget.filter', $project->id], 'id' =>'project-budget-form','class' => 'form novalidate']) !!}
                                           <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {!! Form::label('fiscal_year_id',
                                                             trans('accounts::fiscal-year.title'),
                                                            ['class' => 'form-label '])
                                                    !!}
                                                    {!!
                                                           Form::select('fiscal_year_id', $fiscalYears, null,
                                                          [
                                                                 'class'=>'form-control select2',
                                                                 'placeholder'=>trans('labels.all')
                                                             ])
                                        
                                                   !!}
                                        
                                                </div>
                                                <a class="ft ft-search btn btn-success" id="search">
                                                    @lang('accounts::payroll.payslip_report.form_elements.search')
                                                </a>
                                            </div>
                                           </div>
                                        {!! Form::close() !!}

                                        @endif
                                        <hr>
                                        <table id="project-budget" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>{{ trans('labels.serial') }}</th>
                                                    <th width="22%">@lang('accounts::fiscal-year.title')</th>
                                                    <th width="22%">@lang('accounts::economy-code.title')</th>
                                                    <th width="22%">@lang('pms::project_budget.activity')</th>
                                                    <th width="11%">@lang('pms::project_budget.budget')</th>
                                                    <th width="11%">@lang('pms::project_budget.revised_budget')</th>
                                                    <th width="11%">@lang('pms::project_budget.expense')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $totalRevisedBudget = 0;
                                                    $totalExpense = 0;
                                                @endphp
                                                @foreach ($projectBudgets as $budget)
                                                    @php
                                                        $totalRevisedBudget += $budget->revised_budget;
                                                        $totalExpense += $budget->expense;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $budget->fiscalYear->name }}</td>
                                                        <td>
                                                            {{ app()->isLocale('en') ? $budget->economyCode->english_name : $budget->economyCode->bangla_name }}
                                                        </td>
                                                        <td>{{ $budget->activity->name }}</td>
                                                        <td>{{ $budget->budget }}</td>
                                                        <td>{{ $budget->revised_budget }}</td>
                                                        <td>{{ $budget->expense }}</td>
                                                    </tr>
                                                @endforeach
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>{{ trans('labels.total') }}</th>
                                                    <th id="totalRevisedBudget">{{ $totalRevisedBudget }}</th>
                                                    <th id="totalExpense">{{ $totalExpense }}</th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>{{ trans('labels.the_rest') }}</th>
                                                    <th id="restOfThe" width=>{{ $totalRevisedBudget - $totalExpense }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection


@push('page-js')

<script>

        let table = $('#project-budget').dataTable({});

        $("#search").click(function(e) {
            e.preventDefault();
             loadData();
        });

        function stopLoadingInfo(buttonRef) {
            buttonRef.removeClass("btn-warning").addClass("btn-success");
            buttonRef.text(`{{ trans('accounts::payroll.payslip_report.form_elements.search') }}`);
        }

        function loadData() {
            let buttonRef = $('#search').text(`{{ trans('accounts::payroll.payslip_report.form_elements.search') }}`);
            buttonRef.removeClass("btn-success").addClass("btn-warning");
            let urlPart1 = "{{ url('pms/projects/') }}" ;
            let urlPart2 = "/budget/filter/" ;
            let dataPost = $("#project-budget-form").serialize();
            $.get(urlPart1+'/'+69+'/'+urlPart2, dataPost, function(data) {
                console.log(dataPost);
                table.DataTable().clear().draw();
                populateDatatable(data);
                stopLoadingInfo(buttonRef);
            });
        }

        function populateDatatable(data){
            console.log(data.length);
            
            let revisedBudget = 0 ;
            let expense = 0 ;

            for (let row = 0; row < data.length; row++) {
                obj = data[row];
                table.fnAddData([
                    obj.index,
                    obj.fiscal_year_name,
                    obj.EconomyCode,
                    obj.activity_name,
                    obj.budget,
                    obj.revised_budget,
                    obj.expense, 
                ]);
                revisedBudget +=  obj.revised_budget; 
                expense +=  obj.expense; 
               

            }
            $("#totalRevisedBudget").text(revisedBudget);
            $("#totalExpense").text(expense );
            $("#restOfThe").text(revisedBudget-expense);
        }
</script>

@endpush